<?php

namespace rapidPHP\plugin\pay\weixin;

use Exception;
use rapid\library\rapid;
use rapidPHP\library\core\server\Request;
use rapidPHP\plugin\pay\model\weixin\BizPayUrlModel;
use rapidPHP\plugin\pay\model\weixin\CloseOrderModel;
use rapidPHP\plugin\pay\model\weixin\DownloadModel;
use rapidPHP\plugin\pay\model\weixin\MicroPayModel;
use rapidPHP\plugin\pay\model\weixin\OrderQueryModel;
use rapidPHP\plugin\pay\model\weixin\RefundModel;
use rapidPHP\plugin\pay\model\weixin\RefundQueryModel;
use rapidPHP\plugin\pay\model\weixin\ReverseModel;
use rapidPHP\plugin\pay\model\weixin\ShortUrlModel;
use rapidPHP\plugin\pay\model\weixin\UnifiedOrderModel;
use ReflectionException;

class Api
{
    /**
     * @var Config
     */
    private $config;

    /**
     * @var Utils
     */
    private $utils;

    /**
     * @return Config
     */
    public function getConfig(): Config
    {
        return $this->config;
    }

    /**
     * @param Config $config
     */
    public function setConfig(Config $config): void
    {
        $this->config = $config;
    }

    /**
     * @return Utils
     */
    public function getUtils(): Utils
    {
        return $this->utils;
    }

    /**
     * @param Utils $utils
     */
    public function setUtils(Utils $utils): void
    {
        $this->utils = $utils;
    }

    private static $unifiedOrderUrl = "https://api.mch.weixin.qq.com/pay/unifiedorder";

    private static $orderQueryUrl = "https://api.mch.weixin.qq.com/pay/orderquery";

    private static $closeOrderUrl = "https://api.mch.weixin.qq.com/pay/closeorder";

    private static $refundUrl = "https://api.mch.weixin.qq.com/secapi/pay/refund";

    private static $refundQueryUrl = "https://api.mch.weixin.qq.com/pay/refundquery";

    private static $downloadBillUrl = "https://api.mch.weixin.qq.com/pay/downloadbill";

    private static $microPayUrl = "https://api.mch.weixin.qq.com/pay/micropay";

    private static $reverseUrl = "https://api.mch.weixin.qq.com/secapi/pay/reverse";

    private static $shortUrl = "https://api.mch.weixin.qq.com/tools/shorturl";

    /**
     * Api constructor.
     * @param Config $config
     * @param Utils $utils
     */
    public function __construct(Config $config, Utils $utils = null)
    {
        $this->config = $config;

        $this->utils = $utils == null ? new Utils($config) : $utils;
    }

    /**
     * 解析结果
     * @param $response
     * @return bool|mixed
     * @throws Exception
     */
    private static function formResult($response)
    {
        if (!$response) throw new Exception("xml数据异常！！");

        $array = X()->decode($response);

        $code = strtoupper(B()->getData($array, 'return_code'));

        if ($code === 'SUCCESS') {
            return $array;
        } else if ($code === 'FAIL') {
            throw new Exception(B()->getData($array, 'return_msg'));
        } else {
            return false;
        }
    }

    /**
     * 统一下单，WxPayUnifiedOrder中out_trade_no、body、total_fee、trade_type必填
     * appid、mchid、spbill_create_ip、nonce_str不需要填入
     * @param UnifiedOrderModel $inputObj
     * @param int $timeOut
     * @return array|bool
     * @throws Exception
     */
    public function unifiedOrder(UnifiedOrderModel $inputObj, $timeOut = 6)
    {
        if (empty($inputObj->getOutTradeNo())) throw new Exception("缺少统一支付接口必填参数out_trade_no！");

        if (empty($inputObj->getBody())) throw new Exception("缺少统一支付接口必填参数body！");

        if (empty($inputObj->getTotalFee())) throw new Exception("缺少统一支付接口必填参数total_fee！");

        if (empty($inputObj->getTradeType())) throw new Exception("缺少统一支付接口必填参数trade_type！");

        if ($inputObj->getTradeType() == "JSAPI" && empty($inputObj->getOpenid()))
            throw new Exception("统一支付接口中，缺少必填参数openid！trade_type为JSAPI时，openid为必填参数！");

        if ($inputObj->getTradeType() == "NATIVE" && empty($inputObj->getProductId()))
            throw new Exception("统一支付接口中，缺少必填参数product_id！trade_type为JSAPI时，product_id为必填参数！");

        if (empty($inputObj->getNotifyUrl()))
            $inputObj->setNotifyUrl($this->config->getNotifyUrl());

        $inputObj->setAppId($this->config->getAppId());

        $inputObj->setMchId($this->config->getMchId());

        $inputObj->setSpbillCreateIp(B()->getIp());

        $inputObj->setNonceStr(B()->randoms(32, 'abcdefghijklmnopqrstuvwxyz0123456789'));

        $inputObj->setSign($this->utils);

        $response = $this->utils->postXmlCurl($inputObj->toXml(), self::$unifiedOrderUrl, false, $timeOut);

        return self::formResult($response);
    }


    /**
     * 查询订单，WxPayOrderQuery中out_trade_no、transaction_id至少填一个
     * appid、mchid、spbill_create_ip、nonce_str不需要填入
     * @param OrderQueryModel $inputObj
     * @param int $timeOut
     * @return array|bool
     * @throws Exception
     */
    public function orderQuery(OrderQueryModel $inputObj, $timeOut = 6)
    {
        //检测必填参数
        if (empty($inputObj->getOutTradeNo()) && empty($inputObj->getTransactionId())) throw new Exception("订单查询接口中，out_trade_no、transaction_id至少填一个！");

        $inputObj->setAppId($this->config->getAppId());

        $inputObj->setMchId($this->config->getMchId());

        $inputObj->setNonceStr(B()->randoms(32, 'abcdefghijklmnopqrstuvwxyz0123456789'));

        $inputObj->setSign($this->utils);

        $response = $this->utils->postXmlCurl($inputObj->toXml(), self::$orderQueryUrl, false, $timeOut);

        return self::formResult($response);
    }


    /**
     * 关闭订单，WxPayCloseOrder中out_trade_no必填
     * appid、mchid、spbill_create_ip、nonce_str不需要填入
     * @param CloseOrderModel $inputObj
     * @param int $timeOut
     * @return mixed
     * @throws Exception
     */
    public function closeOrder(CloseOrderModel $inputObj, $timeOut = 6)
    {
        //检测必填参数
        if (empty($inputObj->getOutTradeNo())) throw new Exception("订单查询接口中，out_trade_no必填！");

        $inputObj->setAppId($this->config->getAppId());

        $inputObj->setMchId($this->config->getMchId());

        $inputObj->setNonceStr(B()->randoms(32, 'abcdefghijklmnopqrstuvwxyz0123456789'));

        $inputObj->setSign($this->utils);

        $response = $this->utils->postXmlCurl($inputObj->toXml(), self::$closeOrderUrl, false, $timeOut);

        return self::formResult($response);
    }


    /**
     * 申请退款，WxPayRefund中out_trade_no、transaction_id至少填一个且
     * out_refund_no、total_fee、refund_fee、op_user_id为必填参数
     * appid、mchid、spbill_create_ip、nonce_str不需要填入
     * @param RefundModel $inputObj
     * @param int $timeOut
     * @return array|bool
     * @throws Exception
     */
    public function refund(RefundModel $inputObj, $timeOut = 6)
    {
        if (empty($inputObj->getOutTradeNo()) && empty($inputObj->getTransactionId())) throw new Exception("退款申请接口中，out_trade_no、transaction_id至少填一个！");

        if (empty($inputObj->getOutRefundNo())) throw new Exception("退款申请接口中，缺少必填参数out_refund_no！");

        if (empty($inputObj->getTotalFee())) throw new Exception("退款申请接口中，缺少必填参数total_fee！");

        if (empty($inputObj->getRefundFee())) throw new Exception("退款申请接口中，缺少必填参数refund_fee！");

        if (empty($inputObj->getOpUserId())) throw new Exception("退款申请接口中，缺少必填参数op_user_id！");

        $inputObj->setAppId($this->config->getAppId());

        $inputObj->setMchId($this->config->getMchId());

        $inputObj->setNonceStr(B()->randoms(32, 'abcdefghijklmnopqrstuvwxyz0123456789'));

        $inputObj->setSign($this->utils);

        $response = $this->utils->postXmlCurl($inputObj->toXml(), self::$refundUrl, true, $timeOut);

        return self::formResult($response);
    }


    /**
     * 查询退款
     * 提交退款申请后，通过调用该接口查询退款状态。退款有一定延时，
     * 用零钱支付的退款20分钟内到账，银行卡支付的退款3个工作日后重新查询退款状态。
     * WxPayRefundQuery中out_refund_no、out_trade_no、transaction_id、refund_id四个参数必填一个
     * appid、mchid、spbill_create_ip、nonce_str不需要填入
     * @param RefundQueryModel $inputObj
     * @param int $timeOut
     * @return array|bool
     * @throws Exception
     */
    public function refundQuery(RefundQueryModel $inputObj, $timeOut = 6)
    {
        //检测必填参数
        if (empty($inputObj->getOutRefundNo()) && empty($inputObj->getOutTradeNo()) && empty($inputObj->getTransactionId()) && empty($inputObj->getRefundId())) {
            throw new Exception("退款查询接口中，out_refund_no、out_trade_no、transaction_id、refund_id四个参数必填一个！");
        }

        $inputObj->setAppId($this->config->getAppId());
        $inputObj->setMchId($this->config->getMchId());

        $inputObj->setNonceStr(B()->randoms(32, 'abcdefghijklmnopqrstuvwxyz0123456789'));
        $inputObj->setSign($this->utils);

        $response = $this->utils->postXmlCurl($inputObj->toXml(), self::$refundQueryUrl, false, $timeOut);

        return self::formResult($response);
    }


    /**
     * 下载对账单，WxPayDownloadBill中bill_date为必填参数
     * appid、mchid、spbill_create_ip、nonce_str不需要填入
     * @param DownloadModel $inputObj
     * @param int $timeOut
     * @return mixed|string
     * @throws Exception
     */
    public function downloadBill(DownloadModel $inputObj, $timeOut = 6)
    {
        if (empty($inputObj->getBillDate())) throw new Exception("对账单接口中，缺少必填参数bill_date！");

        $inputObj->setAppId($this->config->getAppId());
        $inputObj->setMchId($this->config->getMchId());

        $inputObj->setNonceStr(B()->randoms(32, 'abcdefghijklmnopqrstuvwxyz0123456789'));
        $inputObj->setSign($this->utils);

        $response = $this->utils->postXmlCurl($inputObj->toXml(), self::$downloadBillUrl, false, $timeOut);

        if (substr($response, 0, 5) == "<xml>") return "";

        return $response;
    }


    /**
     * 提交被扫支付API
     * 收银员使用扫码设备读取微信用户刷卡授权码以后，二维码或条码信息传送至商户收银台，
     * 由商户收银台或者商户后台调用该接口发起支付。
     * WxPayWxPayMicroPay中body、out_trade_no、total_fee、auth_code参数必填
     * appid、mchid、spbill_create_ip、nonce_str不需要填入
     * @param MicroPayModel $inputObj
     * @param int $timeOut
     * @return array|bool
     * @throws Exception
     */
    public function microPay(MicroPayModel $inputObj, $timeOut = 10)
    {
        if (empty($inputObj->getBody())) throw new Exception("提交被扫支付API接口中，缺少必填参数body！");

        if (empty($inputObj->getOutTradeNo())) throw new Exception("提交被扫支付API接口中，缺少必填参数out_trade_no！");

        if (empty($inputObj->getTotalFee())) throw new Exception("提交被扫支付API接口中，缺少必填参数total_fee！");

        if (empty($inputObj->getAuthCode())) throw new Exception("提交被扫支付API接口中，缺少必填参数auth_code！");

        $inputObj->setAppId($this->config->getAppId());
        $inputObj->setMchId($this->config->getMchId());

        $inputObj->setSpbillCreateIp(B()->getIp());

        $inputObj->setNonceStr(B()->randoms(32, 'abcdefghijklmnopqrstuvwxyz0123456789'));
        $inputObj->setSign($this->utils);

        $response = $this->utils->postXmlCurl($inputObj->toXml(), self::$microPayUrl, false, $timeOut);

        return self::formResult($response);
    }


    /**
     * 撤销订单API接口，WxPayReverse中参数out_trade_no和transaction_id必须填写一个
     * appid、mchid、spbill_create_ip、nonce_str不需要填入
     * @param ReverseModel $inputObj
     * @param int $timeOut
     * @return array|bool
     * @throws Exception
     */
    public function reverse(ReverseModel $inputObj, $timeOut = 6)
    {
        if (empty($inputObj->getOutTradeNo()) && empty($inputObj->getTransactionId())) {
            throw new Exception("撤销订单API接口中，参数out_trade_no和transaction_id必须填写一个！");
        }

        $inputObj->setAppId($this->config->getAppId());
        $inputObj->setMchId($this->config->getMchId());

        $inputObj->setNonceStr(B()->randoms(32, 'abcdefghijklmnopqrstuvwxyz0123456789'));
        $inputObj->setSign($this->utils);

        $response = $this->utils->postXmlCurl($inputObj->toXml(), self::$reverseUrl, true, $timeOut);

        return self::formResult($response);
    }


    /**
     * 生成二维码规则,模式一生成支付二维码
     * appid、mchid、spbill_create_ip、nonce_str不需要填入
     * @param BizPayUrlModel $inputObj
     * @return array
     * @throws Exception
     */
    public function bizPayUrl(BizPayUrlModel $inputObj)
    {
        if (empty($inputObj->getProductId())) throw new Exception("生成二维码，缺少必填参数product_id！");

        $inputObj->setAppId($this->config->getAppId());

        $inputObj->setMchId($this->config->getMchId());

        $inputObj->setTimeStamp(time());//时间戳

        $inputObj->setNonceStr(B()->randoms(32, 'abcdefghijklmnopqrstuvwxyz0123456789'));
        $inputObj->setSign($this->utils);

        return $inputObj->getData();
    }


    /**
     * 转换短链接
     * 该接口主要用于扫码原生支付模式一中的二维码链接转成短链接(weixin://wxpay/s/XXXXXX)，
     * 减小二维码数据量，提升扫描速度和精确度。
     * appid、mchid、spbill_create_ip、nonce_str不需要填入
     * @param ShortUrlModel $inputObj
     * @param int $timeOut
     * @return array|bool
     * @throws Exception
     */
    public function shortUrl(ShortUrlModel $inputObj, $timeOut = 6)
    {
        if (empty($inputObj->getLongUrl())) throw new Exception("需要转换的URL，签名用原串，传输需URL encode！");

        $inputObj->setAppId($this->config->getAppId());
        $inputObj->setMchId($this->config->getMchId());

        $inputObj->setNonceStr(B()->randoms(32, 'abcdefghijklmnopqrstuvwxyz0123456789'));
        $inputObj->setSign($this->utils);

        $response = $this->utils->postXmlCurl($inputObj->toXml(), self::$shortUrl, false, $timeOut);

        return self::formResult($response);
    }


    /**
     * 支付结果通用通知
     * @param $xml
     * @return bool|mixed
     * @throws Exception
     */
    public function notify($xml)
    {
        return self::formResult($xml);
    }


    /**
     * jsapi 获取微信jsApi数据
     * @param $openId
     * @param $timestamp
     * @param $body
     * @param $outTradeNo
     * @param $totalFee
     * @return array|bool
     * @throws ReflectionException
     */
    public function getWeiXinJsApi($openId, $timestamp, $body, $outTradeNo, $totalFee)
    {
        $inputObj = new UnifiedOrderModel();

        $inputObj->setOpenid($openId);

        $inputObj->setBody($body);//商品描述

        $inputObj->setOutTradeNo($outTradeNo);//商户订单号

        $inputObj->setTotalFee($totalFee);

        $inputObj->setTradeType('JSAPI');

        try {
            $order = $this->unifiedOrder($inputObj);

            if (strtoupper(B()->getData($order, 'result_code')) == 'SUCCESS') {

                $object = [
                    'appId' => $order['appid'],
                    'timeStamp' => (string)$timestamp,
                    'nonceStr' => $inputObj->getNonceStr(),
                    'package' => "prepay_id={$order['prepay_id']}",
                    'signType' => 'MD5'
                ];

                $object['paySign'] = $this->utils->getSign($object);

                return $object;
            } else {
                return false;
            }

        } catch (Exception $e) {
            return false;
        }
    }
}