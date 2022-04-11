<?php


namespace apps\admin\classier\enum\admin;


use enum\classier\Enum;

class Type extends Enum
{
    /**
     * 管理员账号类型，web管理系统
     */
    const WEB = 1;

    /**
     * @return string
     */
    public function __toString(): string
    {
        switch ($this->constValue) {
            case self::WEB:
                return 'web管理系统';
            default:
                return '类型错误';
        }
    }
}
