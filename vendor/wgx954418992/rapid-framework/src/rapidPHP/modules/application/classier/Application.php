<?php


namespace rapidPHP\modules\application\classier;

use Exception;
use rapidPHP\modules\application\wrapper\ConfigWrapper;
use rapidPHP\modules\common\classier\Instances;
use rapidPHP\modules\config\classier\PConfig;
use rapidPHP\modules\logger\classier\Logger;
use rapidPHP\modules\reflection\classier\Utils;


abstract class Application
{

    /**
     * 采用单例模式
     */
    use Instances;

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
     * @var PConfig
     */
    protected $config;

    /**
     * @var ConfigWrapper
     */
    protected $configWrapper;

    /**
     * Application constructor.
     * @param PConfig $config
     * @throws Exception
     */
    public function __construct(PConfig $config)
    {
        self::$instances[static::class] = $this;

        $this->config = $config;

        $this->configWrapper = Utils::getInstance()->toObject(ConfigWrapper::class, $config->getConfig());
    }

    /**
     * @return PConfig
     */
    public function getConfig(): PConfig
    {
        return $this->config;
    }

    /**
     * @return ConfigWrapper
     */
    public function getConfigWrapper()
    {
        return $this->configWrapper;
    }

    /**
     * 获取logger
     * @param string $name
     * @return Logger|null
     * @throws Exception
     */
    public function logger(string $name = self::LOGGER_WARNING): ?Logger
    {
        $config = $this->getConfigWrapper()->getLogConfig($name);

        if (empty($config)) return null;

        return Logger::getLogger($config);
    }

    /**
     * 运行
     */
    abstract public function run();
}
