<?php

namespace rapidPHP\plugin\pay\model\weixin;

class RefundQueryModel extends BaseModel
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
     * 设置微信支付分配的终端设备号
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
     * 设置商户系统内部的订单号
     * @var mixed
     **/
    public $out_trade_no;


    /**
     * 设置商户退款单号
     * @var mixed
     **/
    public $out_refund_no;


    /**
     * 设置微信退款单号refund_id、out_refund_no、out_trade_no、transaction_id四个参数必填一个，如果同时存在优先级为：refund_id>out_refund_no>transaction_id>out_trade_no
     * @var mixed
     **/
    public $refund_id;

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
    public function getRefundId()
    {
        return $this->refund_id;
    }

    /**
     * @param mixed $refund_id
     */
    public function setRefundId($refund_id): void
    {
        $this->refund_id = $refund_id;
    }

}