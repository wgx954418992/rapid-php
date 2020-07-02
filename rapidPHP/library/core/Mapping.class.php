<?php

namespace rapidPHP\library\core;

use Exception;
use rapid\library\rapid;
use rapidPHP\config\MappingConfig;
use rapidPHP\config\RouterConfig;
use rapidPHP\library\Reflection;
use ReflectionMethod;

class Mapping
{
    private $path;

    private $urlName = MappingConfig::APP_MAPPING_CONFIG_URL_NAME;

    private $paramName = MappingConfig::APP_MAPPING_CONFIG_PARAM_NAME;

    private $methodName = MappingConfig::APP_MAPPING_CONFIG_METHOD_NAME;

    private $typedName = MappingConfig::APP_MAPPING_CONFIG_TYPE_NAME;

    private $headerName = MappingConfig::APP_MAPPING_CONFIG_HEADER_NAME;

    public function __construct($path = null)
    {
        $this->path = empty($path) ? MappingConfig::$MAPPING_PATH : $path;
    }

    /**
     * 开始扫描编译
     * @throws Exception
     */
    public function start()
    {
        $read = F()->readDirFiles($this->path);

        $urlResult = '';

        $appResult = '';

        foreach ($read as $file) {
            if (!file_exists($file) || !is_file($file) || !is_readable($file)) continue;

            $content = file_get_contents($file);

            if (empty($content)) continue;

            $reflectionClass = Reflection::getReflectionClass($content);

            if (is_null($reflectionClass)) continue;

            $packages = Reflection::getImportPackage($content, $reflectionClass);

            unset($content);

            $result = $this->compileMapping($packages, $reflectionClass);

            $urls = B()->getData($result, 'urls');

            if (!empty($urls)) $urlResult .= $urls . ',';

            $appResult .= B()->getData($result, 'apps');
        }

        $this->writeResultUrls($urlResult);

        $this->writeResultApps($appResult);
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
     * @return array
     */
    private function compileMapping($packages, Reflection $class)
    {
        $urlsPush = [];

        $urlsUnshift = [];

        $apps = "\\{$class->getName()}::class => [";

        $classUrl = $this->getClassUrl($class);

        foreach ($class->getMethodsWithDoc($this->paramName, true, RouterConfig::CLASS_NAME_INIT) as $methodInfo) {
            $method = $methodInfo[Reflection::CLASS_METHOD_OBJECT_NAME];

            if (!($method instanceof ReflectionMethod)) continue;

            $methodName = $method->getName();

            $doc = $methodInfo[Reflection::CLASS_METHOD_DOC_NAME];

            $url = Reflection::getDocValue($doc, $this->urlName);

            if (empty($url) && $methodName !== RouterConfig::CLASS_NAME_INIT) continue;

            if ($methodName === RouterConfig::CLASS_NAME_INIT && empty($methodInfo[Reflection::CLASS_METHOD_PARAMS_NAME])) {
                continue;
            }

            $url = $classUrl . $url;

            if (strlen($url) > 1) $url = ltrim($url, '/*');

            $docUrl = $url;

            $requestType = $this->getMethodRequestTypeString($methodName, $doc);

            $optionHeaders = $this->getMethodHeadersString($methodName, $doc);

            $optionTyped = $this->getMethodTypedString($methodName, $doc);

            $paramsString = $this->getCompileMethodParamsString($class->getNamespaceName(), $packages, $methodInfo, $url);

            if ($methodName !== RouterConfig::CLASS_NAME_INIT) {
                if (!empty($paramsString)) $paramsString = 'RouterConfig::METHOD_PARAMETER => [' . $paramsString . '],';

                $apps .= "'{$methodName}'=>[RouterConfig::METHOD_NAME => '{$methodName}',{$requestType}{$optionHeaders}{$optionTyped}{$paramsString}],";
            } else {
                $apps .= '\'' . $methodName . '\'=>[' . $paramsString . '],';
            }

            if (empty($url) || $methodName === RouterConfig::CLASS_NAME_INIT) continue;

            $mappingUrl = $this->parseUrl($class->getName(), $methodName, $url);

            if (preg_match('/{\w+}/i', $docUrl) > 0) {
                $urlsPush[] = $mappingUrl;
            } else {
                $urlsUnshift[] = $mappingUrl;
            }
        }

        foreach ($urlsPush as $url) $urlsUnshift[] = $url;

        return ['urls' => join(',', $urlsUnshift), 'apps' => $apps . "],"];
    }

    /**
     * 解析url
     * @param $className
     * @param $methodName
     * @param $url
     * @return string
     */
    private function parseUrl($className, $methodName, $url)
    {
        if (empty($url)) return '';

        if (!is_int(strpos($url, '.'))) {
            if (strlen($url) > 1 && substr($url, -1, 1) === '/')
                $url = rtrim($url, '/*');

            $url .= '(|\.html|\.php)';
        }

        $url = '/^' . str_replace('/', '\/', $url) . '$/i';

        return '[RouterConfig::URI_NAME=>' . '\'' . $url . '\'' . ',RouterConfig::CLASS_NAME => \\' . $className . '::class, RouterConfig::APP_NAME => \'' . $methodName . '\']';
    }

    /**
     * 获取方法请求类型
     * @param $methodName
     * @param $doc
     * @return string
     */
    private function getMethodRequestTypeString($methodName, $doc)
    {
        if ($methodName === RouterConfig::CLASS_NAME_INIT) return '';

        if (empty($doc)) return '';

        $requestType = Reflection::getDocValue($doc, $this->methodName);

        if (empty($requestType)) return '';

        return 'RouterConfig::METHOD_TYPE => \'' . strtoupper($requestType) . '\',';
    }

    /**
     * 获取方法typed
     * @param $methodName
     * @param $doc
     * @return string
     */
    private function getMethodTypedString($methodName, $doc)
    {
        if ($methodName === RouterConfig::CLASS_NAME_INIT) return '';

        if (empty($doc)) return '';

        $typed = Reflection::getDocValue($doc, $this->typedName);

        if (empty($typed)) return '';

        return 'RouterConfig::TYPED_TYPE => \'' . $typed . '\',';
    }

    /**
     * 获取方法headers
     * @param $methodName
     * @param $doc
     * @return string
     */
    private function getMethodHeadersString($methodName, $doc)
    {
        if ($methodName === RouterConfig::CLASS_NAME_INIT) return '';

        if (empty($doc)) return '';

        $headers = Reflection::getDocValue($doc, $this->headerName);

        if (empty($headers)) return '';

        $headers = explode(",", $headers);

        return 'RouterConfig::HEADER_TYPE => \'' . serialize($headers) . '\',';
    }

    /**
     * 编译方法参数跟url
     * @param $params
     * @param $url
     */
    private function compileMethodParamsWithUrl(&$params, &$url)
    {
        $index = 1;

        $urlParams = (array)B()->getRegularAll('/{(\w+)}/i', $url, 1);

        foreach ($urlParams as $name) {
            $params[$name][Reflection::METHOD_PARAM_REMARK_NAME] = '$' . $index;

            $url = str_replace('{' . $name . '}', '(\w+)', $url);

            $index++;
        }
    }

    /**
     * 获取编译方法参数结果
     * @param $namespace
     * @param $packages
     * @param $methodInfo
     * @param $url
     * @return string
     */
    private function getCompileMethodParamsString($namespace, $packages, $methodInfo, &$url)
    {
        $params = $methodInfo[Reflection::CLASS_METHOD_PARAMS_NAME];

        /** @var ReflectionMethod $method */
        $method = $methodInfo[Reflection::CLASS_METHOD_OBJECT_NAME];

        $packages = B()->getData($packages, $method->getDeclaringClass()->getName()) ?? [];

        if (empty($params)) return '';

        $this->compileMethodParamsWithUrl($params, $url);

        $paramsString = '';

        foreach ($params as $name => $param) {

            $typeString = $this->getParamTypeString($namespace, $packages, $param);

            $doTypeString = $this->getParamDoTypeString($param);

            $defaultString = $this->getParamDefaultString($param);

            $paramsString .= '\'' . $name . '\'' . '=>[' . $typeString . $doTypeString . $defaultString . '],';
        }

        return $paramsString;
    }

    /**
     * 获取参数类型
     * @param $namespace
     * @param $packages
     * @param $param
     * @return string
     */
    private function getParamTypeString($namespace, $packages, $param)
    {
        $paramType = Reflection::getParamDocTypeString($namespace, $packages, $param, true);

        if (empty($paramType)) return '';

        return 'RouterConfig::METHOD_PARAMETER_TYPE => ' . $paramType . ',';
    }

    /**
     * 获取参数DoType
     * @param $param
     * @return string
     */
    private function getParamDoTypeString($param)
    {
        $type = Reflection::getParamDocDoTypeString($param);

        if (empty($type)) return '';

        return 'RouterConfig::METHOD_PARAMETER_REQUEST_DOTYPE => \'' . $type . '\',';
    }

    /**
     * 获取参数默认值
     * @param $param
     * @return string
     */
    private function getParamDefaultString($param)
    {
        if (!array_key_exists(Reflection::METHOD_PARAM_DEFAULT_NAME, $param)) return '';

        $default = $param[Reflection::METHOD_PARAM_DEFAULT_NAME];

        return 'RouterConfig::METHOD_PARAMETER_DEFAULT => \'' . serialize($default) . '\',';
    }


    /**
     * 写入url结果
     * @param string $urls
     * @throws Exception
     */
    private function writeResultUrls(string $urls)
    {
        $date = B()->getDate();

        $code = <<<EOF
<?php
use rapidPHP\config\RouterConfig;

/**
 * 该文件由RapidPHP自动生成，生成时间：{$date}
 * 路由uri配置层一层外下匹配，直到匹配到停止
 * 正则或路径=>类，app.inc的对应类的元素名
 */
return [
{$urls}
];
EOF;

        $this->write(MappingConfig::$URI_FILE_PATH, $code);
    }

    /**
     * 写入apps 结果
     * @param string $apps
     * @throws Exception
     */
    private function writeResultApps(string $apps)
    {
        $date = B()->getDate();


        $code = <<<EOF
<?php
use rapidPHP\config\RouterConfig;

/**
 * 该文件由RapidPHP自动生成，生成时间：{$date}
 * 可以访问的类，接口，不声明则没权限访问
 */
return [
{$apps}
];
EOF;
        $this->write(MappingConfig::$APP_FILE_PATH, $code);
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