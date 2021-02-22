<?php

namespace pay\wx\classier\response;

/**
 * Class UnifiedOrderResponse
 * 错误码
 *   INVALID_REQUEST	参数错误	参数格式有误或者未按规则上传	订单重入时，要求参数值与原请求一致，请确认参数问题
 *   NOAUTH	商户无此接口权限	商户未开通此接口权限	请商户前往申请此接口权限
 *   NOTENOUGH	余额不足	用户帐号余额不足	用户帐号余额不足，请用户充值或更换支付卡后再支付
 *   ORDERPAID	商户订单已支付	商户订单已支付，无需重复操作	商户订单已支付，无需更多操作
 *   ORDERCLOSED	订单已关闭	当前订单已关闭，无法支付	当前订单已关闭，请重新下单
 *   SYSTEMERROR	系统错误	系统超时	系统异常，请用相同参数重新调用
 *   APPID_NOT_EXIST	APPID不存在	参数中缺少APPID	请检查APPID是否正确
 *   MCHID_NOT_EXIST	MCHID不存在	参数中缺少MCHID	请检查MCHID是否正确
 *   APPID_MCHID_NOT_MATCH	appid和mch_id不匹配	appid和mch_id不匹配	请确认appid和mch_id是否匹配
 *   LACK_PARAMS	缺少参数	缺少必要的请求参数	请检查参数是否齐全
 *   OUT_TRADE_NO_USED	商户订单号重复	同一笔交易不能多次提交	请核实商户订单号是否重复提交
 *   SIGNERROR	签名错误	参数签名结果不正确	请检查签名参数和方法是否都符合签名算法要求
 *   XML_FORMAT_ERROR	XML格式错误	XML格式错误	请检查XML参数格式是否正确
 *   REQUIRE_POST_METHOD	请使用post方法	未使用post传递参数 	请检查请求参数是否通过post方法提交
 *   POST_DATA_EMPTY	post数据为空	post数据不能为空	请检查post数据是否为空
 *   NOT_UTF8	编码格式错误	未使用指定编码格式	请使用UTF-8编码格式
 * @package pay\wx\classier\response
 */
class UnifiedOrderResponse extends BaseResponse
{

    /**
     * 设备号
     * device_info    自定义参数，可以为请求支付的终端设备号等
     * @var string|null
     */
    private $device_info;

    /**
     * 交易类型  trade_type
     * JSAPI -JSAPI支付
     * NATIVE -Native支付
     * APP -APP支付
     * 说明详见参数规定
     * @var string|null
     */
    private $trade_type;

    /**
     * 预支付交易会话标识
     * 微信生成的预支付会话标识，用于后续接口调用中使用，该值有效期为2小时
     * @var string|null
     */
    private $prepay_id;

    /**
     * 二维码链接
     * code_url  weixin://wxpay/bizpayurl/up?pr=NwY5Mz9&groupid=00
     * trade_type=NATIVE时有返回，此url用于生成支付二维码，然后提供给用户进行扫码支付。
     * 注意：code_url的值并非固定，使用时按照URL格式转成二维码即可
     * @var string|null
     */
    private $code_url;


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
    public function getPrepayId(): ?string
    {
        return $this->prepay_id;
    }

    /**
     * @param string|null $prepay_id
     */
    public function setPrepayId(?string $prepay_id): void
    {
        $this->prepay_id = $prepay_id;
    }

    /**
     * @return string|null
     */
    public function getCodeUrl(): ?string
    {
        return $this->code_url;
    }

    /**
     * @param string|null $code_url
     */
    public function setCodeUrl(?string $code_url): void
    {
        $this->code_url = $code_url;
    }
}