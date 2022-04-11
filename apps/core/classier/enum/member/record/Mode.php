<?php


namespace apps\core\classier\enum\member\record;


use enum\classier\Enum;

class Mode extends Enum
{

    /**
     * 开通方式=》1 充值开通
     */
    const PAY = 1;

    /**
     * 开通方式=》2后台开通
     */
    const ADMIN = 2;
}
