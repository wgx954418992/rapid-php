<?php

namespace rapidPHP\library\cache;

use Exception;
use rapidPHP\config\RedisConfig;
use Redis;

class RedisCacheService implements CacheInterface
{

    /**
     * @var Redis
     */
    private $redis;

    /**
     * @var
     */
    private static $instance;

    /**
     * RedisCacheService constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $this->redis = new Redis();

        $this->redis->pconnect(RedisConfig::$host, RedisConfig::$port);

        if (!empty(RedisConfig::$auth) && !$this->redis->auth(RedisConfig::$auth))
            throw new Exception('auth Fail!');

        $this->redis->select(RedisConfig::$select);
    }

    /**
     * @inheritDoc
     */
    public static function getInstance(): CacheInterface
    {
        return self::$instance instanceof self ? self::$instance : self::$instance = new self();
    }


    /**
     * 添加缓存
     * @param string $name 缓存名
     * @param $value -值
     * @param int $time 到期时间 0则没有到期时间
     * @return bool
     * @throws Exception
     */
    public function add(string $name, $value, $time = 0): bool
    {
        $cache = ['data' => $value];

        if (is_int($time) && $time > 0) $cache['time'] = time() + $time;

        return $this->redis->set($name, serialize($cache));
    }

    /**
     * 获取缓存
     * @param string $name
     * @return array|mixed|null
     */
    public function get(string $name)
    {
        $cache = $this->redis->get($name);

        if (empty($cache)) return null;

        $cache = unserialize($cache);

        if (empty($cache)) return null;

        $time = isset($cache['time']) ? $cache['time'] : null;

        $data = B()->getData($cache, 'data');

        if (!is_int($time)) return $data;

        if (time() <= $time) {
            return $data;
        } else {
            $this->remove($name);
            return $data;
        }
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