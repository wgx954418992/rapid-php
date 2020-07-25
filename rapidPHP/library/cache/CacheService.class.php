<?php

namespace rapidPHP\library\cache;

use Exception;

class CacheService implements CacheInterface
{

    /**
     * 缓存路径
     * @var string
     */
    private $cachePath;


    /**
     * @var CacheInterface
     */
    private static $instance;

    public static function getInstance(): CacheInterface
    {
        return self::$instance instanceof self ? self::$instance : self::$instance = new self();
    }

    /**
     * CacheService constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $this->cachePath = ROOT_RUNTIME . 'cache/';

        if (!is_dir($this->cachePath) && !mkdir($this->cachePath, 0777, true))
            throw new Exception('创建缓存目录失败!');
    }

    /**
     * 获取缓存名
     * @param $name
     * @return string
     */
    private function getCacheName($name)
    {
        return $this->cachePath . md5($name);
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

        return F()->write($this->getCacheName($name), json_encode($cache));
    }

    /**
     * 获取缓存
     * @param string $name
     * @return array|mixed|null
     */
    public function get(string $name)
    {
        $cacheFile = $this->getCacheName($name);

        if (!is_file($cacheFile)) return null;

        $cache = B()->jsonDecode(file_get_contents($cacheFile));

        if (!is_array($cache)) return null;

        $time = isset($cache['time']) ? $cache['time'] : null;

        $data = B()->getData($cache, 'data');

        if (!is_int($time)) return $data;

        if (time() <= $time) {
            return $data;
        } else {
            $this->remove($name);
            return null;
        }
    }

    /**
     * 移除缓存
     * @param string $name
     * @return bool
     */
    public function remove(string $name): bool
    {
        $cacheFile = $this->getCacheName($name);

        if (!is_file($cacheFile)) return true;

        return unlink($cacheFile);
    }


}