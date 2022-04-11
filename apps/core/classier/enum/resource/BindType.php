<?php


namespace apps\core\classier\enum\resource;


use enum\classier\Enum;

class BindType extends Enum
{

    /**
     * @return string
     */
    public function __toString(): string
    {
        switch ($this->constValue) {
            default:
                return '未知';
        }
    }

}
