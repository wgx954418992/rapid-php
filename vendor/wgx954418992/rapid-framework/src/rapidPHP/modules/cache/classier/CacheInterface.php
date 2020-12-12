<?php

namespace rapidPHP\modules\cache\classier;

use rapidPHP\modules\common\classier\Instances;

abstract class CacheInterface
{

    /**
     * 采用单例模式
     */
    use Instances;

    /**
     * 实例不存在
     * @return static
     */
    public static function onNotInstance()
    {
        return new static(...func_get_args());
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