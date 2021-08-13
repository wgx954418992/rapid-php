<?php

namespace rapidPHP\modules\router\classier\reflection\annotation;

use rapidPHP\modules\reflection\classier\annotation\Value;
use rapidPHP\modules\router\config\AnnotationConfig;

class Method extends Value
{

    /**
     * Method constructor.
     * @param $value
     */
    public function __construct($value)
    {
        parent::__construct(AnnotationConfig::AT_METHOD, $value);
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return strtoupper($this->getValue());
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getMethod();
    }

}
