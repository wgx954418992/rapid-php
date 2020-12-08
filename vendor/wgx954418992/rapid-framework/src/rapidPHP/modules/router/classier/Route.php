<?php

namespace rapidPHP\modules\router\classier;

use Exception;
use rapidPHP\modules\reflection\classier\Utils;

class Route
{
    /**
     * @var string
     */
    private $route;

    /**
     * @var string
     */
    private $pattern;

    /**
     * @var string
     */
    private $className;

    /**
     * @var string
     */
    private $methodName;

    /**
     * Route constructor.
     * @param $route
     * @param $pattern
     * @param $className
     * @param $methodName
     */
    public function __construct($route, $pattern, $className, $methodName)
    {
        $this->route = $route;

        $this->pattern = $pattern;

        $this->className = $className;

        $this->methodName = $methodName;
    }

    /**
     * @return mixed
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @param mixed $route
     */
    public function setRoute($route): void
    {
        $this->route = $route;
    }

    /**
     * @return string
     */
    public function getPattern(): string
    {
        return $this->pattern;
    }

    /**
     * @param string $pattern
     */
    public function setPattern(string $pattern): void
    {
        $this->pattern = $pattern;
    }

    /**
     * @return mixed
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * @param mixed $className
     */
    public function setClassName($className): void
    {
        $this->className = $className;
    }

    /**
     * @return mixed
     */
    public function getMethodName()
    {
        return $this->methodName;
    }

    /**
     * @param mixed $methodName
     */
    public function setMethodName($methodName): void
    {
        $this->methodName = $methodName;
    }

    /**
     * 转array
     *
     * @return array|null
     * @throws Exception
     */
    public function toArray()
    {
        return Utils::getInstance()->toArray($this);
    }
}