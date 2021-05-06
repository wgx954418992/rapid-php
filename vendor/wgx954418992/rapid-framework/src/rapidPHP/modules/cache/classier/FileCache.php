<?php

namespace rapidPHP\modules\cache\classier;

use Exception;
use rapidPHP\modules\common\classier\Build;
use rapidPHP\modules\common\classier\File;

class FileCache extends CacheInterface
{

    /**
     * 缓存路径
     * @var string
     */
    private $cachePath;

    /**
     * FileCache constructor.
     * @param mixed ...$options
     * @throws Exception
     */
    public function __construct(...$options)
    {
        $this->cachePath = isset($options[0]) ? $options[0] : null;

        if (empty($this->cachePath)) throw new Exception('cache path error!');

        if (!is_dir($this->cachePath) && !mkdir($this->cachePath, 0777, true))
            throw new Exception('创建缓存目录失败!');
    }

    /**
     * 获取缓存名
     * @param $name
     * @return string
     */
    private function getCacheName($name): string
    {
        return $this->cachePath . md5($name);
    }

    /**
     * exists
     * @param $name
     * @return bool|mixed
     */
    public function exists($name)
    {
        $cacheFile = $this->getCacheName($name);

        return is_file($cacheFile);
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

        return File::getInstance()->write($this->getCacheName($name), serialize($cache));
    }

    /**
     * 获取缓存
     * @param string $name
     * @return array|string|int|mixed|null
     */
    public function get(string $name)
    {
        $cacheFile = $this->getCacheName($name);

        if (!is_file($cacheFile)) return null;

        $cache = unserialize(file_get_contents($cacheFile));

        if (empty($cache)) return null;

        $time = isset($cache['time']) ? $cache['time'] : null;

        $data = Build::getInstance()->getData($cache, 'data');

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