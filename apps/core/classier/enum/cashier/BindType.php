<?php


namespace apps\core\classier\enum\cashier;


use enum\classier\Enum;

class BindType extends Enum
{

    /**
     * 充值余额，积分等
     */
    const RECHARGE = 1;

    /**
     * 充值余额，开通会员
     */
    const OPEN_MEMBER = 2;
}
