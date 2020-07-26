<?php


namespace rapidPHP\library;


use application\controller\ApiUserController;
use Exception;
use rapidPHP\config\AppConfig;
use rapidPHP\library\core\Loader;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;

class Reflection extends ReflectionClass
{
    /**
     * 方法参数默认名
     */
    const METHOD_PARAM_DEFAULT_NAME = 'METHOD_PARAM_DEFAULT_NAME';

    /**
     * 方法参数类型名
     */
    const METHOD_PARAM_TYPE_NAME = 'METHOD_PARAM_TYPE_NAME';

    /**
     * 方法参数备注名
     */
    const METHOD_PARAM_REMARK_NAME = 'METHOD_PARAM_REMARK_NAME';

    /**
     * 类方法对象名
     */
    const CLASS_METHOD_OBJECT_NAME = 'CLASS_METHOD_OBJECT_NAME';

    /**
     * 类方法注释名
     */
    const CLASS_METHOD_DOC_NAME = 'CLASS_METHOD_DOC_NAME';

    /**
     * 类方法参数名
     */
    const CLASS_METHOD_PARAMS_NAME = 'CLASS_METHOD_PARAMS_NAME';


    /***
     * 获取实例
     * @param $name
     * @return Reflection|null
     */
    public static function getInstance($name)
    {
        $reflection = null;

        try {
            return new Reflection($name);
        } catch (Exception $ignored) {
            try {
                return new Reflection(Loader::getFilePath($name));
            } catch (Exception $ignored) {
                return null;
            }
        }
    }

    /**
     * 通过文件内容获取反射类
     * @param $content
     * @return null|Reflection
     */
    public static function getReflectionClass($content)
    {
        $namespace = B()->getRegular('/namespace (.*?);/i', $content);

        $className = B()->getRegular('/class (\w+)/i', $content);

        if (empty($className)) return null;

        try {
            return self::getInstance($namespace . '\\' . $className);
        } catch (Exception $ignored) {
            return null;
        }
    }

    /**
     * 通过文件获取反射类
     * @param $file
     * @return null|Reflection
     */
    public static function getReflectionClassByFile($file)
    {
        if (!file_exists($file) || !is_file($file) || !is_readable($file)) return null;

        $content = File::getInstance()->getContent($file);

        if (empty($content)) return null;

        return self::getReflectionClass($content);
    }

    /**
     * 获取文件里面使用所有use 导入的包
     * @param $content
     * @param ReflectionClass $reflectionClass
     * @return array
     */
    public static function getImportPackage($content, ReflectionClass $reflectionClass)
    {
        $currentClassName = $reflectionClass->getName();

        $result = [$currentClassName => []];

        $contents = explode("\n", $content);

        foreach ($contents as $v) {
            if (strtolower(substr($v, 0, 3)) === 'use') {
                $use = B()->getRegular('/^use (.*(as \w+)?);$/i', $v);

                $useInfo = explode(" as ", $use);

                $className = trim(B()->getData($useInfo, 0));

                if (empty($className)) continue;

                $asName = trim(B()->getData($useInfo, 1));

                if (empty($asName)) {
                    $classInfo = explode("\\", $className);

                    $asName = trim(end($classInfo));

                    if (empty($asName)) continue;
                }

                $result[$currentClassName][$asName] = $className;
            }
        }

        if ($reflectionClass instanceof ReflectionClass) {
            $refParentClass = $reflectionClass->getParentClass();

            if ($refParentClass) {
                $refParentContent = file_get_contents($refParentClass->getFileName());

                $result = array_merge(self::getImportPackage($refParentContent, $refParentClass), $result);
            }
        }

        return $result;
    }

    /**
     * 获取文件里面使用所有use 导入的包
     * @param $file
     * @param ReflectionClass $reflectionClass
     * @return array
     */
    public static function getImportPackageByFile($file, ReflectionClass $reflectionClass)
    {
        if (!file_exists($file) || !is_file($file) || !is_readable($file)) return null;

        $content = File::getInstance()->getContent($file);

        if (empty($content)) return null;

        return self::getImportPackage($content, $reflectionClass);
    }

    /**
     * 获取方法默认值
     * @param ReflectionMethod $method
     * @param bool $isDefaultNull
     * @return array
     */
    public static function getMethodDefaultValues(ReflectionMethod $method, $isDefaultNull = false)
    {
        $values = [];

        foreach ($method->getParameters() as $parameter) {
            try {
                if ($parameter->isDefaultValueAvailable()) {
                    $values[$parameter->getName()] = $parameter->getDefaultValue();
                } else if ($isDefaultNull) {
                    $values[$parameter->getName()] = null;
                }
            } catch (ReflectionException $e) {
                if ($isDefaultNull) $values[$parameter->getName()] = null;
            }
        }

        return $values;
    }

    /**
     * 获取注解value
     * @param $doc
     * @param $first
     * @return string
     */
    public static function getDocValue($doc, $first)
    {
        return trim(B()->getRegular("/{$first}(.*)/i", $doc));
    }

    /**
     * 获取注解values
     * @param $doc
     * @param $first
     * @return array
     */
    public static function getDocValues($doc, $first)
    {
        $value = self::getDocValue($doc, $first);

        if (empty($value)) return [];

        return explode(' ', $value);
    }

    /**
     * 获取参数注释的类型
     * @param $namespace
     * @param $packages
     * @param $param
     * @param bool $isQuote
     * @return string
     */
    public static function getParamDocTypeString($namespace, $packages, $param, $isQuote = false)
    {
        $type = B()->getData($param, Reflection::METHOD_PARAM_TYPE_NAME);

        if (empty($type)) return null;

        $paramType = str_replace(['::class', '-'], '', $type);

        if (isset($packages[$paramType])) {
            $paramType = '\\' . $packages[$paramType] . '::class';
        } else {
            if (self::getInstance($namespace . '\\' . $paramType) != null) {
               return $namespace . '\\' . $paramType;
            }

            $paramType = B()->getData(explode('|', $paramType), 0);

            if ($isQuote === true) $paramType = '\'' . $paramType . '\'';
        }

        return $paramType;
    }

    /**
     * 获取参数DoType
     * @param $param
     * @return string
     */
    public static function getParamDocDoTypeString($param)
    {
        $remark = B()->getData($param, Reflection::METHOD_PARAM_REMARK_NAME);

        if (empty($remark)) return null;

        $type = str_replace(':', '', $remark);

        if (empty($type)) return null;

        if (isset(AppConfig::$REQUEST_PARAM_TYPE[strtoupper($type)])) return strtoupper($type);

        return $type;
    }

    /**
     * 反射调用对象的方法
     * @param $object
     * @param $methodName
     * @param $data
     * @return array 返回方法修改过的参数
     * @throws ReflectionException
     */
    public static function invokeMethod($object, $methodName, $data)
    {
        $method = new ReflectionMethod($object, $methodName);

        $methodParams = self::getMethodDefaultValues($method, true);

        foreach ($methodParams as $key => $default) {
            if (is_array($data) && array_key_exists($key, $data)) {
                $methodParams[$key] = $data[$key];
            } else if (is_object($data) && isset($data->$key)) {
                $methodParams[$key] = $data->$key;
            } else if (is_null($default) && isset($object->$key)) {
                $methodParams[$key] = $object->$key;
            }
        }

        $method->invokeArgs($object, $methodParams);

        return $methodParams;
    }

    /**
     * 获取当前class里面使用所有use 导入的包
     * @return array
     */
    public function getCurrentImportPackage()
    {
        return self::getImportPackageByFile($this->getFileName(), $this);
    }

    /**
     * 获取方法的参数（包括从注释里面读取默认 类型等信息）
     * @param ReflectionMethod $method
     * @param $doc
     * @param string $paramDocName
     * @return array
     */
    public function getMethodParamsWithDoc(ReflectionMethod $method, $doc, $paramDocName)
    {
        $params = [];

        $values = $this->getMethodDefaultValues($method);

        foreach ($method->getParameters() as $parameter) {
            $param = [];

            $paramName = $parameter->getName();

            if (array_key_exists($paramName, $values)) {
                $param[self::METHOD_PARAM_DEFAULT_NAME] = $values[$paramName];
            }

            $params[$paramName] = $param;

            if (is_null($doc)) continue;

            preg_match("/{$paramDocName} (.*)?\\\${$paramName}(.*)?/i", $method->getDocComment(), $info);

            if (empty($info)) continue;

            $paramType = trim(B()->getData($info, 1));

            if (!is_null($paramType)) $param[self::METHOD_PARAM_TYPE_NAME] = $paramType;

            $paramDoType = trim(B()->getData($info, 2));

            if (!is_null($paramDoType)) $param[self::METHOD_PARAM_REMARK_NAME] = $paramDoType;

            $params[$paramName] = $param;
        }

        return $params;
    }


    /**
     * 获取所有方法跟注释文档（包括从注释里面读取默认 类型等信息）
     * @param $paramDocName
     * @param bool $public 是否只要公开的方法
     * @param bool|array $parent 是否需要父类方法
     * @return array
     */
    public function getMethodsWithDoc($paramDocName, $public = true, $parent = false)
    {
        $methods = [];

        foreach ($this->getMethods() as $method) {

            if ($public && !$method->isPublic()) continue;

            $parentClassName = $method->getDeclaringClass()->getName();

            if ($parentClassName != self::getName()) {
                if (is_array($parent)) {
                    if (array_search($method->getName(), $parent) === false) continue;
                } elseif (is_string($parent)) {
                    if ($method->getName() != $parent) continue;
                } else if (is_bool($parent)) {
                    if (!$parent) continue;
                }
            }

            if (!$parent && $parentClassName != self::getName()) continue;

            if ($parentClassName == AB::class && $parentClassName != self::getName()) continue;

            $doc = $method->getDocComment();

            $parameters = $this->getMethodParamsWithDoc($method, $doc, $paramDocName);

            $methods[] = [
                self::CLASS_METHOD_OBJECT_NAME => $method,
                self::CLASS_METHOD_DOC_NAME => $doc,
                self::CLASS_METHOD_PARAMS_NAME => $parameters,
            ];
        }

        return $methods;
    }
}