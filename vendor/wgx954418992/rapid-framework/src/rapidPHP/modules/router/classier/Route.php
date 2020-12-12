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
     * @return string
     */
    public function getRoute(): string
    {
        return $this->route;
    }

    /**
     * @param string $route
     */
    public function setRoute(string $route): void
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
     * @return string
     */
    public function getClassName(): string
    {
        return $this->className;
    }

    /**
     * @param string $className
     */
    public function setClassName(string $className): void
    {
        $this->className = $className;
    }

    /**
     * @return string
     */
    public function getMethodName(): string
    {
        return $this->methodName;
    }

    /**
     * @param string $methodName
     */
    public function setMethodName(string $methodName): void
    {
        $this->methodName = $methodName;
    }

    /**
     * 转array
     *
     * @return array|null
     * @throws Exception
     */
    public function toArray(): ?array
    {
        return Utils::getInstance()->toArray($this);
    }
}