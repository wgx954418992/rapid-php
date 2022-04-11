<?php

namespace apps\app\classier\controller;


use apps\core\classier\config\pay\WechatConfig;
use apps\core\classier\service\BaseService;
use apps\core\classier\service\PayService;
use Exception;
use pay\wx\classier\Utils as WXUtils;
use pay\wx\classier\response\PayNotifyResponse as WXPayNotifyResponse;
use function rapidPHP\B;


/**
 * Class PayNotifyController
 * @route /pay/notify
 * @package apps\app\classier\controller
 */
class PayNotifyController extends BaseController
{


    /**
     * 微信支付回调
     * @route /wechat
     * @typed raw
     * @encode xml
     * @header Content-Type:text/xml;charset=utf-8
     */
    public function wechatNotify()
    {
        $xml = $this->getRequest()->rawContent();

        BaseService::getInstance()->addLog('wechatNotify start', $xml);

        try {
            $data = WXUtils::getInstance()->parseResponseByXML($xml);

            $sign = WXUtils::getInstance()->getSign(WechatConfig::getInstance(), $data);

            if ($sign != B()->getData($data, 'sign')) throw new Exception('签名错误!');

            $notify = new WXPayNotifyResponse();

            $notify->loadData($data);

            try {
                /** @var PayService $payService */
                $payService = PayService::getInstance();

                if ($payService->payNotify($notify)) {

                    BaseService::getInstance()
                        ->addLog($notify->getPayId() . "----msg:success");

                    return $data;
                } else {
                    BaseService::getInstance()
                        ->addLog($notify->getPayId() . "----msg:fail");
                }
            } catch (Exception $e) {
                $content = [
                    'line' => $e->getLine(),
                    'file' => $e->getFile(),
                    'code' => $e->getCode(),
                    'trace' => $e->getTraceAsString(),
                    'data' => $data,
                ];

                BaseService::getInstance()
                    ->addLog($notify->getPayId() . "----msg:" . $e->getMessage(), $content);
            }
        } catch (Exception $e) {
            BaseService::getInstance()->addLog('wechatNotify' . $e->getMessage(), $xml);
        }

        return [];
    }
}
