<?php


namespace apps\app\classier\service;


use Exception;
use rapidPHP\modules\cache\classier\FileCache;

class SessionService extends FileCache
{

    /**
     * @var SessionService
     */
    private static $instance;

    /**
     * SessionService constructor.
     * @param mixed ...$options
     * @throws Exception
     */
    public function __construct(...$options)
    {
        parent::__construct(PATH_APP_RUNTIME . 'session/');
    }

    /**
     * @return SessionService
     */
    public static function getInstance()
    {
        return self::$instance instanceof self ? self::$instance : self::$instance = new self();
    }

}