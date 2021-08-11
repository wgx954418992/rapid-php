<?php

namespace rapidPHP\modules\reflection\classier;

use Exception;
use ReflectionException;
use ReflectionMethod;

class Method
{

    /**
     * @var Classify
     */
    protected $classify;

    /**
     * @var ReflectionMethod
     */
    protected $method;

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
    public function getClassify()
    {
        return $this->classify;
    }

    /**
     * @return ReflectionMethod
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->getMethod()->getName();
    }

    /**
     * @template T
     * @param object|T|static|string $class
     * @return DocComment|\rapidPHP\modules\router\classier\DocComment|T|null
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
    public function isConstructor(): bool
    {
        return $this->getMethod()->isConstructor();
    }

    /**
     * 是否自身方法
     * @return bool
     */
    public function isSelf(): bool
    {
        $declaringClass = $this->getMethod()->getDeclaringClass();

        return $declaringClass->getName() === $this->getClassify()->getName();
    }

    /**
     * 获取参数列表
     * @return Parameter[]
     */
    public function getParameters(): array
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
     * @return mixed
     * @throws ReflectionException
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
