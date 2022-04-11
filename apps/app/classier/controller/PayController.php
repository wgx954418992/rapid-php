<?php

namespace apps\app\classier\controller;


use apps\app\classier\context\UserContext;
use apps\core\classier\config\pay\WechatConfig;
use apps\core\classier\config\wechat\MiniConfig;
use apps\core\classier\enum\pay\Type;
use apps\core\classier\service\PayService;
use Exception;
use oauth2\wx\classier\Mini;
use pay\wx\classier\Api;
use pay\wx\classier\request\UnifiedOrderRequest;
use pay\wx\classier\Utils;
use rapidPHP\modules\common\classier\RESTFulApi;
use ReflectionException;
use function rapidPHP\B;

/**
 * Class PayController
 * @route /pay
 * @package application\controller\account
 */
class PayController extends BaseController
{

    /**
     * 获取微信支付参数
     * @param $title
     * @param $cashierId
     * @param $totalFee
     * @return array
     * @throws Exception
     */
    private function getWechatPaymentParam($title, $cashierId, $totalFee)
    {
        $config = WechatConfig::getInstance();

        $api = new Api($config);

        $request = new UnifiedOrderRequest();

        $request->setBody($title);

        $request->setOutTradeNo($cashierId);

        $request->setTotalFee($totalFee);

        $request->setTradeType('APP');

        $request->setSpbillCreateIp($this->getRequest()->getIp());

        $order = $api->unifiedOrder($request);

        if (!$order) throw new Exception('创建微信支付失败!');

        if (strtoupper($order->getResultCode()) != 'SUCCESS') {
            $msg = B()->contrast($order->getErrCodeDes(), '创建微信支付失败!');

            throw new Exception($msg);
        }

        $data = [
            'appid' => $order->getAppid(),
            'partnerid' => $order->getMchId(),
            'prepayid' => $order->getPrepayId(),
            'package' => 'Sign=WXPay',
            'noncestr' => $order->getNonceStr(),
            'timestamp' => (string)time(),
        ];

        $data['sign'] = Utils::getInstance()->getSign($config, $data);

        unset($data['package']);

        return ['type' => Type::WECHAT, 'param' => $data];
    }

    /**
     * 获取微信小程序支付参数
     * @param $code
     * @param $title
     * @param $cashierId
     * @param $totalFee
     * @return array
     * @throws Exception
     */
    private function getWecahrMinePaymentParam($code, $title, $cashierId, $totalFee)
    {
        $config = MiniConfig::getInstance();

        $mini = new Mini($config->getAppId(), $config->getSecret());

        $openId = $mini->getOpenId($code);

        if (empty($openId)) throw new Exception('open id获取失败!');

        $config = WechatConfig::getInstance();

        $api = new Api($config);

        $data = $api->getWeiXinJsApi(
            $openId,
            time(),
            $title,
            $cashierId,
            $totalFee,
            $this->getRequest()->getIp()
        );

        return ['type' => Type::WECHAT_MINI, 'param' => $data];
    }


    /**
     * 获取支付参数
     * @route /param
     * @method post
     * @param $type
     * @param $cashierId
     * @param array|null $options post json
     * @return RESTFulApi
     * @throws ReflectionException
     * @throws Exception
     */
    public function getPaymentParam($type, $cashierId, ?array $options)
    {
        $payType = Type::i($type);

        $cashierModel = PayService::getInstance()->getCashier($cashierId);

        if ($cashierModel->getIsPay()) throw new Exception('已经支付过了哦!');

        PayService::getInstance()->verifyCashierBind($cashierModel);

        $param = [];

        $payType
            ->then(Type::WECHAT, function () use (&$param, $cashierModel) {
                $param = $this->getWechatPaymentParam(
                    $cashierModel->getTitle(),
                    $cashierModel->getId(),
                    $cashierModel->getTotalAmount() * 100
                );
            })
            ->then(Type::WECHAT_MINI, function () use ($options, &$param, $cashierModel) {
                if (!$options) throw new Exception('小程序code 错误');

                $code = B()->getData($options, 'code');

                $param = $this->getWecahrMinePaymentParam(
                    $code,
                    $cashierModel->getTitle(),
                    $cashierModel->getId(),
                    $cashierModel->getTotalAmount() * 100
                );
            })
            ->fetch();

        return RESTFulApi::success($param);
    }

}
