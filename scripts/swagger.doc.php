<?php

use rapid\library\rapid;
use rapidPHP\config\AppConfig;
use rapidPHP\config\MappingConfig;
use rapidPHP\library\Reflection;
use rapidPHP\plugin\Spyc;

require(dirname(__DIR__) . '/rapidPHP/init.php');

if (!APP_RUNNING_IS_SHELL) exit();

class swagger
{
    private $path;

    private $paths = [];

    private $components = [];

    private $urlName = MappingConfig::APP_MAPPING_CONFIG_URL_NAME;

    private $paramName = MappingConfig::APP_MAPPING_CONFIG_PARAM_NAME;

    private $methodName = MappingConfig::APP_MAPPING_CONFIG_METHOD_NAME;

    private static $REQUEST_PARAM_TYPE = [
        AppConfig::REQUEST_PARAM_GET => 'query',
        AppConfig::REQUEST_PARAM_POST => 'body',
        AppConfig::REQUEST_PARAM_PUT => 'body',
        AppConfig::REQUEST_PARAM_COOKIE => 'cookie',
        AppConfig::REQUEST_PARAM_SESSION => 'cookie',
        AppConfig::REQUEST_PARAM_FILE => 'file',
    ];

    private static $SET_VAR_DEFAULT_TYPE = [
        AppConfig::VAR_TYPE_INTEGER => 'integer',
        AppConfig::VAR_TYPE_INT => 'integer',
        AppConfig::VAR_TYPE_FLOAT => 'integer',
        AppConfig::VAR_TYPE_DOUBLE => 'integer',
        AppConfig::VAR_TYPE_STRING => 'string',
        AppConfig::VAR_TYPE_ARRAY => 'array',
        AppConfig::VAR_TYPE_OBJECT => 'object',
        AppConfig::VAR_TYPE_BOOLEAN => 'boolean',
        AppConfig::VAR_TYPE_BOOL => 'boolean',
    ];

    public function __construct($path = null)
    {
        $this->path = empty($path) ? MappingConfig::$MAPPING_PATH : $path;
    }

    /**
     * 开始扫描编译
     * @param string $type
     * @param null $path
     * @param null $appendFile
     * @throws Exception
     */
    public function start($type = 'yaml', $path = null, $appendFile = null)
    {
        $read = F()->readDirFiles($this->path);

        foreach ($read as $file) {
            if (!file_exists($file) || !is_file($file) || !is_readable($file)) continue;

            $content = file_get_contents($file);

            if (empty($content)) continue;

            $reflectionClass = Reflection::getReflectionClass($content);

            if (is_null($reflectionClass)) continue;

            $packages = Reflection::getImportPackage($content, $reflectionClass);

            unset($content);

            $this->compileMapping($packages, $reflectionClass);
        }

        $this->writeResult($type, $path, $appendFile);
    }

    /**
     * 获取class 上面注解的url
     * @param Reflection $class
     * @return string
     */
    private function getClassUrl(Reflection $class)
    {
        $classUrl = Reflection::getDocValue($class->getDocComment(), $this->urlName);

        if (empty($classUrl)) return $classUrl;

        return rtrim($classUrl, '/*');
    }

    /**
     * 编译映射
     * @param $packages
     * @param Reflection $class
     */
    private function compileMapping($packages, Reflection $class)
    {
        $classUrl = $this->getClassUrl($class);

        foreach ($class->getMethodsWithDoc($this->paramName) as $methodInfo) {
            $method = $methodInfo[Reflection::CLASS_METHOD_OBJECT_NAME];

            if (!($method instanceof ReflectionMethod)) continue;

            $methodName = $method->getName();

            $doc = $methodInfo[Reflection::CLASS_METHOD_DOC_NAME];

            $url = Reflection::getDocValue($doc, $this->urlName);

            if (empty($url)) continue;

            $url = $classUrl . $url;

            $requestType = $this->getMethodRequestType($doc);

            $parameters = $this->getCompileMethodParams($class->getNamespaceName(), $packages, $methodInfo, $requestType, $url);

            $data = [
                'summary' => $this->getMethodDocRemark($doc),
                'operationId' => $class->getName() . '::' . $methodName,
                'responses' => [200 => ['description' => 'success']]
            ];

            $this->paths[$url] = [$requestType => array_merge($data, $parameters)];
        }
    }

    /**
     * 编译组件
     * @param $className
     * @param $refName
     */
    private function compileComponents($className, $refName)
    {
        $reflection = Reflection::getInstance($className);

        if (is_null($reflection)) return;

        $packages = $reflection->getCurrentImportPackage();

        $methods = $reflection->getMethodsWithDoc(MappingConfig::APP_MAPPING_CONFIG_PARAM_NAME, true, true);

        $properties = [];

        $component = [
            'type' => 'object',
            'properties' => &$properties,
        ];

        $this->components[$refName] = &$component;

        foreach ($methods as $methodInfo) {
            $method = $methodInfo[Reflection::CLASS_METHOD_OBJECT_NAME];

            if (!($method instanceof ReflectionMethod)) continue;

            $methodName = $method->getName();

            if (strtolower(substr($methodName, 0, 3)) !== 'set') continue;

            $params = $methodInfo[Reflection::CLASS_METHOD_PARAMS_NAME];

            if (empty($params)) continue;

            foreach ($params as $name => $param) {

                $type = $this->getParamType($reflection->getNamespaceName(), $packages, $param,);

                $properties[$name] = $type;
            }
        }
    }

    /**
     * 获取方法请求类型
     * @param $doc
     * @return string
     */
    private function getMethodDocRemark($doc)
    {
        if (empty($doc)) return '';

        return trim(B()->getRegular('/\/\*\*\n.*\*(.*)/i', $doc));
    }

    /**
     * 获取方法请求类型
     * @param $doc
     * @return string
     */
    private function getMethodRequestType($doc)
    {
        if (empty($doc)) return strtolower(AppConfig::REQUEST_PARAM_GET);

        $requestType = Reflection::getDocValue($doc, $this->methodName);

        if (empty($requestType)) return strtolower(AppConfig::REQUEST_PARAM_GET);

        return strtolower($requestType);
    }


    /**
     * 获取编译方法参数结果
     * @param $namespace
     * @param $packages
     * @param $methodInfo
     * @param $reqType
     * @param $url
     * @return array
     */
    private function getCompileMethodParams($namespace, $packages, $methodInfo, $reqType, $url)
    {
        $params = $methodInfo[Reflection::CLASS_METHOD_PARAMS_NAME];

        if (empty($params)) return [];

        $bodyList = ['schema' => ['properties' => [], 'required' => [],]];

        $fileList = ['schema' => ['type' => 'object', 'properties' => []]];

        $paramsList = [];

        foreach ($params as $name => $param) {

            $type = $this->getParamType($namespace, $packages, $param);

            $doType = $this->getParamDoType($param, $name, $url, $reqType);

            $default = $this->getParamDefault($param);

            $required = is_bool($default);

            if ($doType == 'body') {
                $bodyList['schema']['properties'][$name] = $type;

                if (!$required) continue;

                $bodyList['schema']['required'][] = $name;
            } else if ($doType == 'file') {
                $fileList['schema']['properties'][$name] = [
                    'type' => 'string',
                    'format' => 'binary'
                ];

                if (!$required) continue;

                $fileList['schema']['required'][] = $name;
            } else {
                $paramsList[] = [
                    'name' => $name,
                    'required' => $required,
                    'in' => $doType,
                    'schema' => $type,
                ];
            }
        }

        $result = [];

        if (!empty($paramsList)) $result['parameters'] = $paramsList;

        if (!empty($bodyList['schema']['properties'])) $result['requestBody'] = [
            'content' => ['application/x-www-form-urlencoded' => $bodyList]
        ];

        if (!empty($fileList['schema']['properties'])) $result['requestBody'] = [
            'content' => ['multipart/form-data' => $fileList]
        ];

        return $result;
    }

    /**
     * 获取参数类型
     * @param $namespace
     * @param $packages
     * @param $param
     * @return array
     */
    private function getParamType($namespace, $packages, $param)
    {
        $paramType = Reflection::getParamDocTypeString($namespace, $packages, $param, false);

        if (empty($paramType)) $paramType = 'string';

        if (strtoupper($paramType) == AppConfig::VAR_TYPE_JSON || strtoupper($paramType) == AppConfig::VAR_TYPE_XML) {
            $convertType = 'array';
        } else {
            $convertType = B()->getData(self::$SET_VAR_DEFAULT_TYPE, $paramType);
        }

        if (!empty($convertType)) {

            $result = ['type' => $convertType];

            switch ($convertType) {
                case 'array':
                    $result['items'] = ['type' => 'string'];
                    break;
            }

            return $result;
        }

        $paramType = str_replace('::class', '', $paramType);

        $name = str_replace('\\', '', $paramType);

        $ref = '#/components/schemas/' . $name;

        $this->compileComponents($paramType, $name);

        return ['$ref' => $ref];
    }


    /**
     * 获取参数DoType
     * @param $param
     * @param $name
     * @param $url
     * @param $reqType
     * @return string
     */
    private function getParamDoType($param, $name, $url, $reqType)
    {
        $type = Reflection::getParamDocDoTypeString($param);

        if (preg_match('/{' . $name . '}/i', $url) > 0) return 'path';

        if (empty($type)) $type = $reqType;

        return B()->getData(self::$REQUEST_PARAM_TYPE, strtoupper($type));
    }

    /**
     * 获取参数默认值
     * @param $param
     * @return string
     */
    private function getParamDefault($param)
    {
        if (!array_key_exists(Reflection::METHOD_PARAM_DEFAULT_NAME, $param)) return false;

        return $param[Reflection::METHOD_PARAM_DEFAULT_NAME];
    }

    /**
     * 写出结果
     * @param $type
     * @param $path
     * @param $appendFile
     * @throws Exception
     */
    private function writeResult($type, $path, $appendFile)
    {
        $version = '1.0.0';

        $array = [
            'openapi' => "3.0.0",
            'info' => [
                'title' => 'RapidPHP General Swagger Api Doc',
                'version' => $version,
            ],
            'paths' => $this->paths,
            'components' => ['schemas' => $this->components],
        ];

        if (is_file($appendFile)) {
            $appendData = Spyc::YAMLLoad(file_get_contents($appendFile));

            $array = array_merge($array, $appendData);
        }

        switch ($type) {
            case 'json':
                $content = json_encode($array);
                break;
            default:
                $type = 'yaml';

                $content = Spyc::YAMLDump($array, false, 10000, true);
                break;
        }

        if (is_null($path)) $path = ROOT_PATH . '/swagger_mapping_' . $version . '.' . $type;

        $this->write($path, $content);
    }

    /**
     * 写到文件
     * @param $filePath :路径
     * @param $content :内容
     * @throws Exception 写出失败，抛出异常
     */
    private function write($filePath, $content)
    {
        $dir = dirname($filePath);

        if (!is_dir($dir) && !mkdir($dir, 0777, true)) throw new Exception($dir . '目录创建失败');

        if (!file_put_contents($filePath, $content)) {
            $msg = '写出配置文件失败，请检查' . $filePath . '是否有写入权限';

            throw new Exception($msg);
        }
    }
}

$type = B()->getData($argv, 1);

$path = B()->getData($argv, 2);

$appendFile = B()->getData($argv, 3);

try {
    (new swagger())->start($type, $path, $appendFile);
} catch
(Exception $e) {
    exit($e->getMessage());
}