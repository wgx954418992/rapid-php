<?php

namespace pay\wx\classier\request;

use rapidPHP\modules\server\config\HttpConfig;

/**
 * 查询退款
 * 提交退款申请后，通过调用该接口查询退款状态。退款有一定延时，
 * 用零钱支付的退款20分钟内到账，银行卡支付的退款3个工作日后重新查询退款状态。
 * WxPayRefundQuery中out_refund_no、out_trade_no、transaction_id、refund_id四个参数必填一个
 * Class RefundQueryRequest
 * @package pay\wx\classier\request
 */
class RefundQueryRequest extends BaseRequest
{

    /**
     * son extends
     */
    const URL = 'https://api.mch.weixin.qq.com/pay/refundquery';

    /**
     * method son extends
     */
    const METHOD = HttpConfig::METHOD_POST;

    /**
     * 设置微信支付分配的终端设备号
     * @var string|null
     */
    private $device_info;

    /**
     * 设置微信订单号
     * @var string|null
     */
    private $transaction_id;

    /**
     * 设置商户系统内部的订单号
     * @var string|null
     */
    private $out_trade_no;

    /**
     * 设置商户退款单号
     * @var string|null
     */
    private $out_refund_no;

    /**
     * 设置微信退款单号refund_id、out_refund_no、out_trade_no、transaction_id四个参数必填一个，如果同时存在优先级为：refund_id>out_refund_no>transaction_id>out_trade_no
     * @var string|null
     */
    private $refund_id;

    /**
     * @return string|null
     */
    public function getDeviceInfo(): ?string
    {
        return $this->device_info;
    }

    /**
     * @param string|null $device_info
     */
    public function setDeviceInfo(?string $device_info): void
    {
        $this->device_info = $device_info;
    }

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

    /**
     * @return string|null
     */
    public function getOutRefundNo(): ?string
    {
        return $this->out_refund_no;
    }

    /**
     * @param string|null $out_refund_no
     */
    public function setOutRefundNo(?string $out_refund_no): void
    {
        $this->out_refund_no = $out_refund_no;
    }

    /**
     * @return string|null
     */
    public function getRefundId(): ?string
    {
        return $this->refund_id;
    }

    /**
     * @param string|null $refund_id
     */
    public function setRefundId(?string $refund_id): void
    {
        $this->refund_id = $refund_id;
    }
}