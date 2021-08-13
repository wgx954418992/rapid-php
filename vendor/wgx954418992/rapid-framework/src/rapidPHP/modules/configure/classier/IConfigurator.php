<?php

namespace rapidPHP\modules\configure\classier;

use Exception;

interface IConfigurator
{

    /**
     * set paths
     * @param array $paths
     */
    public function setPaths(array $paths);

    /**
     * add path
     * @param string $path
     */
    public function addPath(string $path);

    /**
     * paths
     * @return string[]
     */
    public function getPaths(): array;

    /**
     * @return array
     */
    public function getConfig(): array;

    /**
     * 获取config value 里面的值
     * 支持 a.b.c.e
     * @param $name
     * @return array|mixed|null
     */
    public function getConfigValue($name);

    /**
     * set object properties
     * @param $object
     * @throws Exception
     */
    public static function setProperties($object);

    /**
     * 载入配置文件
     * @param bool $isAppend
     * @throws Exception
     */
    public function load(bool $isAppend = true);
}
