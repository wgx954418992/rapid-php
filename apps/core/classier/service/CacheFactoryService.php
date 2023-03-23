<?php


namespace apps\core\classier\service;


use Exception;
use rapidPHP\modules\cache\classier\CacheInterface;
use rapidPHP\modules\cache\classier\FileCache;

class CacheFactoryService
{

    /**
     * @return CacheInterface
     */
    public static function getICache(): CacheInterface
    {
        return RedisCacheService::getInstance();
    }
}