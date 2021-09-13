<?php

namespace rapidPHP\modules\router\classier;

use Exception;
use rapidPHP\modules\reflection\classier\Utils;
use rapidPHP\modules\router\classier\action\Parameter as ActionParameter;
use rapidPHP\modules\router\classier\action\Returned as ActionReturned;

class Action
{
    /**
     * 当前 routers index
     * @var int|null
     */
    private $index;

    /**
     * @var string|null
     */
    private $route;

    /**
     * @var string
     */
    private $methodName;

    /**
     * @var string|null
     */
    private $method;

    /**
     * @var string|null
     */
    private $typed;

    /**
     * @var string[]|null
     */
    private $header;

    /**
     * @var string|null
     */
    private $template;

    /**
     * @var ActionParameter[]|null
     */
    private $parameters;

    /**
     * @var string|null
     */
    private $encode;

    /**
     * @var ActionReturned|null
     */
    private $return;

    /**
     * @return int|null
     */
    public function getIndex(): ?int
    {
        return $this->index;
    }

    /**
     * @param int|null $index
     */
    public function setIndex(?int $index): void
    {
        $this->index = $index;
    }


    /**
     * @return string|null
     */
    public function getRoute(): ?string
    {
        return $this->route;
    }

    /**
     * @param string|null $route
     */
    public function setRoute(?string $route): void
    {
        $this->route = $route ? $route : null;
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
     * @return string|null
     */
    public function getMethod(): ?string
    {
        return $this->method;
    }

    /**
     * @param string|null $method
     */
    public function setMethod(?string $method): void
    {
        $this->method = empty($method) ? '*' : $method;
    }

    /**
     * @return string|null
     */
    public function getTyped(): ?string
    {
        return $this->typed;
    }

    /**
     * @param string|null $typed
     */
    public function setTyped(?string $typed): void
    {
        $this->typed = $typed;
    }

    /**
     * @return array[]|null
     */
    public function getHeader(): ?array
    {
        return $this->header;
    }

    /**
     * @param array[]|string|null $header
     */
    public function setHeader($header): void
    {
        if (is_array($header)) {
            $this->header = $header;
        } else {
            $this->header[] = $header;
        }
    }

    /**
     * @return string|null
     */
    public function getTemplate(): ?string
    {
        return $this->template;
    }

    /**
     * @param string|null $template
     */
    public function setTemplate(?string $template): void
    {
        $this->template = $template;
    }

    /**
     * @return ActionParameter[]|null
     */
    public function getParameters(): ?array
    {
        return $this->parameters;
    }

    /**
     * @param ActionParameter[]|null|string $parameters
     * @throws Exception
     */
    public function setParameters($parameters): void
    {
        if (is_array($parameters)) {
            foreach ($parameters as $index => $parameter) {
                if (is_array($parameter)) {
                    $parameters[$index] = Utils::getInstance()->toObject(ActionParameter::class, $parameter);
                }
            }
        }

        $this->parameters = $parameters;
    }

    /**
     * @return string|null
     */
    public function getEncode(): ?string
    {
        return $this->encode;
    }

    /**
     * @param string|null $encode
     */
    public function setEncode(?string $encode): void
    {
        $this->encode = $encode;
    }


    /**
     * @return ActionReturned|null
     */
    public function getReturned(): ?ActionReturned
    {
        return $this->return;
    }

    /**
     * @param ActionReturned|null $return
     */
    public function setReturned(?ActionReturned $return): void
    {
        $this->return = $return;
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