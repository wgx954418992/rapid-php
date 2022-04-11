<?php

namespace apps\core\classier\dao;

use apps\core\classier\exception\CacheException;
use apps\core\classier\service\RedisCacheService;
use Exception;
use rapidPHP\modules\cache\classier\CacheInterface;
use rapidPHP\modules\common\classier\Instances;
use rapidPHP\modules\common\classier\Verify;
use rapidPHP\modules\database\sql\classier\SQLDao;
use rapidPHP\modules\database\sql\classier\SQLDB;
use rapidPHP\modules\database\sql\classier\SQLSource;

abstract class MasterDao extends SQLDao
{

    /**
     * 缓存前缀
     */
    public const CACHE_PREFIX = '';

    /**
     * cache record key
     */
    public const CACHE_RECORD_KEY = '____CACHE_IDS____';

    /**
     * 使用单例模式
     */
    use Instances;

    /**
     * 当前只支持子类，如果是当前类当前不存在直接new
     * @return static
     * @throws Exception
     */
    public static function onNotInstance()
    {
        if (static::class === self::class) {
            throw new Exception('不能实例化当前类');
        }

        return new static(...func_get_args());
    }

    /**
     * MasterDao constructor.
     * @param $modelOrClass
     * @throws Exception
     */
    public function __construct($modelOrClass)
    {
        parent::__construct(self::getSQLDB(), $modelOrClass);
    }

    /**
     * @return SQLDB
     * @throws Exception
     */
    public static function getSQLDB()
    {
        return SQLSource::getInstance()->getMasterDB();
    }

    /**
     * cache
     * @return RedisCacheService
     */
    public static function getICache(): CacheInterface
    {
        return RedisCacheService::getInstance();
    }

    /**
     * 缓存缓存id
     * @return string
     */
    public function getCacheId(): string
    {
        $argv = [];

        $args = func_get_args();

        foreach ($args as $arg) {
            $argv[] = (string)$arg;
        }

        return $this::CACHE_PREFIX . '_' . join('_', $argv);
    }

    /**
     * 获取缓存
     * @param $cacheId
     * @return array|int|mixed|string|null
     * @throws CacheException
     */
    public function getCache($cacheId)
    {
        if (static::getICache()->exists($cacheId)) {
            return static::getICache()->get($cacheId);
        }

        throw new CacheException('缓存不存在', 0, $cacheId);
    }

    /**
     * 获取缓存会回调版
     * @param $cacheId
     * @param callable|null $callback
     * @param bool $isAutoCache
     * @return array|bool|int|mixed|string|null
     * @throws Exception
     */
    public function getCacheWithCallback($cacheId, ?callable $callback, bool $isAutoCache = true)
    {
        try {
            return $this->getCache($cacheId);
        } catch (CacheException $e) {
            if (is_callable($callback)) {
                $data = $callback();

                if ($isAutoCache) {
                    $this->addCache($cacheId, $data);
                }

                return $data;
            }

            return null;
        }
    }

    /**
     * cache id list
     * @param string|null $pattern
     * @return array
     */
    public function getCacheIdList(?string $pattern = null): array
    {
        try {
            $members = static::getICache()->sMembers($this->getCacheId(static::CACHE_RECORD_KEY));

            if (!empty($pattern)) {
                foreach ($members as $index => $member) {
                    $member = str_replace([static::CACHE_PREFIX . '_', static::CACHE_PREFIX], '', $member);

                    $preg = Verify::getInstance()->preg($pattern) ? preg_match($pattern, $member) : (int)($pattern == $member);

                    if (!is_int($preg) || $preg != 1) {
                        unset($members[$index]);
                    }
                }
            }

            return $members;
        } catch (Exception $e) {
            return [];
        }
    }

    /**
     * 添加缓存
     * @param $cacheId
     * @param $data
     * @return bool
     * @throws Exception
     */
    public function addCache($cacheId, $data): bool
    {
        $result = static::getICache()->add($cacheId, $data);

        if ($result) {
            static::getICache()->sAdd($this->getCacheId(static::CACHE_RECORD_KEY), $cacheId);
        }

        return $result;
    }

    /**
     * 删除缓存
     * @param $cacheId
     * @return int
     */
    public function delCache($cacheId): int
    {
        if (!is_array($cacheId)) $cacheId = [$cacheId];

        $successCount = 0;

        foreach ($cacheId as $item) {
            $result = static::getICache()->remove($item);

            if ($result) {
                static::getICache()->sRemoveMember($this->getCacheId(static::CACHE_RECORD_KEY), $item);

                $successCount++;
            }
        }

        return $successCount;
    }

}
