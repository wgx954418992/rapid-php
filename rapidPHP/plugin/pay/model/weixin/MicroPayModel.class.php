<?php

namespace rapidPHP\plugin\pay\model\weixin;

class MicroPayModel extends BaseModel
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
     * 设置终端设备号(商户自定义，如门店编号)
     * @var mixed
     **/
    public $device_info;


    /**
     * 设置随机字符串，不长于32位。推荐随机数生成算法
     * @var mixed
     **/
    public $nonce_str;

    /**
     * 设置商品或支付单简要描述
     * @var mixed
     **/
    public $body;


    /**
     * 设置商品名称明细列表
     * @var mixed
     **/
    public $detail;


    /**
     * 设置附加数据，在查询API和支付通知中原样返回，该字段主要用于商户携带订单的自定义数据
     * @var mixed
     **/
    public $attach;


    /**
     * 设置商户系统内部的订单号,32个字符内、可包含字母, 其他说明见商户订单号
     * @var mixed
     **/
    public $out_trade_no;


    /**
     * 设置订单总金额，单位为分，只能为整数，详见支付金额
     * @var mixed
     **/
    public $total_fee;


    /**
     * 设置符合ISO 4217标准的三位字母代码，默认人民币：CNY，其他值列表详见货币类型
     * @var mixed
     **/
    public $fee_type;


    /**
     * 设置调用微信支付API的机器IP
     * @var mixed
     **/
    public $spbill_create_ip;


    /**
     * 设置订单生成时间，格式为yyyyMMddHHmmss，如2009年12月25日9点10分10秒表示为20091225091010。详见时间规则
     * @var mixed
     **/
    public $time_start;


    /**
     * 设置订单失效时间，格式为yyyyMMddHHmmss，如2009年12月27日9点10分10秒表示为20091227091010。详见时间规则
     * @var mixed
     **/
    public $time_expire;


    /**
     * 设置商品标记，代金券或立减优惠功能的参数，说明详见代金券或立减优惠
     * @var mixed
     **/
    public $goods_tag;


    /**
     * 设置扫码支付授权码，设备读取用户微信中的条码或者二维码信息
     * @var mixed
     **/
    public $auth_code;

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
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     */
    public function setBody($body): void
    {
        $this->body = $body;
    }

    /**
     * @return mixed
     */
    public function getDetail()
    {
        return $this->detail;
    }

    /**
     * @param mixed $detail
     */
    public function setDetail($detail): void
    {
        $this->detail = $detail;
    }

    /**
     * @return mixed
     */
    public function getAttach()
    {
        return $this->attach;
    }

    /**
     * @param mixed $attach
     */
    public function setAttach($attach): void
    {
        $this->attach = $attach;
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
    public function getFeeType()
    {
        return $this->fee_type;
    }

    /**
     * @param mixed $fee_type
     */
    public function setFeeType($fee_type): void
    {
        $this->fee_type = $fee_type;
    }

    /**
     * @return mixed
     */
    public function getSpbillCreateIp()
    {
        return $this->spbill_create_ip;
    }

    /**
     * @param mixed $spbill_create_ip
     */
    public function setSpbillCreateIp($spbill_create_ip): void
    {
        $this->spbill_create_ip = $spbill_create_ip;
    }

    /**
     * @return mixed
     */
    public function getTimeStart()
    {
        return $this->time_start;
    }

    /**
     * @param mixed $time_start
     */
    public function setTimeStart($time_start): void
    {
        $this->time_start = $time_start;
    }

    /**
     * @return mixed
     */
    public function getTimeExpire()
    {
        return $this->time_expire;
    }

    /**
     * @param mixed $time_expire
     */
    public function setTimeExpire($time_expire): void
    {
        $this->time_expire = $time_expire;
    }

    /**
     * @return mixed
     */
    public function getGoodsTag()
    {
        return $this->goods_tag;
    }

    /**
     * @param mixed $goods_tag
     */
    public function setGoodsTag($goods_tag): void
    {
        $this->goods_tag = $goods_tag;
    }

    /**
     * @return mixed
     */
    public function getAuthCode()
    {
        return $this->auth_code;
    }

    /**
     * @param mixed $auth_code
     */
    public function setAuthCode($auth_code): void
    {
        $this->auth_code = $auth_code;
    }

}