<?php

namespace rapidPHP\library\cache;

interface CacheInterface
{

    /**
     * 获取当前实例
     * @return CacheInterface
     */
    public static function getInstance(): CacheInterface;

    /**
     * 添加或者更新缓存
     * @param string $name 缓存名
     * @param $value -缓存内容
     * @param int $time 超时时间，如果是0则没有超时时间
     * @return bool
     */
    public function add(string $name, $value, $time = 0): bool;

    /**
     * 获取缓存
     * @param string $name 缓存名
     * @return mixed
     */
    public function get(string $name);

    /**
     * 删除缓存
     * @param string $name
     * @return mixed
     */
    public function remove(string $name): bool;
}