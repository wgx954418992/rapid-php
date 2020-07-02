<?php

namespace rapidPHP\plugin\pay;

use Alipay\EasySDK\Kernel\Payment;
use Exception;
use rapidPHP\library\core\server\Request;
use rapidPHP\plugin\pay\model\AliPayPayNotifyModel;
use rapidPHP\plugin\pay\model\WXPayNotifyModel;
use rapidPHP\plugin\pay\weixin\Api;
use ReflectionException;

class Pay
{

    /**
     * 获取微信通知
     * @param Request $request
     * @param Api $api
     * @param null $data
     * @return WXPayNotifyModel
     * @throws ReflectionException
     * @throws Exception
     */
    public static function getWeiXinNotify(Request $request, Api $api, &$data = null)
    {
        $data = $api->notify($request->rawContent);

        $data['sign'] = $api->getUtils()->getSign($data);

        $payId = B()->getData($data, 'out_trade_no');//订单号
        if (empty($payId)) throw new Exception('数据错误 p!');

        $money = B()->getData($data, 'total_fee');//总价

        $payee = B()->getData($data, 'mch_id');//收款人id
        if (empty($payee)) throw new Exception('数据错误 pa!');

        $payment = B()->getData($data, 'openid');//支付人id
        if (empty($payment)) throw new Exception('数据错误 op!');

        $state = B()->getData($data, 'return_code');//返回结果
        if (empty($state)) throw new Exception('数据错误 co!');

        $payTime = B()->getData($data, 'time_end');//支付完成时间
        if (empty($payTime)) throw new Exception('数据错误 t!');
        $payTime = B()->getDate(B()->dateToTime($payTime));

        $notify = new WXPayNotifyModel($data);
        $notify->setPayId($payId);
        $notify->setMoney((float)$money / 100);
        $notify->setAmount((float)$money / 100);
        $notify->setPayee($payee);
        $notify->setPayment($payment);
        $notify->setState($state);
        $notify->setTime($payTime);

        return $notify;
    }

    /**
     * 获取支付宝通知并且验证通知
     * @param Request $request
     * @param Payment $CPayment
     * @return AliPayPayNotifyModel
     * @throws ReflectionException
     * @throws Exception
     */
    public static function getAliPayNotify(Request $request, Payment $CPayment)
    {
        $payId = I($request)->post('out_trade_no');//订单号
        if (empty($payId)) throw new Exception('数据错误 p!');

        $money = I($request)->post('buyer_pay_amount');//实际支付金额
        $totalAmount = I($request)->post('total_amount');//总金额

        $payee = I($request)->post('seller_email');//收款人id
        if (empty($payee)) throw new Exception('数据错误 pa!');

        $payment = I($request)->post('buyer_logon_id');//支付人id
        if (empty($payment)) throw new Exception('数据错误 b!');

        $state = I($request)->post('trade_status');//返回结果
        if (empty($state)) throw new Exception('数据错误 s!');

        $payTime = I($request)->post('gmt_payment');//付款时间
        if (empty($payTime)) throw new Exception('数据错误 g!');

        if (empty(I($request)->post('sign'))) throw new Exception('数据错误 si');
        if (!$CPayment->common()->verifyNotify($request->post)) throw new Exception('验证失败!');

        $notifyModel = new AliPayPayNotifyModel($request->post);
        $notifyModel->setPayId($payId);
        $notifyModel->setMoney($money);
        $notifyModel->setAmount($totalAmount);
        $notifyModel->setPayee($payee);
        $notifyModel->setPayment($payment);
        $notifyModel->setState($state);
        $notifyModel->setTime($payTime);

        return $notifyModel;
    }
}