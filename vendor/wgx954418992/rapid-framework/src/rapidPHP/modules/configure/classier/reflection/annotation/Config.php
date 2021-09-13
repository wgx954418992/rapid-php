<?php


namespace rapidPHP\modules\configure\classier\reflection\annotation;


use rapidPHP\modules\configure\config\AnnotationConfig;
use rapidPHP\modules\reflection\classier\annotation\Value;

class Config extends Value
{

    /**
     * Config constructor.
     * @param $value
     */
    public function __construct($value)
    {
        parent::__construct(AnnotationConfig::AT_CONFIG, $value);
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return trim($this->value);
    }
}
