<?php

namespace rapidPHP\modules\database\sql\classier\annotation;

use rapidPHP\modules\database\sql\config\AnnotationConfig;
use rapidPHP\modules\reflection\classier\annotation\Value;

class Table extends Value
{
    /**
     * Table constructor.
     * @param $value
     */
    public function __construct($value)
    {
        parent::__construct(AnnotationConfig::AT_TABLE, $value);
    }
}