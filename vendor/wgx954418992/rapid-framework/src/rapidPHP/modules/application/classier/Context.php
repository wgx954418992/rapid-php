<?php


namespace rapidPHP\modules\application\classier;


use rapidPHP\modules\router\classier\Action;
use rapidPHP\modules\router\classier\Interceptor;
use rapidPHP\modules\router\classier\Route;
use rapidPHP\modules\router\classier\Router;

abstract class Context
{

    /**
     * 解码
     */
    const OPTIONS_DECODE = 1;

    /**
     * 解码 真实path
     */
    const OPTIONS_DECODE_REALPATH = self::OPTIONS_DECODE << 1;

    /**
     * 解码 get 请求参数
     */
    const OPTIONS_DECODE_REQUEST_GET = self::OPTIONS_DECODE << 2;

    /**
     * 解码 post 请求参数
     */
    const OPTIONS_DECODE_REQUEST_POST = self::OPTIONS_DECODE << 3;

    /**
     * 解码 cookie 请求参数
     */
    const OPTIONS_DECODE_REQUEST_COOKIE = self::OPTIONS_DECODE << 6;

    /**
     * @var array
     */
    protected $supports;

    /**
     * 拦截器
     * @var Interceptor[]
     */
    protected $interceptors = [];

    /**
     * @var int
     */
    protected $decodeOptions = self::OPTIONS_DECODE;


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
     * @return int
     */
    public function getDecodeOptions(): int
    {
        return $this->decodeOptions;
    }

    /**
     * @param int $decodeOptions
     */
    public function setDecodeOptions(int $decodeOptions): void
    {
        $this->decodeOptions = $decodeOptions;
    }

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
     * 路由匹配之前
     * @param Router $router
     */
    public function onMatchingBefore(Router $router)
    {

    }

    /**
     * 调用action 方法前
     * @param Router $router
     * @param Action $action
     * @param Route $route
     * @param $pathVariable
     * @param $realPath
     */
    public function onInvokeActionBefore(Router $router, Action $action, Route $route, $pathVariable, $realPath)
    {
        foreach ($this->interceptors as $interceptor) {
            if ($interceptor->isInExclude($realPath)) {
                continue;
            } else if ($interceptor->isInRole($realPath, $role)) {
                $interceptor->onHandler($router, $action, $route, $pathVariable, $realPath, $role);
            }
        }
    }


    /**
     * 调用action 方法之后
     * @param Router $router
     * @param Action $action
     * @param Route $route
     * @param $result
     */
    public function onInvokeActionAfter(Router $router, Action $action, Route $route, &$result)
    {

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

    /**
     * 统一解码
     * @param $value
     */
    public function decode(&$value)
    {

    }
}