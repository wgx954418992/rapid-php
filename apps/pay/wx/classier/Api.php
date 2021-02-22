<?php

namespace pay\wx\classier;

use Exception;
use pay\wx\config\Config;
use pay\wx\classier\request\BizPayUrlRequest;
use pay\wx\classier\request\CloseOrderRequest;
use pay\wx\classier\request\DownloadBillRequest;
use pay\wx\classier\request\MicroPayRequest;
use pay\wx\classier\request\OrderQueryRequest;
use pay\wx\classier\request\RefundQueryRequest;
use pay\wx\classier\request\RefundRequest;
use pay\wx\classier\request\ReverseRequest;
use pay\wx\classier\request\ShortUrlRequest;
use pay\wx\classier\request\UnifiedOrderRequest;
use pay\wx\classier\response\BaseResponse;
use pay\wx\classier\response\UnifiedOrderResponse;
use ReflectionException;
use function rapidPHP\B;

class Api
{
    /**
     * @var Config
     */
    private $config;

    /**
     * Utils constructor.
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * 统一下单，WxPayUnifiedOrder中out_trade_no、body、total_fee、trade_type必填
     * appid、mchid、spbill_create_ip、nonce_str不需要填入
     * @param UnifiedOrderRequest $request
     * @return UnifiedOrderResponse|null
     * @throws ReflectionException
     * @throws Exception
     */
    public function unifiedOrder(UnifiedOrderRequest $request): ?UnifiedOrderResponse
    {
        if (empty($request->getOutTradeNo())) throw new Exception("缺少统一支付接口必填参数out_trade_no！");

        if (empty($request->getBody())) throw new Exception("缺少统一支付接口必填参数body！");

        if (empty($request->getTotalFee())) throw new Exception("缺少统一支付接口必填参数total_fee！");

        if (empty($request->getTradeType())) throw new Exception("缺少统一支付接口必填参数trade_type！");

        if ($request->getTradeType() == "JSAPI" && empty($request->getOpenid()))
            throw new Exception("统一支付接口中，缺少必填参数openid！trade_type为JSAPI时，openid为必填参数！");

        if ($request->getTradeType() == "NATIVE" && empty($request->getProductId()))
            throw new Exception("统一支付接口中，缺少必填参数product_id！trade_type为JSAPI时，product_id为必填参数！");

        if (empty($request->getSpbillCreateIp())) throw new Exception('sp bill create ip error!');

        if (empty($request->getNotifyUrl())) $request->setNotifyUrl($this->config->getNotifyUrl());

        /** @var UnifiedOrderResponse|null $response */
        $response = Utils::getInstance()->sendHttpRequest($this->config, $request, UnifiedOrderResponse::class);

        return $response;
    }

    /**
     * 查询订单，WxPayOrderQuery中out_trade_no、transaction_id至少填一个
     * appid、mchid、spbill_create_ip、nonce_str不需要填入
     * @param OrderQueryRequest $request
     * @return BaseResponse|null
     * @throws ReflectionException
     * @throws Exception
     */
    public function orderQuery(OrderQueryRequest $request): ?BaseResponse
    {
        if (empty($request->getOutTradeNo()) && empty($request->getTransactionId()))
            throw new Exception("订单查询接口中，out_trade_no、transaction_id至少填一个！");

        /** @var BaseResponse|null $response */
        $response = Utils::getInstance()->sendHttpRequest($this->config, $request);

        return $response;
    }

    /**
     * 关闭订单，WxPayCloseOrder中out_trade_no必填
     * appid、mchid、spbill_create_ip、nonce_str不需要填入
     * @param CloseOrderRequest $request
     * @return mixed
     * @throws Exception
     */
    public function closeOrder(CloseOrderRequest $request): ?BaseResponse
    {
        if (empty($request->getOutTradeNo())) throw new Exception("订单查询接口中，out_trade_no必填！");

        /** @var BaseResponse|null $response */
        $response = Utils::getInstance()->sendHttpRequest($this->config, $request);

        return $response;
    }

    /**
     * 申请退款，WxPayRefund中out_trade_no、transaction_id至少填一个且
     * out_refund_no、total_fee、refund_fee、op_user_id为必填参数
     * appid、mchid、spbill_create_ip、nonce_str不需要填入
     * @param RefundRequest $request
     * @return BaseResponse|null
     * @throws ReflectionException
     * @throws Exception
     */
    public function refund(RefundRequest $request): ?BaseResponse
    {
        if (empty($request->getOutTradeNo()) && empty($request->getTransactionId())) throw new Exception("退款申请接口中，out_trade_no、transaction_id至少填一个！");

        if (empty($request->getOutRefundNo())) throw new Exception("退款申请接口中，缺少必填参数out_refund_no！");

        if (empty($request->getTotalFee())) throw new Exception("退款申请接口中，缺少必填参数total_fee！");

        if (empty($request->getRefundFee())) throw new Exception("退款申请接口中，缺少必填参数refund_fee！");

        if (empty($request->getOpUserId())) throw new Exception("退款申请接口中，缺少必填参数op_user_id！");

        /** @var BaseResponse|null $response */
        $response = Utils::getInstance()->sendHttpRequest($this->config, $request);

        return $response;
    }

    /**
     * 查询退款
     * 提交退款申请后，通过调用该接口查询退款状态。退款有一定延时，
     * 用零钱支付的退款20分钟内到账，银行卡支付的退款3个工作日后重新查询退款状态。
     * WxPayRefundQuery中out_refund_no、out_trade_no、transaction_id、refund_id四个参数必填一个
     * appid、mchid、spbill_create_ip、nonce_str不需要填入
     * @param RefundQueryRequest $request
     * @return BaseResponse|null
     * @throws Exception
     */
    public function refundQuery(RefundQueryRequest $request): ?BaseResponse
    {
        if (empty($request->getOutRefundNo()) && empty($request->getOutTradeNo()) && empty($request->getTransactionId()) && empty($request->getRefundId())) {
            throw new Exception("退款查询接口中，out_refund_no、out_trade_no、transaction_id、refund_id四个参数必填一个！");
        }

        /** @var BaseResponse|null $response */
        $response = Utils::getInstance()->sendHttpRequest($this->config, $request);

        return $response;
    }

    /**
     * 下载对账单，WxPayDownloadBill中bill_date为必填参数
     * appid、mchid、spbill_create_ip、nonce_str不需要填入
     * @param DownloadBillRequest $request
     * @return mixed|string
     * @throws Exception
     */
    public function downloadBill(DownloadBillRequest $request)
    {
        if (empty($request->getBillDate())) throw new Exception("对账单接口中，缺少必填参数bill_date！");

        /** @var BaseResponse|null $response */
        $response = Utils::getInstance()->sendHttpRequest($this->config, $request, null);

        if (substr($response, 0, 5) == "<xml>") return "";

        return $response;
    }


    /**
     * 提交被扫支付API
     * 收银员使用扫码设备读取微信用户刷卡授权码以后，二维码或条码信息传送至商户收银台，
     * 由商户收银台或者商户后台调用该接口发起支付。
     * WxPayWxPayMicroPay中body、out_trade_no、total_fee、auth_code参数必填
     * appid、mchid、spbill_create_ip、nonce_str不需要填入
     * @param MicroPayRequest $request
     * @return BaseResponse|null
     * @throws Exception
     */
    public function microPay(MicroPayRequest $request): ?BaseResponse
    {
        if (empty($request->getBody())) throw new Exception("提交被扫支付API接口中，缺少必填参数body！");

        if (empty($request->getOutTradeNo())) throw new Exception("提交被扫支付API接口中，缺少必填参数out_trade_no！");

        if (empty($request->getTotalFee())) throw new Exception("提交被扫支付API接口中，缺少必填参数total_fee！");

        if (empty($request->getAuthCode())) throw new Exception("提交被扫支付API接口中，缺少必填参数auth_code！");

        if (empty($request->getSpbillCreateIp())) throw new Exception('sp bill create ip error!');

        /** @var BaseResponse|null $response */
        $response = Utils::getInstance()->sendHttpRequest($this->config, $request);

        return $response;
    }


    /**
     * 撤销订单API接口，WxPayReverse中参数out_trade_no和transaction_id必须填写一个
     * appid、mchid、spbill_create_ip、nonce_str不需要填入
     * @param ReverseRequest $request
     * @return BaseResponse|null
     * @throws Exception
     */
    public function reverse(ReverseRequest $request): ?BaseResponse
    {
        if (empty($request->getOutTradeNo()) && empty($request->getTransactionId())) {
            throw new Exception("撤销订单API接口中，参数out_trade_no和transaction_id必须填写一个！");
        }

        /** @var BaseResponse|null $response */
        $response = Utils::getInstance()->sendHttpRequest($this->config, $request);

        return $response;
    }


    /**
     * 生成二维码规则,模式一生成支付二维码
     * appid、mchid、spbill_create_ip、nonce_str不需要填入
     * @param BizPayUrlRequest $request
     * @return array
     * @throws Exception
     */
    public function bizPayUrl(BizPayUrlRequest $request): array
    {
        if (empty($request->getProductId())) throw new Exception("生成二维码，缺少必填参数product_id！");

        if (empty($request->getAppid())) $request->setAppId($this->config->getAppId());

        if (empty($request->getMchId())) $request->setMchId($this->config->getMchId());

        if (empty($request->getNonceStr())) {
            $request->setNonceStr(B()->randoms(32, 'abcdefghijklmnopqrstuvwxyz0123456789'));
        }

        $request->setTimeStamp(time());

        if (empty($request->getSign())) {
            $request->setSign(Utils::getInstance()->getSign($this->config, $request->toData()));
        }

        return $request->toData();
    }


    /**
     * 转换短链接
     * 该接口主要用于扫码原生支付模式一中的二维码链接转成短链接(weixin://wxpay/s/XXXXXX)，
     * 减小二维码数据量，提升扫描速度和精确度。
     * appid、mchid、spbill_create_ip、nonce_str不需要填入
     * @param ShortUrlRequest $request
     * @return BaseResponse|null
     * @throws Exception
     */
    public function shortUrl(ShortUrlRequest $request): ?BaseResponse
    {
        if (empty($request->getLongUrl())) throw new Exception("需要转换的URL，签名用原串，传输需URL encode！");

        /** @var BaseResponse|null $response */
        $response = Utils::getInstance()->sendHttpRequest($this->config, $request);

        return $response;
    }

    /**
     * jsapi 获取微信jsApi数据
     * @param $openId
     * @param $timestamp
     * @param $body
     * @param $outTradeNo
     * @param $totalFee
     * @param $ip
     * @return array
     * @throws Exception
     */
    public function getWeiXinJsApi($openId, $timestamp, $body, $outTradeNo, $totalFee, $ip): array
    {
        $request = new UnifiedOrderRequest();

        $request->setOpenid($openId);

        $request->setBody($body);

        $request->setOutTradeNo($outTradeNo);

        $request->setTotalFee($totalFee);

        $request->setTradeType('JSAPI');

        $request->setSpbillCreateIp($ip);

        $order = $this->unifiedOrder($request);

        if (strtoupper($order->getResultCode()) != 'SUCCESS') {
            $msg = B()->contrast($order->getErrCodeDes(), '创建微信支付失败!');

            throw new Exception($msg);
        }

        $object = [
            'appId' => $order->getAppid(),
            'timeStamp' => (string)$timestamp,
            'nonceStr' => $request->getNonceStr(),
            'package' => "prepay_id={$order->getPrepayId()}",
            'signType' => $this->config->getSignType()
        ];

        $object['paySign'] = Utils::getInstance()->getSign($this->config, $object);

        return $object;
    }

}