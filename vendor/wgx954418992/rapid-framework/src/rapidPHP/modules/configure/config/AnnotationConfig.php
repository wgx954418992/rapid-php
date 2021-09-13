<?php


namespace rapidPHP\modules\configure\config;

use rapidPHP\modules\configure\classier\reflection\annotation\Config;
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
