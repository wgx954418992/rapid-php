<?php


namespace apps\app\classier\service;


use Exception;
use rapidPHP\modules\cache\classier\FileCache;

class SessionService extends FileCache
{

    /**
     * SessionService constructor.
     * @param mixed ...$options
     * @throws Exception
     */
    public function __construct(...$options)
    {
        parent::__construct(PATH_APP_RUNTIME . 'session/');
    }
}