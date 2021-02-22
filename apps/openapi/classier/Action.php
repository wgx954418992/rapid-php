<?php

namespace apps\openapi\classier;

use Exception;
use rapidPHP\modules\reflection\classier\Method;
use rapidPHP\modules\router\classier\DocComment;
use rapidPHP\modules\router\classier\Route;

class Action
{
    /**
     * @var string
     */
    private $route;

    /**
     * @var string
     */
    private $className;

    /**
     * @var string
     */
    private $methodName;

    /**
     * @var Parameter
     */
    private $parameters;

    /**
     * @var string
     */
    private $requestMethod;

    /**
     * @var string|null
     */
    private $typed;

    /**
     * Action constructor.
     * @param Route $route
     * @param Method $method
     * @throws Exception
     */
    public function __construct(Route $route, Method $method)
    {
        $this->route = $route->getRoute();

        if (strlen($this->route) > 1) {
            $this->route = '/' . ltrim($this->route, '/*');
        }

        $this->className = $route->getClassName();

        $this->methodName = $route->getMethodName();

        $this->parameters = Utils::getInstance()->getParameters($method);

        $this->requestMethod = Utils::getInstance()->getRequestMethod($method);

        /** @var DocComment $methodComment */
        $methodComment = $method->getDocComment(DocComment::class);

        $this->typed = $methodComment->getTypedAnnotation();
    }

    /**
     * @return string
     */
    public function getRoute(): string
    {
        return $this->route;
    }

    /**
     * @return string
     */
    public function getClassName(): string
    {
        return $this->className;
    }

    /**
     * @return string
     */
    public function getMethodName(): string
    {
        return $this->methodName;
    }

    /**
     * @return Parameter[]
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @param Parameter[] $parameters
     * @return void
     */
    public function setParameters(array $parameters): void
    {
        $this->parameters = $parameters;
    }

    /**
     * @return string
     */
    public function getRequestMethod(): string
    {
        return $this->requestMethod;
    }

    /**
     * @return string|null
     */
    public function getTyped(): ?string
    {
        return $this->typed;
    }
}