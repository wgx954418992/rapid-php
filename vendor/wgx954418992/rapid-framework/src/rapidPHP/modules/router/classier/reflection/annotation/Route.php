<?php


namespace rapidPHP\modules\router\classier\reflection\annotation;

use rapidPHP\modules\reflection\classier\annotation\Value;
use rapidPHP\modules\router\config\AnnotationConfig;

class Route extends Value
{

    /**
     * Router constructor.
     * @param $value
     */
    public function __construct($value)
    {
        parent::__construct(AnnotationConfig::AT_ROUTE, $value);
    }

    /**
     * 获取value
     * @return string
     */
    public function getValue(): string
    {
        return rtrim(parent::getValue(), '/*');
    }
}
