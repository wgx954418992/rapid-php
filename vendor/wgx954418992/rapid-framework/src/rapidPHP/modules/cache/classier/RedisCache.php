<?php

namespace rapidPHP\modules\cache\classier;

use Exception;
use rapidPHP\modules\redis\classier\Redis;

class RedisCache extends CacheInterface
{

    /**
     * @var Redis
     */
    protected $redis;

    /**
     * RedisCache constructor.
     * @param mixed ...$options
     * @throws Exception
     */
    public function __construct(...$options)
    {
        $this->redis = $options[0] ?? null;

        if (!($this->redis instanceof Redis)) throw new Exception('redis instance error!');
    }

    /**
     * exists
     * @param string $name
     * @return bool|int
     */
    public function exists(string $name): bool
    {
        return $this->redis->exists($name);
    }


    /**
     * add
     * @param string $name
     * @param $value
     * @param int $time
     * @return bool
     * @throws Exception
     */
    public function add(string $name, $value, int $time = 0): bool
    {
        return $this->redis->set($name, serialize($value), $time <= 0 ? null : $time);
    }

    /**
     * get
     * @param string $name
     * @return array|int|mixed|string|null
     */
    public function get(string $name)
    {
        if (!$this->exists($name)) return null;

        $cache = $this->redis->get($name);

        if (empty($cache)) return null;

        $cache = unserialize($cache);

        if (empty($cache)) return null;

        return $cache;
    }

    /**
     * 移除缓存
     * @param string $name
     * @return bool
     */
    public function remove(string $name): bool
    {
        return $this->redis->del($name);
    }
}
