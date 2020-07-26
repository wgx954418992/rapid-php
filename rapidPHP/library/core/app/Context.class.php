<?php

namespace rapidPHP\library\core\app;

use application\context\UserContext;
use Exception;
use rapid\library\rapid;
use rapidPHP\library\cache\CacheInterface;
use rapidPHP\library\cache\CacheService;
use rapidPHP\library\core\app\exception\ExceptionController;
use rapidPHP\library\core\app\exception\ExceptionInterface;
use rapidPHP\library\core\server\Request;
use rapidPHP\library\core\server\Response;
use ReflectionClass;

class Context
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Response
     */
    protected $response;

    /**
     * @var array
     */
    protected $options = [];

    /**
     * @var ExceptionInterface
     */
    protected $exController = null;

    /**
     * Context constructor.
     * @param Request $request
     * @param Response $response
     * @param mixed ...$options
     */
    public function __construct(Request $request, Response $response, ...$options)
    {
        $this->request = $request;
        $this->response = $response;
        $this->options = array_merge($this->options, $options);
    }

    /**
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }


    /**
     * @return Response
     */
    public function getResponse(): Response
    {
        return $this->response;
    }

    /**
     * @param array $options
     */
    public function setOptions(...$options): void
    {
        $this->options = array_merge($this->options, $options);
    }

    /**
     * @param ExceptionInterface $exController
     */
    public function setExController(ExceptionInterface $exController): void
    {
        $this->exController = $exController;
    }

    /**
     * 定义参数
     * @param mixed ...$merge
     * @return array
     */
    public function supportsParameter(...$merge)
    {
        $supports = [
            Request::class => function () {
                return $this->request;
            },
            Response::class => function () {
                return $this->response;
            },
            CacheInterface::class => function () {
                return CacheService::getInstance();
            },
            ExceptionInterface::class => function () {
                if ($this->exController instanceof ExceptionInterface) {
                    return $this->exController;
                } else {
                    $this->exController = new ExceptionController($this->request, $this->response);

                    return $this->exController;
                }
            },
        ];

        if (!empty($merge)) {
            foreach ($merge as $value) {
                $supports = array_merge($supports, $value);
            }
        }

        return $supports;
    }

    /**
     * 反转
     * @param $class
     * @return string|null|false|object
     * 如果返回的是false，则可能是没找到该类，如果返回null，则是调用反转返回为空，或者调用反转异常
     */
    public function resolveArgument($class)
    {
        $defineClass = $this->supportsParameter();

        foreach ($defineClass as $support => $getter) {
            if ($support === $class) {
                return call_user_func($getter);
            } else {
                try {
                    $parentReflection = new ReflectionClass($class);

                    if ($parentReflection->isSubclassOf($support)) {
                        return call_user_func($getter);
                    }
                } catch (Exception $e) {
                    return false;
                }
            }
        }

        return false;
    }
}