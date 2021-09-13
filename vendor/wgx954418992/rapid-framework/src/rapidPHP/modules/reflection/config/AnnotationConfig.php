<?php


namespace rapidPHP\modules\reflection\config;


use rapidPHP\modules\reflection\classier\annotation\Parameter;
use rapidPHP\modules\reflection\classier\annotation\Returned;
use rapidPHP\modules\reflection\classier\annotation\Variable;

class AnnotationConfig
{
    /**
     * param
     */
    const AT_PARAM = 'param';

    /**
     * return
     */
    const AT_RETURNED = 'return';

    /**
     * var
     */
    const AT_VARIABLE = 'var';

    /**
     * @return string[]
     */
    public static function getAtList(): array
    {
        return [
            self::AT_PARAM => Parameter::class,
            self::AT_RETURNED => Returned::class,
            self::AT_VARIABLE => Variable::class,
        ];
    }
}