<?php


namespace rapidPHP\modules\application\classier;


abstract class Context
{

    /**
     * @var array
     */
    private $supports;

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