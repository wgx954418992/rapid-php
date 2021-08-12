<?php


namespace rapidPHP\modules\core\classier;


class DI
{

    /**
     * @var array
     */
    protected static $supports = [];

    /**
     * 定义参数
     */
    public static function supportParameter()
    {
        $parameters = func_get_args();

        if (empty($parameters)) return;

        if (count($parameters) == 2) {
            $parameters = [$parameters[0] => $parameters[1]];
        }

        self::$supports = array_merge(self::$supports, $parameters);
    }

    /**
     * 定义参数
     * @param mixed ...$merge
     */
    public static function supportsParameter(...$merge)
    {
        if (empty($merge)) return;

        foreach ($merge as $value) {
            self::$supports = array_merge(self::$supports, $value);
        }
    }


    /**
     * 反转
     * @template T
     * @param $class
     * @param mixed ...$supports
     * @return T|false
     * 如果返回的是false，则可能是没找到该类，如果返回null，则是调用反转返回为空，或者调用反转异常
     */
    public static function resolveArgument($class, ...$supports)
    {
        if (empty($class)) return false;

        $supports = array_merge(self::$supports, ...$supports);

        $class = ltrim($class, '\\');

        foreach ($supports as $support => $getter) {
            if ($support === $class) {
                return $supports[$support] = !is_callable($getter) ? $getter : call_user_func($getter);
            } else if (is_subclass_of($support, $class)) {
                return $supports[$support] = !is_callable($getter) ? $getter : call_user_func($getter);
            }
        }

        return false;
    }
}
