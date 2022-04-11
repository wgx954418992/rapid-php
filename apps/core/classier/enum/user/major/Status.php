<?php

namespace apps\core\classier\enum\user\major;


use enum\classier\Enum;

class Status extends Enum
{

    /**
     * 资质状态 审核中
     */
    const AUDIT = 1;

    /**
     * 资质状态 审核通过
     */
    const SUCCESS = 2;

    /**
     * 资质状态 审核不通过
     */
    const FAIL = 3;

    /**
     * 资质状态 等待支付
     */
    const PAY = 4;

    /**
     * 资质状态 资质过期
     */
    const EXPIRED = 5;

    /**
     * @return string
     */
    public function __toString(): string
    {
        switch ($this->constValue) {
            case self::PAY:
                return '待支付';
            case self::AUDIT:
                return '审核中';
            case self::SUCCESS:
                return '审核通过';
            case self::FAIL:
                return '审核不通过';
            case self::EXPIRED:
                return '资质过期';
            default:
                return '未知';
        }
    }
}
