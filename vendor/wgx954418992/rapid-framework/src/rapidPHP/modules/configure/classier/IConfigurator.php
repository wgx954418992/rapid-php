<?php

namespace rapidPHP\modules\configure\classier;

use Exception;

interface IConfigurator
{

    /**
     * observer
     * @param callable $callback
     * @return static
     */
    public function observer(callable $callback);

    /**
     * set paths
     * @param array $paths
     * @return static
     */
    public function setPaths(array $paths);

    /**
     * add path
     * @param string $path
     * @return static
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
    public function getValue($name);

    /**
     * set object properties
     * @param $object
     * @throws Exception
     */
    public function setProperties($object);

    /**
     * 载入配置文件
     * @param bool $isAppend
     * @throws Exception
     * @return static
     */
    public function load(bool $isAppend = true);
}
