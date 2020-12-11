<?php


namespace rapidPHP\modules\application\config;


use Exception;
use rapidPHP\modules\common\classier\Modules;

class ApplicationConfig
{
    /**
     * 模块名称
     */
    const MODULE_NAME = 'application';

    /**
     * 默认配置文件名
     */
    const DEFAULT_CONFIG_FILENAME = 'default.config.php';

    /**
     * 获取app默认配置
     * @return array
     * @throws Exception
     */
    public static function getDefaultConfig(): array
    {
        $file = Modules::getInstance()->getModulesResourcePath(self::MODULE_NAME) . self::DEFAULT_CONFIG_FILENAME;

        if (!is_file($file)) throw new Exception('config file error!');

        return require $file . '';
    }
}