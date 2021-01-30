<?php


namespace rapidPHP\modules\application\classier;


use rapidPHP\modules\router\classier\Action;
use rapidPHP\modules\router\classier\Interceptor;
use rapidPHP\modules\router\classier\Route;
use rapidPHP\modules\router\classier\Router;

abstract class Context
{

    /**
     * @var array
     */
    private $supports;

    /**
     * 拦截器
     * @var Interceptor[]
     */
    private $interceptors = [];

    /**
     * @return array
     */
    public function getInterceptors(): array
    {
        return $this->interceptors;
    }

    /**
     * 添加拦截器
     * @param Interceptor $interceptors
     */
    public function addInterceptor(Interceptor $interceptors): void
    {
        $this->interceptors[] = $interceptors;
    }

    /**
     * Context constructor.
     */
    public function __construct()
    {
        $this->supports = [
            Context::class => $this,
        ];
    }

    /**
     * 路由匹配之前
     * @param Router $router
     */
    public function onMatchingBefore(Router $router)
    {

    }

    /**
     * 调用action 方法前
     * @param Router $router
     * @param Route $route
     * @param Action $action
     * @param $pathVariable
     */
    public function onInvokeActionBefore(Router $router, Action $action, Route $route, $pathVariable, $realPath)
    {
        foreach ($this->interceptors as $interceprtor) {
            if ($interceprtor->isInExclude($realPath)) {
                continue;
            } else if ($interceprtor->isInRole($realPath, $role)) {
                $interceprtor->onHandler($router, $action, $route, $pathVariable, $realPath, $role);
            }
        }
    }

    /**
     * 定义参数
     * @param mixed ...$merge
     */
    public function supportsParameter(...$merge)
    {
        if (empty($merge)) return;

        foreach ($merge as $value) {
            $this->supports = array_merge($this->supports, $value);
        }
    }

    /**
     * 反转
     * @param $class
     * @param mixed ...$supports
     * @return string|null|false|object
     * 如果返回的是false，则可能是没找到该类，如果返回null，则是调用反转返回为空，或者调用反转异常
     */
    public function resolveArgument($class, ...$supports)
    {
        if (empty($class)) return false;

        $supports = array_merge($this->supports, ...$supports);

        $class = ltrim($class, '\\');

        foreach ($supports as $support => $getter) {
            if ($support === $class) {
                return !is_callable($getter) ? $getter : call_user_func($getter);
            } else if (is_subclass_of($support, $class)) {
                return !is_callable($getter) ? $getter : call_user_func($getter);
            }
        }

        return false;
    }
}