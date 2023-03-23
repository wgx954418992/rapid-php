<?php


namespace rapidPHP\modules\common\classier;


trait Instances
{
    /**
     * @var static[]
     */
    private static $instances = [];

    /**
     * 获取实例，如果当前类存在实例直接返回
     * 如果不存在，查找子类，如果子类存在返回子类
     * 如果还没找到，则会调用onNotInstance，子类可以进行初始，并且缓存
     * @return static
     */
    public static function getInstance()
    {
        if (isset(self::$instances[static::class])) {
            return self::$instances[static::class];
        }

        foreach (self::$instances as $instance) {
            if (is_subclass_of($instance, static::class)) return $instance;
        }

        return self::$instances[static::class] = call_user_func_array('self::onNotInstance', func_get_args());
    }

    /**
     * @return void
     */
    public static function clearInstance()
    {
        if (isset(self::$instances[static::class])) {
            unset(self::$instances[static::class]);
        }
    }

    /**
     * 实例不存在
     * @return static
     */
    public static function onNotInstance()
    {
        return null;
    }
}
