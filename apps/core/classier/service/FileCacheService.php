<?php


namespace apps\core\classier\service;


use Exception;
use rapidPHP\modules\cache\classier\FileCache;

class FileCacheService extends FileCache
{

    /**
     * FileCacheService constructor.
     * @param mixed ...$options
     * @throws Exception
     */
    public function __construct(...$options)
    {
        parent::__construct(PATH_RUNTIME . 'cache/data/');
    }
}