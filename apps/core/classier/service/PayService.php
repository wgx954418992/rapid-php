<?php

namespace apps\core\classier\service;

use apps\core\classier\config\pay\WechatConfig;
use apps\core\classier\dao\master\cashier\BindDao;
use apps\core\classier\dao\master\cashier\PayDao;
use apps\core\classier\dao\master\CashierDao;
use apps\core\classier\dao\master\member\OrderDao;
use apps\core\classier\dao\master\RechargeDao;
use apps\core\classier\dao\MasterDao;
use apps\core\classier\enum\cashier\BindType;
use apps\core\classier\enum\member\record\Mode as MemberRecordMode;
use apps\core\classier\enum\pay\Type as PayType;
use apps\core\classier\enum\recharge\Type;
use apps\core\classier\model\AppCashierModel;
use apps\core\classier\model\CashierBindModel;
use apps\core\classier\model\CashierPayModel;
use apps\core\classier\model\MemberRecordModel;
use apps\core\classier\options\CashierOptions;
use apps\core\classier\service\user\MemberService as UserMemberService;
use apps\core\classier\wrapper\CashierWrapper;
use Exception;
use pay\alipay\classier\response\PayNotifyResponse as AliPayPayNotifyResponse;
use pay\core\classier\PayNotifyInterface;
use pay\wx\classier\Api;
use pay\wx\classier\request\RefundRequest;
use pay\wx\classier\response\PayNotifyResponse as WXPayNotifyResponse;
use rapidPHP\modules\common\classier\Instances;
use ReflectionException;
use function rapidPHP\Cal;

class PayService
{

    /**
     * 单例模式
     */
    use Instances;

    /**
     * 初始化当前
     * @return static
     */
    public static function onNotInstance()
    {
        return new static();
    }

    /**
     * 添加收银
     * @param AppCashierModel $cashierModel
     * @param  $bindModel
     * @return true
     * @throws Exception
     */
    public function addCashier(AppCashierModel $cashierModel, $bindModel)
    {
        if (empty($cashierModel->getId())) throw new Exception('cashierId 错误!');

        if (empty($bindModel)) throw new Exception('bindModel 错误!');

        $bindModels = !is_array($bindModel) ? [$bindModel] : $bindModel;

        $isThingIn = MasterDao::getSQLDB()->isInThing();

        if (!$isThingIn) MasterDao::getSQLDB()->beginTransaction();

        try {

            /** @var CashierDao $cashierDao */
            $cashierDao = CashierDao::getInstance();

            $cashierDao->addCashier($cashierModel);

            /** @var BindDao $bindDao */
            $bindDao = BindDao::getInstance();

            /** @var CashierBindModel $bindModel */
            foreach ($bindModels as $bindModel) {

                if (empty($bindModel->getBindId())) throw new Exception('bind id error!');

                if (empty($bindModel->getBindType())) throw new Exception('bind type error!');

                $bindModel->setCashierId($cashierModel->getId());

                $bindDao->addBind($bindModel);
            }

            if (!$isThingIn && !MasterDao::getSQLDB()->commit()) throw new Exception('创建失败!');

            return true;
        } catch (Exception $e) {
            if (!$isThingIn) MasterDao::getSQLDB()->rollBack();

            throw $e;
        }
    }

    /**
     * 获取收银信息
     * @param $cashierId
     * @param CashierOptions|null $options
     * @return CashierWrapper
     * @throws Exception
     */
    public function getCashier($cashierId, ?CashierOptions $options = null)
    {
        if (empty($cashierId)) throw new Exception('收银id错误!');

        /** @var CashierDao $cashierDao */
        $cashierDao = CashierDao::getInstance();

        $cashierModel = $cashierDao->getCashier($cashierId);

        if ($cashierModel == null) throw new Exception('收银信息不存在!');

        if ($options) {
            $options->then(CashierOptions::PAY, function () use ($cashierModel, $cashierId) {

                /** @var PayDao $payDao */
                $payDao = PayDao::getInstance();

                $cashierModel->setPay($payDao->getPayByCashier($cashierId));
            });
        }

        return $cashierModel;
    }

    /**
     * 发起退款
     * @param $cashierId
     * @throws Exception
     */
    public function refundInitiation($cashierId)
    {
        $cashierModel = $this->getCashier($cashierId, CashierOptions::i(CashierOptions::PAY));

        if (!$cashierModel->getIsPay()) throw new Exception('没有支付，无法退款哦!');

        $payModel = $cashierModel->getPay();

        if (empty($payModel)) throw new Exception('支付信息欠缺!');

        switch ($cashierModel->getPayType()) {
            case PayType::WECHAT:
                $wechatApi = new Api(WechatConfig::getInstance());

                $refundRequest = new RefundRequest();

                $refundRequest->setOutTradeNo($cashierModel->getId());

                $refundRequest->setOutRefundNo($cashierModel->getId());

                $refundRequest->setOpUserId($payModel->getPayer());

                $refundRequest->setTotalFee($payModel->getTotalAmount() * 100);

                $refundRequest->setRefundFee($payModel->getPaymentAmount() * 100);

                $result = $wechatApi->refund($refundRequest);

                if ($result->getResultCode() !== 'SUCCESS') {
                    throw new Exception('退款失败!');
                }
                break;
            case PayType::WALLET:
                try {
                    $walletService = new WalletService($payModel->getPayer());

                    $walletService->addPoint($payModel->getPaymentAmount(), '退款到账');
                } catch (Exception $e) {
                    throw new Exception('退款失败!' . $e->getMessage());
                }
                break;
        }
    }

    /**
     * 验证支付绑定的信息
     * @param AppCashierModel $cashierModel
     * @param float $totalFee
     * @return bool
     * @throws ReflectionException
     * @throws Exception
     */
    public function verifyCashierBind(AppCashierModel $cashierModel, float &$totalFee = 0): bool
    {
        /** @var BindDao $bindDao */
        $bindDao = BindDao::getInstance();

        $bindList = $bindDao->getBindListByCashier($cashierModel->getId());

        if (empty($bindList)) throw new Exception('没有找到对应的bindList');

        foreach ($bindList as $bindModel) {

            BindType::i($bindModel->getBindType())
                ->then(BindType::RECHARGE, function () use ($bindModel, &$totalFee) {

                    /** @var RechargeDao $rechargeDao */
                    $rechargeDao = RechargeDao::getInstance();

                    $rechargeModel = $rechargeDao->getRecharge($bindModel->getBindId());

                    if ($rechargeModel == null) throw new Exception('充值信息错误!');

                    switch ($rechargeModel->getType()) {
                        case Type::WALLET:
                            $totalFee += $rechargeModel->getAmount();
                            break;
                        case Type::INTEGRAL:
                            $totalFee += ($rechargeModel->getAmount() / 100);
                            break;
                    }
                })
                ->then(BindType::OPEN_MEMBER, function () use (&$totalFee, $cashierModel, $bindModel) {

                    /** @var OrderDao $orderDao */
                    $orderDao = OrderDao::getInstance();

                    $orderModel = $orderDao->getOrder($bindModel->getBindId());

                    if ($orderModel == null) throw new Exception('开通会员订单信息不存在!');

                    $totalFee += $orderModel->getTotalFee();
                })
                ->fetch();
        }

        return true;
    }

    /**
     * 支付回调
     * @param PayNotifyInterface $notify
     * @return bool
     * @throws Exception
     */
    public function payNotify(PayNotifyInterface $notify): bool
    {
        $cashierId = $notify->getPayId();

        /** @var CashierDao $cashierDao */
        $cashierDao = CashierDao::getInstance();

        $cashierModel = $cashierDao->getCashier($cashierId);

        if ($cashierModel == null) throw new Exception('收银信息不存在!');

        if ($notify->getMoney() < $cashierModel->getTotalAmount())
            throw new Exception('支付金额不符');

        /** @var PayDao $payDao */
        $payDao = PayDao::getInstance();

        MasterDao::getSQLDB()->beginTransaction();

        try {

            if (!$cashierModel->getIsPay()) {
                $cashierModel->setIsPay(true);

                if ($notify instanceof WXPayNotifyResponse) {
                    $cashierModel->setPayType(PayType::WECHAT);
                } else if ($notify instanceof AliPayPayNotifyResponse) {
                    $cashierModel->setPayType(PayType::ALIPAY);
                } else {
                    throw new Exception('支付方式错误');
                }

                $cashierModel->setPayTime(Cal()->getDate());

                $cashierModel->setPaymentAmount($notify->getMoney());

                $cashierDao->setCashier($cashierModel);
            }

            $payModel = $payDao->getPayByCashier($cashierModel->getId());

            if ($payModel == null) $payModel = new CashierPayModel();

            $payModel->setCashierId($cashierModel->getId());

            $payModel->setPayee($notify->getPayee());

            $payModel->setPayer($notify->getPayment());

            $payModel->setTotalAmount($notify->getAmount());

            $payModel->setPaymentAmount($notify->getMoney());

            $payModel->setStatus($notify->getState());

            $payModel->setDate($notify->getTime());

            $this->setPayRecord($cashierModel, $payModel);

            $this->analysisPay($cashierModel);

            if (!MasterDao::getSQLDB()->commit()) throw new Exception('提交失败!');

            return true;
        } catch (Exception $e) {
            MasterDao::getSQLDB()->rollBack();

            throw $e;
        }
    }


    /**
     * 设置支付记录
     * @param AppCashierModel $cashierModel
     * @param CashierPayModel $payModel
     * @throws Exception
     */
    public function setPayRecord(AppCashierModel $cashierModel, CashierPayModel $payModel)
    {
        /** @var PayDao $payDao */
        $payDao = PayDao::getInstance();

        if (empty($payModel->getPayee())) throw new Exception('收款人错误!');

        if (empty($payModel->getPayer())) throw new Exception('付款人错误!');

        if (is_null($payModel->getTotalAmount())) throw new Exception('总金额错误!');

        if (is_null($payModel->getPaymentAmount())) throw new Exception('实际付款金额错误!');

        if (is_null($payModel->getStatus())) throw new Exception('支付状态错误!');

        if (is_null($payModel->getDate())) throw new Exception('支付时间错误!');

        if (empty($payModel->getId())) {
            $payModel->setCreatedId($cashierModel->getCreatedId());

            if (!$payDao->addPay($payModel)) throw new Exception('add cashier pay error!');
        } else {

            $payModel->setUpdatedId($cashierModel->getCreatedId());

            if (!$payDao->setPay($payModel)) throw new Exception('set cashier pay error!');
        }
    }

    /**
     * 解析支付
     * @param AppCashierModel $cashierModel
     * @param bool $isUseWallet
     * @throws ReflectionException
     * @throws Exception
     */
    public function analysisPay(AppCashierModel $cashierModel, bool $isUseWallet = false)
    {
        /** @var BindDao $bindDao */
        $bindDao = BindDao::getInstance();

        $bindList = $bindDao->getBindListByCashier($cashierModel->getId());

        if (empty($bindList)) throw new Exception('没有找到对应的bindList');

        foreach ($bindList as $bindModel) {

            BindType::i($bindModel->getBindType())
                ->then(BindType::RECHARGE, function () use ($isUseWallet, $cashierModel, $bindModel) {

                    if ($isUseWallet) throw new Exception('无法使用钱包支付!');

                    $this->recharge($cashierModel, $bindModel);
                })
                ->then(BindType::OPEN_MEMBER, function () use ($cashierModel, $bindModel) {

                    $this->openMember($cashierModel, $bindModel);
                })
                ->fetch();
        }
    }

    /**
     * 充值
     * @param AppCashierModel $cashierModel
     * @param CashierBindModel $bindModel
     * @throws ReflectionException
     * @throws Exception
     */
    private function recharge(AppCashierModel $cashierModel, CashierBindModel $bindModel)
    {
        /** @var RechargeDao $rechargeDao */
        $rechargeDao = RechargeDao::getInstance();

        $rechargeModel = $rechargeDao->getRecharge($bindModel->getBindId());

        if ($rechargeModel == null) throw new Exception('充值信息错误!');

        switch ($rechargeModel->getType()) {
            case Type::WALLET:
                $walletService = new WalletService($rechargeModel->getBindId());

                $walletService->addPoint($rechargeModel->getAmount(), $cashierModel->getTitle());
                break;
            case Type::INTEGRAL:
                $integralService = new IntegralService($rechargeModel->getBindId());

                $integralService->addPoint($rechargeModel->getAmount(), $cashierModel->getTitle());
                break;
        }

        /** @var RechargeDao $rechargeDao */
        $rechargeDao = RechargeDao::getInstance();

        $rechargeDao->setCashier($rechargeModel->getId(), $cashierModel->getId());
    }

    /**
     * 开通会员
     * @param AppCashierModel $cashierModel
     * @param CashierBindModel $bindModel
     * @throws Exception
     */
    private function openMember(AppCashierModel $cashierModel, CashierBindModel $bindModel)
    {
        /** @var OrderDao $orderDao */
        $orderDao = OrderDao::getInstance();

        $orderModel = $orderDao->getOrder($bindModel->getBindId());

        if ($orderModel == null) throw new Exception('开通会员订单信息不存在!');

        $orderModel->setCashierId($cashierModel->getId());

        $recordModel = new MemberRecordModel();

        $recordModel->setOrderId($orderModel->getId());

        $recordModel->setUserId($orderModel->getUserId());

        $recordModel->setMemberId($orderModel->getMemberId());

        $recordModel->setMode(MemberRecordMode::PAY);

        UserMemberService::getInstance()->openMember($recordModel);

        $orderDao->setCashier($orderModel->getId(), $orderModel->getCashierId());
    }
}
