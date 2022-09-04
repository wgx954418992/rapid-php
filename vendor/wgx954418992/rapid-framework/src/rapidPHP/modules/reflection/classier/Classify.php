<?php


namespace rapidPHP\modules\reflection\classier;

use Exception;
use rapidPHP\modules\common\classier\Build;
use rapidPHP\modules\common\classier\File;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;

class Classify
{

    /**
     * 构造函数名称
     */
    const CONSTRUCTOR_NAME = '__construct';

    /**
     * @var ReflectionClass
     */
    protected $reflection;

    /**
     * Classify constructor.
     * @param $argument
     * @throws ReflectionException
     */
    public function __construct($argument)
    {
        if ($argument instanceof ReflectionClass) {
            $this->reflection = $argument;
        } else {
            $this->reflection = new ReflectionClass($argument);
        }
    }

    /**
     * @return ReflectionClass
     */
    public function getReflectionClass()
    {
        return $this->reflection;
    }

    /***
     * 获取实例
     * @param $name
     * @return Classify|static
     * @throws Exception
     */
    public static function getInstance($name)
    {
        if (!$name) {
            throw new Exception('Classify name empty');
        }

        try {
            return new Classify($name);
        } catch (Exception $e) {
            throw new Exception('Classify getInstance ' . $name . ' error:' . $e->getMessage());
        }
    }

    /**
     * @return string
     */
    public function getNamespaceName(): string
    {
        return $this->reflection->getNamespaceName();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->reflection->getName();
    }

    /**
     * @return false|string
     */
    public function getFileName()
    {
        return $this->reflection->getFileName();
    }

    /**
     * @template T
     * @param object|T|static|string $class
     * @return DocComment|\rapidPHP\modules\router\classier\reflection\DocComment|T|null
     */
    public function getDocComment($class = DocComment::class)
    {
        if (method_exists($class, 'getInstance')) {
            return call_user_func([$class, 'getInstance'], $this->reflection->getDocComment());
        }

        return null;
    }

    /**
     * @return array
     */
    public function getInterfaceNames(): array
    {
        return $this->reflection->getInterfaceNames();
    }

    /**
     * @return object
     * @throws ReflectionException
     */
    public function newInstance()
    {
        return $this->reflection->newInstance(...func_get_args());
    }

    /**
     * @param array|null $args
     * @return object
     * @throws ReflectionException
     */
    public function newInstanceArgs(array $args = null)
    {
        return $this->reflection->newInstanceArgs($args);
    }

    /**
     * 通过k=>v数组来初始化一个实例
     * @param $args
     * @return object
     * @throws Exception
     */
    public function newInstanceKV($args = null)
    {
        $constructor = $this->reflection->getConstructor();

        if (is_null($constructor)) return $this->reflection->newInstance();

        $method = new Method($this, $this->reflection->getConstructor());

        $parameters = Utils::getInstance()->makeMethodParameters($method, $args);

        return $this->reflection->newInstanceArgs($parameters);
    }

    /**
     * 获取构造函数
     * @return Method|null
     */
    public function getConstructor()
    {
        $constructor = $this->reflection->getConstructor();

        if ($constructor == null) return null;

        return new Method($this, $constructor);
    }

    /**
     * @return Classify|null
     * @throws Exception
     */
    public function getParentClassify()
    {
        $parent = $this->reflection->getParentClass();

        if (!$parent) return null;

        return Classify::getInstance($parent);
    }

    /**
     * 获取文件里面使用所有use 导入的包
     * @return array
     */
    public function getImportPackage(): array
    {
        $result = [];

        $contents = explode("\n", File::getInstance()->getContent($this->getFileName()));

        foreach ($contents as $v) {
            if (strtolower(substr($v, 0, 3)) === 'use') {
                $use = Build::getInstance()->getRegular('/^use (.*(as \w+)?);$/i', $v);

                $useInfo = explode(" as ", $use);

                $className = trim(Build::getInstance()->getData($useInfo, 0));

                if (empty($className)) continue;

                $asName = trim(Build::getInstance()->getData($useInfo, 1));

                if (empty($asName)) {
                    $classInfo = explode("\\", $className);

                    $asName = trim(end($classInfo));

                    if (empty($asName)) continue;
                }

                $result[$asName] = $className;
            }
        }

        return $result;
    }

    /**
     * 获取属性
     * @param string $name
     * @return Property
     * @throws ReflectionException
     */
    public function getProperty(string $name)
    {
        return new Property($this, $this->reflection->getProperty($name));
    }

    /**
     * 获取属性
     * @param $filter
     * @return Property[]
     * @throws Exception
     */
    public function getProperties($filter = null): array
    {
        $filterCall = null;

        $filterValue = null;

        if (is_callable($filter)) {
            $filterCall = $filter;
        } else if (is_array($filter)) {
            list($filterValue, $filterCall) = $filter;
        } else {
            $filterValue = $filter;
        }

        if (!is_null($filterValue)){
            $attributes = $this->reflection->getProperties($filterValue);
        }else{
            $attributes = $this->reflection->getProperties();
        }

        $result = [];

        foreach ($attributes as $attribute) {
            $property = new Property($this, $attribute);

            if (is_callable($filterCall)) {
                if (!call_user_func_array($filterCall, [$property])) continue;
            }

            $result[] = $property;
        }

        if ($parentClassify = $this->getParentClassify()) {
            $parentProperties = $parentClassify->getProperties($filter);

            if (count($parentProperties) > 0) $result = array_merge($result, $parentProperties);
        }

        return $result;
    }

    /**
     * 获取方法
     * @param string $name
     * @return Method
     * @throws ReflectionException
     */
    public function getMethod(string $name)
    {
        return new Method($this, $this->reflection->getMethod($name));
    }

    /**
     * 效验方法是否在当前class里面
     * @param $name
     * @return bool
     */
    public function hasMethodInCurrent($name): bool
    {
        $methods = $this->reflection->getMethods();

        foreach ($methods as $method) {
            $declaringClass = $method->getDeclaringClass();

            if ($declaringClass->getName() === $this->reflection->getName() && $method->getName() === $name) {
                return true;
            }
        }
        return false;
    }

    /**
     * 获取方法列表
     * @param $filter
     * @return Method[]
     */
    public function getMethods($filter = null): array
    {
        $filterCall = null;

        $filterValue = null;

        if (is_callable($filter)) {
            $filterCall = $filter;
        } else if (is_array($filter)) {
            list($filterValue, $filterCall) = $filter;
        } else {
            $filterValue = $filter;
        }

        $methods = $this->reflection->getMethods($filterValue);

        $result = [];

        foreach ($methods as $method) {
            $method = new Method($this, $method);

            if (is_callable($filterCall)) {
                if (!call_user_func_array($filterCall, [$method])) continue;
            }

            $result[] = $method;
        }

        return $result;
    }

    /**
     * 获取set 方法
     * @param int|callable $filter
     * @return Method[]
     */
    public function getSetterMethods($filter = ReflectionMethod::IS_PUBLIC): array
    {
        return $this->getMethods([$filter, function (Method $method) {

            $name = strtolower($method->getName());

            return substr($name, 0, 3) === 'set';
        }]);
    }

    /**
     * 获取get 方法
     * @param int|callable $filter
     * @return Method[]
     */
    public function getGetterMethods($filter = ReflectionMethod::IS_PUBLIC): array
    {
        return $this->getMethods([$filter, function (Method $method) {
            $name = strtolower($method->getName());

            return substr($name, 0, 3) === 'get';
        }]);
    }

    /**
     * 获取属性字段
     * @param $filter
     * @return array|null
     */
    public function getPropertiesNames($filter = null): ?array
    {
        try {
            $properties = $this->getProperties($filter);

            $result = [];

            foreach ($properties as $property) {
                $result[] = $property->getName();
            }

            return $result;
        } catch (Exception $e) {
            return null;
        }
    }
}
