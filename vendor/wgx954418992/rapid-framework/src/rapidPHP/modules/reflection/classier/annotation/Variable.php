<?php

namespace rapidPHP\modules\reflection\classier\annotation;

use rapidPHP\modules\reflection\config\AnnotationConfig;

class Variable extends Value
{

    /**
     * Variable constructor.
     * @param $value
     */
    public function __construct($value)
    {
        parent::__construct(AnnotationConfig::AT_VARIABLE, $value);
    }

    /**
     * @return string
     */
    public function getType(): ?string
    {
        return $this->getValue();
    }
}