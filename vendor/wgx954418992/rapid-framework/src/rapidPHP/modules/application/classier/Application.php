<?php


namespace rapidPHP\modules\application\classier;

use Exception;
use rapidPHP\Init;
use rapidPHP\modules\application\classier\apps\CGIApplication;
use rapidPHP\modules\application\classier\apps\SwooleHttpApplication;
use rapidPHP\modules\application\classier\apps\SwooleWebsocketApplication;
use rapidPHP\modules\application\classier\apps\WebApplication;
use rapidPHP\modules\application\wrapper\ConfigWrapper;
use rapidPHP\modules\logger\classier\Logger;


abstract class Application
{

    /**
     * logger error
     */
    const LOGGER_ERROR = 'error';

    /**
     * logger warning
     */
    const LOGGER_WARNING = 'warning';

    /**
     * logger debug
     */
    const LOGGER_DEBUG = 'debug';

    /**
     * logger access
     */
    const LOGGER_ACCESS = 'access';

    /**
     * @var Init
     */
    private $init;

    /**
     * @var Application[]
     */
    private static $instances;

    /**
     * @return static|WebApplication|CGIApplication|SwooleHttpApplication|SwooleWebsocketApplication|null
     */
    public static function getInstance()
    {
        return static::$instances[static::class];
    }

    /**
     * Application constructor.
     * @param Init $init
     */
    public function __construct(Init $init)
    {
        self::$instances[static::class] = $this;

        $this->init = $init;
    }

    /**
     * @return Init
     */
    public function getInit(): Init
    {
        return $this->init;
    }

    /**
     * @return array|ConfigWrapper
     */
    public function getConfig()
    {
        return $this->getInit()->getConfig();
    }

    /**
     * 获取logger
     * @param string $name
     * @return Logger|null
     * @throws Exception
     */
    public function logger($name = self::LOGGER_WARNING): ?Logger
    {
        $config = $this->getConfig()->getLogConfig($name);

        if (empty($config)) return null;

        return Logger::getLogger($config);
    }

    /**
     * 运行
     */
    abstract public function run();
}