<?php

namespace pay\wx\classier\request;

use rapidPHP\modules\server\config\HttpConfig;

/**
 * 撤销订单API接口，WxPayReverse中参数out_trade_no和transaction_id必须填写一个
 * Class ReverseRequest
 * @package pay\wx\classier\request
 */
class ReverseRequest extends BaseRequest
{

    /**
     * son extends
     */
    const URL = 'https://api.mch.weixin.qq.com/secapi/pay/reverse';

    /**
     * method son extends
     */
    const METHOD = HttpConfig::METHOD_POST;

    /**
     * 设置微信的订单号，优先使用
     * @var string|null
     */
    private $transaction_id;

    /**
     * 设置商户系统内部的订单号,transaction_id、out_trade_no二选一，如果同时存在优先级：transaction_id> out_trade_no
     * @var string|null
     */
    private $out_trade_no;

    /**
     * @return string|null
     */
    public function getTransactionId(): ?string
    {
        return $this->transaction_id;
    }

    /**
     * @param string|null $transaction_id
     */
    public function setTransactionId(?string $transaction_id): void
    {
        $this->transaction_id = $transaction_id;
    }

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