<?php

namespace rapidPHP\plugin\pay\model\weixin;

class RefundModel extends BaseModel
{
    /**
     * 设置微信分配的公众账号ID
     * @var mixed
     **/
    public $appid;


    /**
     * 设置微信支付分配的商户号
     * @var mixed
     **/
    public $mch_id;


    /**
     * 设置微信支付分配的终端设备号，与下单一致
     * @var mixed
     **/
    public $device_info;


    /**
     * 设置随机字符串，不长于32位。推荐随机数生成算法
     * @var mixed
     **/
    public $nonce_str;

    /**
     * 设置微信订单号
     * @var mixed
     **/
    public $transaction_id;


    /**
     * 设置商户系统内部的订单号,transaction_id、out_trade_no二选一，如果同时存在优先级：transaction_id> out_trade_no
     * @var mixed
     **/
    public $out_trade_no;


    /**
     * 设置商户系统内部的退款单号，商户系统内部唯一，同一退款单号多次请求只退一笔
     * @var mixed
     **/
    public $out_refund_no;


    /**
     * 设置订单总金额，单位为分，只能为整数，详见支付金额
     * @var mixed
     **/
    public $total_fee;


    /**
     * 设置退款总金额，订单总金额，单位为分，只能为整数，详见支付金额
     * @var mixed
     **/
    public $refund_fee;


    /**
     * 设置货币类型，符合ISO 4217标准的三位字母代码，默认人民币：CNY，其他值列表详见货币类型
     * @var mixed
     **/
    public $refund_fee_type;


    /**
     * 设置操作员帐号, 默认为商户号
     * @var mixed
     **/
    public $op_user_id;

    /**
     * @return mixed
     */
    public function getAppid()
    {
        return $this->appid;
    }

    /**
     * @param mixed $appid
     */
    public function setAppid($appid): void
    {
        $this->appid = $appid;
    }

    /**
     * @return mixed
     */
    public function getMchId()
    {
        return $this->mch_id;
    }

    /**
     * @param mixed $mch_id
     */
    public function setMchId($mch_id): void
    {
        $this->mch_id = $mch_id;
    }

    /**
     * @return mixed
     */
    public function getDeviceInfo()
    {
        return $this->device_info;
    }

    /**
     * @param mixed $device_info
     */
    public function setDeviceInfo($device_info): void
    {
        $this->device_info = $device_info;
    }

    /**
     * @return mixed
     */
    public function getNonceStr()
    {
        return $this->nonce_str;
    }

    /**
     * @param mixed $nonce_str
     */
    public function setNonceStr($nonce_str): void
    {
        $this->nonce_str = $nonce_str;
    }

    /**
     * @return mixed
     */
    public function getTransactionId()
    {
        return $this->transaction_id;
    }

    /**
     * @param mixed $transaction_id
     */
    public function setTransactionId($transaction_id): void
    {
        $this->transaction_id = $transaction_id;
    }

    /**
     * @return mixed
     */
    public function getOutTradeNo()
    {
        return $this->out_trade_no;
    }

    /**
     * @param mixed $out_trade_no
     */
    public function setOutTradeNo($out_trade_no): void
    {
        $this->out_trade_no = $out_trade_no;
    }

    /**
     * @return mixed
     */
    public function getOutRefundNo()
    {
        return $this->out_refund_no;
    }

    /**
     * @param mixed $out_refund_no
     */
    public function setOutRefundNo($out_refund_no): void
    {
        $this->out_refund_no = $out_refund_no;
    }

    /**
     * @return mixed
     */
    public function getTotalFee()
    {
        return $this->total_fee;
    }

    /**
     * @param mixed $total_fee
     */
    public function setTotalFee($total_fee): void
    {
        $this->total_fee = $total_fee;
    }

    /**
     * @return mixed
     */
    public function getRefundFee()
    {
        return $this->refund_fee;
    }

    /**
     * @param mixed $refund_fee
     */
    public function setRefundFee($refund_fee): void
    {
        $this->refund_fee = $refund_fee;
    }

    /**
     * @return mixed
     */
    public function getRefundFeeType()
    {
        return $this->refund_fee_type;
    }

    /**
     * @param mixed $refund_fee_type
     */
    public function setRefundFeeType($refund_fee_type): void
    {
        $this->refund_fee_type = $refund_fee_type;
    }

    /**
     * @return mixed
     */
    public function getOpUserId()
    {
        return $this->op_user_id;
    }

    /**
     * @param mixed $op_user_id
     */
    public function setOpUserId($op_user_id): void
    {
        $this->op_user_id = $op_user_id;
    }

}