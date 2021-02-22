<?php

namespace pay\wx\classier\request;

use rapidPHP\modules\server\config\HttpConfig;

/**
 * Class MicroPayRequest
 * 被扫支付API
 * 收银员使用扫码设备读取微信用户刷卡授权码以后，二维码或条码信息传送至商户收银台，
 * 由商户收银台或者商户后台调用该接口发起支付。
 * WxPayWxPayMicroPay中body、out_trade_no、total_fee、auth_code参数必填
 * @package pay\wx\classier\request
 */
class MicroPayRequest extends BaseRequest
{

    /**
     * son extends
     */
    const URL = 'https://api.mch.weixin.qq.com/pay/micropay';

    /**
     * method son extends
     */
    const METHOD = HttpConfig::METHOD_POST;

    /**
     * 设置终端设备号(商户自定义，如门店编号)
     * @var string|null
     */
    private $device_info;

    /**
     * 设置商品或支付单简要描述
     * @var string|null
     */
    private $body;

    /**
     * 设置商品名称明细列表
     * @var string|null
     */
    private $detail;

    /**
     * 设置附加数据，在查询API和支付通知中原样返回，该字段主要用于商户携带订单的自定义数据
     * @var string|null
     */
    private $attach;

    /**
     * 设置商户系统内部的订单号,32个字符内、可包含字母, 其他说明见商户订单号
     * @var string|null
     */
    private $out_trade_no;

    /**
     * 设置订单总金额，单位为分，只能为整数，详见支付金额
     * @var string|null
     */
    private $total_fee;

    /**
     * 设置符合ISO 4217标准的三位字母代码，默认人民币：CNY，其他值列表详见货币类型
     * @var string|null
     */
    private $fee_type;

    /**
     * 设置调用微信支付API的机器IP
     * @var string|null
     */
    private $spbill_create_ip;

    /**
     * 设置订单生成时间，格式为yyyyMMddHHmmss，如2009年12月25日9点10分10秒表示为20091225091010。详见时间规则
     * @var string|null
     */
    private $time_start;

    /**
     * 设置订单失效时间，格式为yyyyMMddHHmmss，如2009年12月27日9点10分10秒表示为20091227091010。详见时间规则
     * @var string|null
     */
    private $time_expire;

    /**
     * 设置商品标记，代金券或立减优惠功能的参数，说明详见代金券或立减优惠
     * @var string|null
     */
    private $goods_tag;

    /**
     * 设置扫码支付授权码，设备读取用户微信中的条码或者二维码信息
     * @var string|null
     */
    private $auth_code;

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
    public function getBody(): ?string
    {
        return $this->body;
    }

    /**
     * @param string|null $body
     */
    public function setBody(?string $body): void
    {
        $this->body = $body;
    }

    /**
     * @return string|null
     */
    public function getDetail(): ?string
    {
        return $this->detail;
    }

    /**
     * @param string|null $detail
     */
    public function setDetail(?string $detail): void
    {
        $this->detail = $detail;
    }

    /**
     * @return string|null
     */
    public function getAttach(): ?string
    {
        return $this->attach;
    }

    /**
     * @param string|null $attach
     */
    public function setAttach(?string $attach): void
    {
        $this->attach = $attach;
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
    public function getFeeType(): ?string
    {
        return $this->fee_type;
    }

    /**
     * @param string|null $fee_type
     */
    public function setFeeType(?string $fee_type): void
    {
        $this->fee_type = $fee_type;
    }

    /**
     * @return string|null
     */
    public function getSpbillCreateIp(): ?string
    {
        return $this->spbill_create_ip;
    }

    /**
     * @param string|null $spbill_create_ip
     */
    public function setSpbillCreateIp(?string $spbill_create_ip): void
    {
        $this->spbill_create_ip = $spbill_create_ip;
    }

    /**
     * @return string|null
     */
    public function getTimeStart(): ?string
    {
        return $this->time_start;
    }

    /**
     * @param string|null $time_start
     */
    public function setTimeStart(?string $time_start): void
    {
        $this->time_start = $time_start;
    }

    /**
     * @return string|null
     */
    public function getTimeExpire(): ?string
    {
        return $this->time_expire;
    }

    /**
     * @param string|null $time_expire
     */
    public function setTimeExpire(?string $time_expire): void
    {
        $this->time_expire = $time_expire;
    }

    /**
     * @return string|null
     */
    public function getGoodsTag(): ?string
    {
        return $this->goods_tag;
    }

    /**
     * @param string|null $goods_tag
     */
    public function setGoodsTag(?string $goods_tag): void
    {
        $this->goods_tag = $goods_tag;
    }

    /**
     * @return string|null
     */
    public function getAuthCode(): ?string
    {
        return $this->auth_code;
    }

    /**
     * @param string|null $auth_code
     */
    public function setAuthCode(?string $auth_code): void
    {
        $this->auth_code = $auth_code;
    }

}