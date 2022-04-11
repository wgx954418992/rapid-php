<?php


namespace apps\core\classier\enum\pay;


use enum\classier\Enum;

class Type extends Enum
{

    /**
     * 微信支付
     */
    const WECHAT = 'wechat';

    /**
     * 微信小程序支付
     */
    const WECHAT_MINI = 'wechat_mini';

    /**
     * 支付宝支付
     */
    const ALIPAY = 'alipay';

    /**
     * 钱包支付
     */
    const WALLET = 'wallet';
}
