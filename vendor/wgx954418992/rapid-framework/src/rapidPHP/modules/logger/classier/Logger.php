<?php

namespace rapidPHP\modules\logger\classier;

use Exception;
use Monolog\Logger as Monolog;
use Monolog\Handler\StreamHandler;
use rapidPHP\modules\common\classier\File;
use rapidPHP\modules\logger\config\LoggerConfig;

class Logger extends Monolog
{

    /**
     * @var Logger[]
     */
    protected static $instances = [];

    /**
     * @var LoggerConfig
     */
    protected $config;

    /**
     * Logger constructor.
     * @param LoggerConfig $config
     * @throws Exception
     */
    public function __construct(LoggerConfig $config)
    {
        parent::__construct($config->getName());

        $this->config = $config;

        $this->addStreamHandler();
    }

    /**
     * @throws Exception
     */
    private function addStreamHandler()
    {
        $this->handlers = [];

        $filename = self::getLogFilename($this->config->getPath(), $this->config->getSize());

        $this->pushHandler(new StreamHandler($filename, Monolog::DEBUG));
    }

    /**
     * 更新路径
     * @throws Exception
     */
    public function update()
    {
        $filename = self::getLogFilename($this->config->getPath(), $this->config->getSize());

        if ($filename != $this->config->getPath()) {
            $this->addStreamHandler();
        }
    }

    /**
     * 获取实例，会通过name缓存
     * @param LoggerConfig $config
     * @return Logger
     * @throws Exception
     */
    public static function getLogger(LoggerConfig $config): Logger
    {
        $name = $config->getName();

        if (isset(self::$instances[$name])) {
            $logger = self::$instances[$name];

            $logger->update();

            return $logger;
        }

        return self::$instances[$name] = new Logger($config);
    }


    /**
     * 获取log 文件名
     * @param $path
     * @param $size
     * @return string|string[]
     * @throws Exception
     */
    public static function getLogFilename($path, $size)
    {
        $dir = pathinfo($path, PATHINFO_DIRNAME);

        if (!is_dir($dir) && !mkdir($dir, 0777, true)) throw new Exception('create log dir error!:' . $dir);

        $fileCount = 1;

        $filename = null;

        while ($filename == null) {
            $tempFilename = str_replace(['{number}'], $fileCount, $path);

            if (!is_file($tempFilename)) {
                $filename = $tempFilename;
                break;
            } else {
                $filesize = File::getInstance()->getMaxFileSize($tempFilename);

                if ($filesize < $size) {
                    $filename = $tempFilename;
                    break;
                }
            }

            $fileCount++;
        }

        return $filename;
    }

}
