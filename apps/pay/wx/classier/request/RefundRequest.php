<?php

namespace pay\wx\classier\request;

use rapidPHP\modules\server\config\HttpConfig;

/**
 * 查询退款
 * 提交退款申请后，通过调用该接口查询退款状态。退款有一定延时，
 * 用零钱支付的退款20分钟内到账，银行卡支付的退款3个工作日后重新查询退款状态。
 * WxPayRefundQuery中out_refund_no、out_trade_no、transaction_id、refund_id四个参数必填一个
 * Class RefundRequest
 * @package pay\wx\classier\request
 */
class RefundRequest extends BaseRequest
{

    /**
     * son extends
     */
    const URL = 'https://api.mch.weixin.qq.com/secapi/pay/refund';

    /**
     * method son extends
     */
    const METHOD = HttpConfig::METHOD_POST;

    /**
     * 设置微信支付分配的终端设备号，与下单一致
     * @var string|null
     */
    private $device_info;

    /**
     * 设置微信订单号
     * @var string|null
     */
    private $transaction_id;

    /**
     * 设置商户系统内部的订单号,transaction_id、out_trade_no二选一，如果同时存在优先级：transaction_id> out_trade_no
     * @var string|null
     */
    private $out_trade_no;

    /**
     * 设置商户系统内部的退款单号，商户系统内部唯一，同一退款单号多次请求只退一笔
     * @var string|null
     */
    private $out_refund_no;

    /**
     * 设置订单总金额，单位为分，只能为整数，详见支付金额
     * @var string|null
     */
    private $total_fee;

    /**
     * 设置退款总金额，订单总金额，单位为分，只能为整数，详见支付金额
     * @var string|null
     */
    private $refund_fee;

    /**
     * 设置货币类型，符合ISO 4217标准的三位字母代码，默认人民币：CNY，其他值列表详见货币类型
     * @var string|null
     */
    private $refund_fee_type;

    /**
     * 设置操作员帐号, 默认为商户号
     * @var string|null
     */
    private $op_user_id;

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
    public function getTotalFee(): ?string
    {
        return $this->total_fee;
    }

    /**
     * @param string|null $total_fee
     */
    public function setTotalFee(?string $total_fee): void
    {
        $this->total_fee = $total_fee;
    }

    /**
     * @return string|null
     */
    public function getRefundFee(): ?string
    {
        return $this->refund_fee;
    }

    /**
     * @param string|null $refund_fee
     */
    public function setRefundFee(?string $refund_fee): void
    {
        $this->refund_fee = $refund_fee;
    }

    /**
     * @return string|null
     */
    public function getRefundFeeType(): ?string
    {
        return $this->refund_fee_type;
    }

    /**
     * @param string|null $refund_fee_type
     */
    public function setRefundFeeType(?string $refund_fee_type): void
    {
        $this->refund_fee_type = $refund_fee_type;
    }

    /**
     * @return string|null
     */
    public function getOpUserId(): ?string
    {
        return $this->op_user_id;
    }

    /**
     * @param string|null $op_user_id
     */
    public function setOpUserId(?string $op_user_id): void
    {
        $this->op_user_id = $op_user_id;
    }
}