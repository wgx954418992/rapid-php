<?php

namespace rapidPHP\library\core;


use Exception;
use rapid\library\rapid;
use rapidPHP\config\AppConfig;
use rapidPHP\config\MappingConfig;
use rapidPHP\config\RouterConfig;
use rapidPHP\library\core\app\exception\ExceptionController;
use rapidPHP\library\core\app\exception\ExceptionInterface;
use rapidPHP\library\core\app\ViewInterface;
use rapidPHP\library\Reflection;
use rapidPHP\library\RESTFullApi;
use rapidPHP\library\ViewTemplate;
use ReflectionException;
use ReflectionMethod;

class Router
{

    /**
     * 全局报错处理类
     * @var ExceptionInterface
     */
    private $ex;

    private $routingApp = [];

    private $routingUri = [];

    private $__ROUTE__URI__;

    const __ROUTE__NAME = '__ROUTE__';

    /**
     * App constructor.
     * @param ExceptionInterface $ex
     * @throws Exception
     */
    public function __construct(ExceptionInterface $ex)
    {
        $this->sweepControllerMapping();

        $this->ex = $ex;

        $this->routingApp = (array)include(MappingConfig::$APP_FILE_PATH . '');

        $this->routingUri = (array)include(MappingConfig::$URI_FILE_PATH . '');

        $this->initRouterUri();
    }

    /**
     * 初始化
     */
    private function initRouterUri()
    {
        if (I()->get($this::__ROUTE__NAME)) {
            $this->__ROUTE__URI__ = trim(I()->get($this::__ROUTE__NAME), '/');

            unset($_GET[$this::__ROUTE__NAME]);
        }
    }


    /**
     * 获取uri
     * @return mixed
     */
    public function getCurrentUri()
    {
        return $this->__ROUTE__URI__ ? $this->__ROUTE__URI__ : '/';
    }


    /**
     * 扫码controller 里面的映射
     * @throws Exception
     */
    public function sweepControllerMapping()
    {
        $ip = B()->getIp();

        if (is_null($ip) || !filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
            (new Mapping())->start();
        }
    }

    /**
     * 通过路由匹配真实的uri
     * @param $uri
     * @return bool|mixed
     */
    private function matching($uri)
    {
        $isNotFound = true;

        $forbidden = [];

        foreach ($this->routingUri as $value) {

            $valueUri = $value[RouterConfig::URI_NAME];

            $urlParam = [];

            $preg = V()->preg($valueUri) ? preg_match($valueUri, $uri, $urlParam) : (int)($valueUri == $uri);

            if (is_int($preg) && $preg == 1) {

                $className = B()->getData($value, RouterConfig::CLASS_NAME);

                $appName = B()->getData($value, RouterConfig::APP_NAME);

                $appData = $this->getUriApp($className);

                if (!is_array($appData)) {
                    $isNotFound = false;

                    continue;
                }

                $appMethodData = $this->getUriAppMethod($appData, $appName);

                if ($appMethodData && B()->getRequestMethod() != $this->getUriAppMethodType($appMethodData)) {
                    $forbidden = [$this->getCurrentUri(), $className, $appName];

                    continue;
                }

                echo($this->exec($className, $appName, $urlParam, $appMethodData));

                return true;
            }
        }

        if (!empty($forbidden)) {
            try {
                $this->callUserFuncArray($this->ex, 'forbidden', null, $forbidden);
            } catch (ReflectionException $e) {
            }
        }

        return !$isNotFound;
    }

    /**
     * 获取uri对应的app
     * @param $className
     * @return array|null|string
     */
    private function getUriApp($className)
    {
        return B()->getData($this->routingApp, $className);
    }

    /**
     * 获取uri对应的方法
     * @param $appData
     * @param $appName
     * @return array|null|string
     */
    private function getUriAppMethod($appData, $appName)
    {
        if (is_array($appMethodData = B()->getData($appData, $appName))) {
            return $appMethodData;
        } else {
            $appData = AR()->valueToKey($appData);

            $appMethodData = B()->getData($appData, $appName);

            if (is_null($appMethodData)) return false;

            return [RouterConfig::METHOD_NAME => $appName];
        }
    }


    /**
     * 获取uri方法的方法名，如果设置了方法名，则用设置的，没有则用appName
     * @param $appMethodData
     * @param $appName
     * @return array|null|string
     */
    private function getUriAppMethodName($appMethodData, $appName)
    {
        $methodName = B()->getData($appMethodData, RouterConfig::METHOD_NAME);

        return empty($methodName) ? $appName : $methodName;
    }


    /**
     * 获取uri方法的方法类型，如果设置了方法类型，则用设置的，没有则用请求的类型
     * @param $appMethodData
     * @return array|null|string
     */
    private function getUriAppMethodType($appMethodData)
    {
        $methodType = B()->getData($appMethodData, RouterConfig::METHOD_TYPE);

        return empty($methodType) ? B()->getRequestMethod() : $methodType;
    }


    /**
     * 获取uri方法的方法参数
     * @param $appMethodData
     * @return array|null|string
     */
    private function getUriAppMethodParameter($appMethodData)
    {
        $parameter = B()->getData($appMethodData, RouterConfig::METHOD_PARAMETER);

        return (array)(is_string($parameter) ? AR()->valueToKey(explode(',', $parameter), false) : $parameter);
    }

    /**
     * 获取方法参数绑定的databean class name
     * @param $appMethodData
     * @return array
     */
    private function getUriAppMethodParameterDataBeanClassName($appMethodData)
    {
        return B()->getData($appMethodData, RouterConfig::METHOD_PARAMETER_DATABEAN_CLASS);
    }

    /**
     * 获取方法参数类型
     * @param $methodParameter
     * @return string
     */
    private function getUriAppMethodParameterType($methodParameter)
    {
        return (is_array($methodParameter) ? B()->getData($methodParameter, RouterConfig::METHOD_PARAMETER_TYPE) : $methodParameter);
    }


    /**
     * 获取方法参数默认值
     * @param $methodParameter
     * @return string
     */
    private function getUriAppMethodParameterDefault($methodParameter)
    {
        return B()->getData($methodParameter, RouterConfig::METHOD_PARAMETER_DEFAULT);
    }

    /**
     * 获取方法参数的请求类型
     * @param $methodParameter
     * @param $methodTYPE
     * @return string
     */
    private function getUriAppMethodParameterDoType($methodParameter, $methodTYPE)
    {
        return B()->contrast(B()->getData($methodParameter, RouterConfig::METHOD_PARAMETER_REQUEST_DOTYPE), $methodTYPE);
    }


    /**
     * 获取方法参数的值
     * @param $name
     * @param $doType
     * @param $default
     * @param $type
     * @param $urlParam
     * @return mixed
     * @throws ReflectionException
     */
    private function getUriAppMethodParameterValue($name, $doType, $default, $type, $urlParam)
    {
        if (substr($doType, 0, 1) == '$') {
            $doValue = B()->getData($urlParam, substr($doType, 1));
        } else {
            $doValue = I()->getRequest($name, $doType);
        }

        $value = B()->contrast($doValue, $default);

        if (empty($type)) return $value;

        if (isset(AppConfig::$SET_VAR_DEFAULT_TYPE[strtolower($type)]) ||
            strtoupper($type) === AppConfig::VAR_TYPE_JSON ||
            strtoupper($type) === AppConfig::VAR_TYPE_XML) {
            B()->setVarType($value, $type);

            $value = B()->contrast($value, $default);

            if (strtoupper($type) === AppConfig::VAR_TYPE_JSON || strtoupper($type) === AppConfig::VAR_TYPE_XML) {
                $value = (array)$value;
            }

            return $value;
        }

        if (!empty($value)) $value = B()->jsonDecode($value);

        return $this->getInstanceBean($value, $type, $urlParam);
    }

    /**
     * 获取实例化bean
     * @param $doValue
     * @param $class
     * @param $urlParam
     * @return object|null
     */
    private function getInstanceBean($doValue, $class, $urlParam)
    {
        $reflection = Reflection::getInstance($class);

        if (is_null($reflection)) return null;

        $packages = $reflection->getCurrentImportPackage();

        $methods = $reflection->getMethodsWithDoc(MappingConfig::APP_MAPPING_CONFIG_PARAM_NAME, true, true);

        $instance = $reflection->newInstance();

        foreach ($methods as $methodInfo) {
            $method = $methodInfo[Reflection::CLASS_METHOD_OBJECT_NAME];

            if (!($method instanceof ReflectionMethod)) continue;

            if (strtolower(substr($method->getName(), 0, 3)) !== 'set') continue;

            $params = $methodInfo[Reflection::CLASS_METHOD_PARAMS_NAME];

            if (empty($params)) continue;

            foreach ($params as $name => $param) {
                $doType = Reflection::getParamDocDoTypeString($param);

                $type = Reflection::getParamDocTypeString($reflection->getNamespaceName(), $packages, $param);

                $default = B()->getData($param, Reflection::METHOD_PARAM_DEFAULT_NAME);

                try {

                    if ($doValue && is_array($doValue)) {
                        $value = B()->getData($doValue, $name);
                    } else {
                        $value = $this->getUriAppMethodParameterValue($name, $doType, $default, $type, $urlParam);
                    }

                    $method->invoke($instance, $value);
                } catch (Exception $e) {

                }
            }
        }

        return $instance;
    }

    /**
     * 生成请求方法调用参数
     * @param $methodParameter
     * @param $methodType
     * @param $urlParam
     * @return array
     * @throws ReflectionException
     */
    private function getMethodParameter($methodParameter, $methodType, $urlParam)
    {
        $data = [];

        foreach ($methodParameter as $name => $value) {

            $type = $this->getUriAppMethodParameterType($value);

            $default = $this->getUriAppMethodParameterDefault($value);

            if (!is_null($default)) $default = unserialize($default);

            $doType = $this->getUriAppMethodParameterDoType($value, $methodType);

            $data[$name] = $this->getUriAppMethodParameterValue($name, $doType, $default, $type, $urlParam);
        }
        return $data;
    }

    /**
     * 执行开始，验证是否有权限验证
     * @param $className
     * @param $appName
     * @return array|null|string
     */
    private function execStart($className, $appName)
    {
        $appMethodData = null;

        $appData = $this->getUriApp($className);

        if (!is_array($appData)) return $this->ex->notFound($this->getCurrentUri());

        $appMethodData = $this->getUriAppMethod($appData, $appName);

        if ($appMethodData && B()->getRequestMethod() == $this->getUriAppMethodType($appMethodData))
            return $appMethodData;

        return $this->ex->forbidden($this->getCurrentUri(), $className, $appName);
    }

    /**
     * 实例化对象
     * @param $className
     * @param $methodType
     * @param $urlParam
     * @return object
     * @throws ReflectionException
     */
    private function newClass($className, $methodType, $urlParam)
    {
        $classData = B()->getData($this->getUriApp($className), RouterConfig::CLASS_NAME_INIT);

        if (empty($classData)) {
            return B()->reflectionInstance($className);
        } else {

            $parameter = $this->getMethodParameter($classData, $methodType, $urlParam);

            return B()->reflectionInstance($className, $parameter);
        }
    }

    /**
     * 调用class方法
     * @param $classObject
     * @param $methodName
     * @param $dataBeanClassName
     * @param $parameter
     * @return mixed
     * @throws ReflectionException
     */
    private function callUserFuncArray($classObject, $methodName, $dataBeanClassName, $parameter)
    {
        if ($dataBeanClassName != null) {
            $parameter = [B()->reflectionInstance($dataBeanClassName, [$parameter])];
        }

        return call_user_func_array([$classObject, $methodName], $parameter);
    }

    /**
     * 执行
     * @param $className
     * @param $appName
     * @param $urlParam
     * @param $appMethodData
     * @return string
     */
    public function exec($className, $appName, $urlParam, $appMethodData)
    {
        if (empty($appMethodData)) return false;

        $methodType = $this->getUriAppMethodType($appMethodData);

        $methodName = $this->getUriAppMethodName($appMethodData, $appName);

        $methodParameter = $this->getUriAppMethodParameter($appMethodData);

        $dataBeanClassName = $this->getUriAppMethodParameterDataBeanClassName($appMethodData);

        $classObject = null;

        try {
            $classObject = $this->newClass($className, $methodType, $urlParam);

            if (method_exists($classObject, $methodName)) {

                $parameter = $this->getMethodParameter($methodParameter, $methodType, $urlParam);

                $result = $this->callUserFuncArray($classObject, $methodName, $dataBeanClassName, $parameter);

                if ($result instanceof RESTFullApi) {
                    B()->setHeader(['Content-Type:text/json;']);

                    return $result->toJson();
                } else if ($result instanceof ViewInterface) {
                    $result->display();
                } else if ($result instanceof ViewTemplate) {
                    $result->view();
                } else {
                    return $result;
                }
            }
        } catch (Exception $e) {
            $this->ex->handler($e, $this->getCurrentUri(), $className, $methodName, $classObject);
        }

        return false;
    }


    /**
     * 运行
     * @param ExceptionInterface $ex
     */
    public static function run(ExceptionInterface $ex = null)
    {
        try {
            if (is_null($ex)) $ex = new ExceptionController();

            $self = new self($ex);

            $result = $self->matching($self->getCurrentUri());

            if ($result === false) $ex->notFound($self->getCurrentUri());
        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }
}