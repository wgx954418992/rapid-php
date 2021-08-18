<?php

namespace pay\wx\classier\request;

use rapidPHP\modules\server\config\HttpConfig;

/**
 * 统一下单，WxPayUnifiedOrder中out_trade_no、body、total_fee、trade_type必填
 * Class UnifiedOrderRequest
 * @package pay\wx\classier\request
 */
class UnifiedOrderRequest extends BaseRequest
{

    /**
     * son extends
     */
    const URL = 'https://api.mch.weixin.qq.com/pay/unifiedorder';

    /**
     * method son extends
     */
    const METHOD = HttpConfig::METHOD_POST;

    /**
     * 设置微信支付分配的终端设备号，商户自定义
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
     * 设置符合ISO 4217标准的三位字母代码，默认人民币：CNY，其他值列表详见货币类型
     * @var string|null
     */
    private $fee_type;

    /**
     * 设置订单总金额，只能为整数，详见支付金额
     * @var string|null
     */
    private $total_fee;

    /**
     * 设置APP和网页支付提交用户端ip，Native支付填调用微信支付API的机器IP。
     * @var string|null
     */
    private $spbill_create_ip;

    /**
     * 设置订单生成时间，格式为yyyyMMddHHmmss，如2009年12月25日9点10分10秒表示为20091225091010。其他详见时间规则
     * @var string|null
     */
    private $time_start;

    /**
     * 设置订单失效时间，格式为yyyyMMddHHmmss，如2009年12月27日9点10分10秒表示为20091227091010。其他详见时间规则
     * @var string|null
     */
    private $time_expire;

    /**
     * 设置商品标记，代金券或立减优惠功能的参数，说明详见代金券或立减优惠
     * @var string|null
     */
    private $goods_tag;

    /**
     * 设置接收微信支付异步通知回调地址
     * @var string|null
     */
    private $notify_url;

    /**
     * 设置取值如下：JSAPI，NATIVE，APP，详细说明见参数规定
     * @var string|null
     */
    private $trade_type;

    /**
     * 设置trade_type=NATIVE，此参数必传。此id为二维码中包含的商品ID，商户自行定义。
     * @var string|null
     */
    private $product_id;

    /**
     * 设置trade_type=JSAPI，此参数必传，用户在商户appid下的唯一标识。下单前需要调用【网页授权获取用户信息】接口获取到用户的Openid。
     * @var string|null
     */
    private $openid;

    /**
     * 该字段用于上报支付的场景信息,针对H5支付有以下三种场景,请根据对应场景上报,H5支付不建议在APP端使用，针对场景1，2请接入APP支付，不然可能会出现兼容性问题
     * 1，IOS移动应用
     * {"h5_info": //h5支付固定传"h5_info"
     * {"type": "",  //场景类型
     * "app_name": "",  //应用名
     * "bundle_id": ""  //bundle_id
     * }
     * }
     *
     * 2，安卓移动应用
     * {"h5_info": //h5支付固定传"h5_info"
     * {"type": "",  //场景类型
     * "app_name": "",  //应用名
     * "package_name": ""  //包名
     * }
     * }
     *
     * 3，WAP网站应用
     * {"h5_info": //h5支付固定传"h5_info"
     * {"type": "",  //场景类型
     * "wap_url": "",//WAP网站URL地址
     * "wap_name": ""  //WAP 网站名
     * }
     * }
     *
     * 4，门店信息
     * {"store_info" : {
     * "id": "", //门店ID
     * "name": "", //门店名称
     * "area_code": "", //门店所在地行政区划码，详细见《最新县及县以上行政区划代码》
     * "address": "" //门店地址 }}
     * @var array|null
     */
    private $scene_info;


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
    public function getNotifyUrl(): ?string
    {
        return $this->notify_url;
    }

    /**
     * @param string|null $notify_url
     */
    public function setNotifyUrl(?string $notify_url): void
    {
        $this->notify_url = $notify_url;
    }

    /**
     * @return string|null
     */
    public function getTradeType(): ?string
    {
        return $this->trade_type;
    }

    /**
     * @param string|null $trade_type
     */
    public function setTradeType(?string $trade_type): void
    {
        $this->trade_type = $trade_type;
    }

    /**
     * @return string|null
     */
    public function getProductId(): ?string
    {
        return $this->product_id;
    }

    /**
     * @param string|null $product_id
     */
    public function setProductId(?string $product_id): void
    {
        $this->product_id = $product_id;
    }

    /**
     * @return string|null
     */
    public function getOpenid(): ?string
    {
        return $this->openid;
    }

    /**
     * @param string|null $openid
     */
    public function setOpenid(?string $openid): void
    {
        $this->openid = $openid;
    }

    /**
     * @return array|null
     */
    public function getSceneInfo(): ?array
    {
        return $this->scene_info;
    }

    /**
     * @param array|null $scene_info
     */
    public function setSceneInfo(?array $scene_info): void
    {
        $this->scene_info = $scene_info;
    }

}