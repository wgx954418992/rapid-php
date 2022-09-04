<?php


namespace rapidPHP\modules\reflection\classier\annotation;

use Exception;
use rapidPHP\modules\reflection\classier\Annotation;

class Value
{
    /**
     * name
     * @var string|null
     */
    protected $atName;

    /**
     * @var string|null
     */
    protected $value;

    /**
     * Value constructor.
     * @param $atName
     * @param $value
     */
    public function __construct($atName, $value)
    {
        $this->atName = $atName;

        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getAtName(): ?string
    {
        return $this->atName;
    }

    /**
     * @return string
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * 获取分割后的values
     * @param $count
     * @return false|string[]
     */
    public function getValues($count = null)
    {
        $values = explode(" ", $this->getValue());

        if (is_int($count)) $values = array_pad($values, $count, null);

        return $values;
    }

    /**
     * @return object|Value
     * @throws Exception
     */
    public function toObject()
    {
        return Annotation::getInstance()
            ->getAnnotation($this->getAtName(), $this->getValue());
    }

    /**
     * toString
     * @return string
     */
    public function __toString(): string
    {
        return (string)$this->getValue();
    }
}
