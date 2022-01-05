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
     * @var string|null
     */
    protected $prefix;

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
     * @return string|null
     */
    public function getPrefix(): ?string
    {
        return $this->prefix;
    }

    /**
     * @param string|null $prefix
     */
    public function setPrefix(?string $prefix): void
    {
        $this->prefix = $prefix;
    }

    /**
     * name
     * @param string $name
     * @return string
     */
    public function getName(string $name): string
    {
        if (empty($name)) return '';

        return $this->prefix . $name;
    }

    /**
     * exists
     * @param string $name
     * @return bool|int
     */
    public function exists(string $name): bool
    {
        return $this->redis->exists($this->getName($name));
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
        return $this->redis->set($this->getName($name), serialize($value), $time <= 0 ? null : $time);
    }

    /**
     * get
     * @param string $name
     * @return array|int|mixed|string|null
     */
    public function get(string $name)
    {
        if (!$this->exists($name)) return null;

        $cache = $this->redis->get($this->getName($name));

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
        return $this->redis->del($this->getName($name));
    }

    /**
     * Sets an expiration date (a timeout) on an item
     */
    public function expire(string $name, int $ttl): bool
    {
        $name = $this->getName($name);

        if ($name && $ttl > 0) {
            return $this->redis->expire($name, $ttl);
        }

        return false;
    }

    /**
     * set add
     * @param string $name
     * @param mixed ...$value
     * @return false|int
     */
    public function sAdd(string $name, ...$value)
    {
        $name = $this->getName($name);

        foreach ($value as $key => $datum) {
            $value[$key] = serialize($datum);
        }

        return $this->redis->sAdd($name, ...$value);
    }

    /**
     * set remove member
     * @param string $name
     * @param mixed ...$value
     * @return int
     */
    public function sRemoveMember(string $name, ...$value): int
    {
        $name = $this->getName($name);

        foreach ($value as $key => $datum) {
            $value[$key] = serialize($datum);
        }

        return $this->redis->sRem($name, ...$value);
    }

    /**
     * get set members
     * @param string $name
     * @return array
     */
    public function sMembers(string $name): array
    {
        $name = $this->getName($name);

        $data = $this->redis->sMembers($name);

        foreach ($data as $key => $datum) {
            $data[$key] = @unserialize($datum);
        }

        return $data;
    }

    /**
     * Checks if value is a member of the set stored at the key key.
     * @param string $name
     * @param $member
     * @return bool
     */
    public function sIsMember(string $name, $member): bool
    {
        $name = $this->getName($name);

        return $this->redis->sIsMember($name, serialize($member));
    }
}
