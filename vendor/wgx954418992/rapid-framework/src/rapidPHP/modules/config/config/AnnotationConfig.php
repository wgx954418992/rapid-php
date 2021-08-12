<?php


namespace rapidPHP\modules\config\config;

use rapidPHP\modules\config\classier\annotation\Config;
use rapidPHP\modules\reflection\config\AnnotationConfig as ReflectionAnnotationConfig;

class AnnotationConfig extends ReflectionAnnotationConfig
{

    /**
     * config
     */
    const AT_CONFIG = 'config';

    /**
     * @return string[]
     */
    public static function getAtList(): array
    {
        return [
            self::AT_CONFIG => Config::class,
        ];
    }

}
