<?php


namespace rapidPHP\modules\router\classier\reflection\annotation;

use rapidPHP\modules\reflection\classier\annotation\Value;
use rapidPHP\modules\router\config\AnnotationConfig;

class Header extends Value
{

    /**
     * Header constructor.
     * @param $value
     */
    public function __construct($value)
    {
        parent::__construct(AnnotationConfig::AT_HEADER, $value);
    }
}
