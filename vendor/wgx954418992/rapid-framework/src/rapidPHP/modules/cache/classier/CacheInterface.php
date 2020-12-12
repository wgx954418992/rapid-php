<?php

namespace rapidPHP\modules\cache\classier;

abstract class CacheInterface
{

    /**
     * @var static[]
     */
    private static $instances;

    /**
     * @return static
     */
    public static function getInstance()
    {
        if (isset(self::$instances[static::class])) {
            return self::$instances[static::class];
        } else {
            return self::$instances[static::class] = new static();
        }
    }

    /**
     * CacheInterface constructor.
     * @param mixed ...$options
     */
    abstract public function __construct(...$options);

    /**
     * 添加或者更新缓存
     * @param string $name 缓存名
     * @param $value -缓存内容
     * @param int $time 超时时间，如果是0则没有超时时间
     * @return bool
     */
    abstract public function add(string $name, $value, $time = 0): bool;

    /**
     * 获取缓存
     * @param string $name 缓存名
     * @return array|string|int|mixed|null
     */
    abstract public function get(string $name);

    /**
     * 删除缓存
     * @param string $name
     * @return bool
     */
    abstract public function remove(string $name): bool;
}