<?php

namespace rapidPHP\modules\reflection\classier;

use Exception;
use ReflectionMethod;

class Method
{

    /**
     * @var Classify
     */
    private $classify;

    /**
     * @var ReflectionMethod
     */
    private $method;

    /**
     * Method constructor.
     * @param Classify $classify
     * @param ReflectionMethod $method
     */
    public function __construct(Classify $classify, ReflectionMethod $method)
    {
        $this->classify = $classify;

        $this->method = $method;
    }

    /**
     * @return Classify
     */
    public function getClassify(): Classify
    {
        return $this->classify;
    }

    /**
     * @return ReflectionMethod
     */
    public function getMethod(): ReflectionMethod
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->getMethod()->getName();
    }

    /**
     * @param string $class
     * @return DocComment|null
     */
    public function getDocComment($class = DocComment::class)
    {
        if (method_exists($class, 'getInstance')) {
            return call_user_func([$class, 'getInstance'], $this->getMethod()->getDocComment());
        }

        return null;
    }

    /**
     * 获取反射方法的声明类
     * 等同于这个方法是哪个类的，如果是继承过来过来的，这个方法是父类还是自己的
     * @return Classify|null
     * @throws Exception
     */
    public function getDeclaringClass()
    {
        return Classify::getInstance($this->getMethod()->getDeclaringClass());
    }

    /**
     * 是否构造方法
     * @return bool
     */
    public function isConstructor()
    {
        return $this->getMethod()->isConstructor();
    }

    /**
     * 是否自身方法
     * @return bool
     */
    public function isSelf()
    {
        $declaringClass = $this->getMethod()->getDeclaringClass();

        return $declaringClass->getName() === $this->getClassify()->getName();
    }

    /**
     * 获取参数列表
     * @return Parameter[]
     */
    public function getParameters()
    {
        $parameters = $this->getMethod()->getParameters();

        $result = [];

        foreach ($parameters as $parameter) {
            $result[] = new Parameter($this, $parameter);
        }

        return $result;
    }


    /**
     * 反射调用对象的方法
     * @param $object
     * @param $data
     * @return array 返回方法修改过的参数
     * @throws Exception
     */
    public function apply($object, $data)
    {
        $parameters = Utils::getInstance()->makeMethodParameters($this, $data);

        if ($this->getMethod()->isPrivate() ||
            $this->getMethod()->isProtected()) {
            $this->getMethod()->setAccessible(true);
        }

        return $this->getMethod()->invokeArgs($object, $parameters);
    }

}