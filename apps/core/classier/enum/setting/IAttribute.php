<?php


namespace apps\core\classier\enum\setting;


use enum\classier\Enum;

abstract class IAttribute extends Enum
{

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->constValue;
    }

}
