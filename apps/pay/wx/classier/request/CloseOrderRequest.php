<?php

namespace pay\wx\classier\request;

use rapidPHP\modules\server\config\HttpConfig;

/**
 * 关闭订单，WxPayCloseOrder中out_trade_no必填
 * Class CloseOrderRequest
 * @package pay\wx\classier\request
 */
class CloseOrderRequest extends BaseRequest
{
    /**
     * son extends
     */
    const URL = 'https://api.mch.weixin.qq.com/pay/closeorder';

    /**
     * method son extends
     */
    const METHOD = HttpConfig::METHOD_POST;

    /**
     * 设置商户系统内部的订单号
     * @var string|null
     */
    private $out_trade_no;

    /**
     * @return string|null
     */
    public function getOutTradeNo(): ?string
    {
        return $this->out_trade_no;
    }

    /**
     * @param string|null $out_trade_no
     */
    public function setOutTradeNo(?string $out_trade_no): void
    {
        $this->out_trade_no = $out_trade_no;
    }
}