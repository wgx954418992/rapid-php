<?php


namespace apps\core\classier\enum\user;


use enum\classier\Enum;

class Gender extends Enum
{

    /**
     * 男
     */
    const MAN = 1;

    /**
     * 女
     */
    const WOMAN = 2;

    /**
     * @return string
     */
    public function __toString(): string
    {
        switch ($this->constValue) {
            case self::MAN:
                return '男';
            case self::WOMAN:
                return '女';
            default:
                return '未知';
        }
    }
}
