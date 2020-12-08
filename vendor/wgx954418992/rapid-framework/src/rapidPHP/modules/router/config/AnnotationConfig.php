<?php


namespace rapidPHP\modules\router\config;

use rapidPHP\modules\reflection\config\AnnotationConfig as ReflectionAnnotationConfig;
use rapidPHP\modules\router\classier\annotation\Encode;
use rapidPHP\modules\router\classier\annotation\Header;
use rapidPHP\modules\router\classier\annotation\Method;
use rapidPHP\modules\router\classier\annotation\Route;
use rapidPHP\modules\router\classier\annotation\Template;
use rapidPHP\modules\router\classier\annotation\Typed;

class AnnotationConfig extends ReflectionAnnotationConfig
{

    /**
     * route
     */
    const AT_ROUTE = 'route';

    /**
     * header
     */
    const AT_HEADER = 'header';

    /**
     * method
     */
    const AT_METHOD = 'method';

    /**
     * typed
     */
    const AT_TYPED = 'typed';

    /**
     * template
     */
    const AT_TEMPLATE = 'template';

    /**
     * encode
     */
    const AT_ENCODE = 'encode';

    /**
     * @return string[]
     */
    public static function getAtList()
    {
        return [
            self::AT_ROUTE => Route::class,
            self::AT_HEADER => Header::class,
            self::AT_METHOD => Method::class,
            self::AT_TYPED => Typed::class,
            self::AT_TEMPLATE => Template::class,
            self::AT_ENCODE => Encode::class,
        ];
    }

}