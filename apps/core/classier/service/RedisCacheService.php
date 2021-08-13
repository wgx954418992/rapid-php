<?php


namespace apps\core\classier\service;


use Exception;
use rapidPHP\modules\application\classier\Application;
use rapidPHP\modules\cache\classier\RedisCache;
use rapidPHP\modules\redis\classier\Redis;

class RedisCacheService extends RedisCache
{

    /**
     * RedisCacheService constructor.
     * @param mixed ...$options
     * @throws Exception
     */
    public function __construct(...$options)
    {
        $config = Application::getInstance()
            ->getConfigWrapper()
            ->getRedis()
            ->getMaster();

        $redis = new Redis($config);

        parent::__construct($redis);
    }
}
