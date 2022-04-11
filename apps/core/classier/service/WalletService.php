<?php

namespace apps\core\classier\service;

use apps\core\classier\bean\CashOutListCondition;
use apps\core\classier\dao\master\cashier\PayDao;
use apps\core\classier\dao\master\CashierDao;
use apps\core\classier\dao\master\CashOutDao;
use apps\core\classier\dao\master\RechargeDao;
use apps\core\classier\dao\MasterDao;
use apps\core\classier\enum\cashier\BindType;
use apps\core\classier\enum\pay\Type as PayType;
use apps\core\classier\enum\point\Type as PointType;
use apps\core\classier\enum\recharge\Type;
use apps\core\classier\model\AppCashierModel;
use apps\core\classier\model\AppCashoutModel;
use apps\core\classier\model\AppRechargeModel;
use apps\core\classier\model\CashierBindModel;
use apps\core\classier\model\CashierPayModel;
use Exception;
use ReflectionException;
use function rapidPHP\B;
use function rapidPHP\Cal;

class WalletService extends PointService
{

    /**
     * WalletService constructor.
     * @param $bindId
     * @throws ReflectionException
     */
    public function __construct($bindId)
    {
        parent::__construct($bindId, PointType::i(PointType::WALLET));
    }

    /**
     * 充值余额
     * @param float $point
     * @return int
     * @throws ReflectionException
     * @throws Exception
     */
    public function rechargeCashier(float $point)
    {
        if ($point < 1) throw new Exception('充值不能小于1');

        /** @var RechargeDao $rechargeDao */
        $rechargeDao = RechargeDao::getInstance();

        $rechargeModel = new AppRechargeModel();

        $rechargeModel->setBindId($this->getBindId());

        $rechargeModel->setAmount($point);

        $rechargeModel->setType(Type::WALLET);

        MasterDao::getSQLDB()->beginTransaction();

        try {
            $rechargeDao->addRecharge($rechargeModel);

            $cashierModel = new AppCashierModel();

            $cashierModel->setId(B()->onlyIdToInt());

            $cashierModel->setTotalAmount($point);

            $cashierModel->setTitle("充值{$point}元");

            $cashierModel->setCreatedId(parent::getBindId());

            $bindModel = new CashierBindModel();

            $bindModel->setBindType(BindType::RECHARGE);

            $bindModel->setBindId($rechargeModel->getId());

            $bindModel->setCreatedId(parent::getBindId());

            PayService::getInstance()->addCashier($cashierModel, $bindModel);

            if (!MasterDao::getSQLDB()->commit()) throw new Exception('提交充值失败!');

            return $cashierModel->getId();
        } catch (Exception $e) {
            MasterDao::getSQLDB()->rollBack();

            throw $e;
        }
    }

    /**
     * 申请提现
     * @param AppCashoutModel $cashOutModel
     * @return bool
     * @throws ReflectionException
     * @throws Exception
     */
    public function applyCashOut(AppCashoutModel $cashOutModel)
    {
        $amount = $cashOutModel->getAmount();

        if ($amount < 1) throw new Exception('提现金额不能少于1元');

        if (empty($cashOutModel->getUserId())) throw new Exception('用户id错误!');

        if (empty($cashOutModel->getAccount())) throw new Exception('账户错误!');

        if (empty($cashOutModel->getAccountType())) throw new Exception('账户类型错误!');

        $number = $this->getPoint()->getNumber();

        if ($number < $cashOutModel->getAmount()) throw new Exception('余额不足!');

        /** @var CashOutDao $cashOutDao */
        $cashOutDao = CashOutDao::getInstance();

        MasterDao::getSQLDB()->beginTransaction();

        try {
            $this->addPoint(-$amount, "申请提现{$amount}");

            $cashOutDao->addCashOut($cashOutModel);

            if (!MasterDao::getSQLDB()->commit()) throw new Exception('申请提现失败！');

            return true;
        } catch (Exception $e) {
            MasterDao::getSQLDB()->rollBack();

            throw $e;
        }
    }

    /**
     * 获取提现记录
     * @param CashOutListCondition $condition
     * @return AppCashoutModel[]
     * @throws Exception
     */
    public function getCashOutList(CashOutListCondition $condition): array
    {
        $condition->setBindId($this->getBindId());

        /** @var CashOutDao $cashOutDao */
        $cashOutDao = CashOutDao::getInstance();

        return $cashOutDao->getCashOutList($condition);
    }

    /**
     * 使用钱包支付
     * @param $cashierId
     * @return bool
     * @throws ReflectionException
     * @throws Exception
     */
    public function payment($cashierId): bool
    {
        if (empty($cashierId)) throw new Exception('收银id错误!');

        /** @var CashierDao $cashierDao */
        $cashierDao = CashierDao::getInstance();

        $cashierModel = $cashierDao->getCashier($cashierId);

        if ($cashierModel == null) throw new Exception('收银信息不存在!');

        if ($cashierModel->getIsPay()) throw new Exception('已经支付过了哦');

        if ($this->getPoint()->getNumber() < $cashierModel->getTotalAmount())
            throw new Exception('余额不足');

        /** @var PayDao $payDao */
        $payDao = PayDao::getInstance();

        MasterDao::getSQLDB()->beginTransaction();

        try {

            $cashierModel->setIsPay(true);

            $cashierModel->setPayType(PayType::WALLET);

            $cashierModel->setPayTime(Cal()->getDate());

            $cashierModel->setPaymentAmount($cashierModel->getTotalAmount());

            $cashierDao->setCashier($cashierModel);

            $this->addPoint(-$cashierModel->getTotalAmount(), "使用钱包支付 - {$cashierModel->getTitle()} - {$cashierModel->getId()}");

            $payModel = $payDao->getPayByCashier($cashierModel->getId());

            if ($payModel == null) $payModel = new CashierPayModel();

            $payModel->setId(B()->onlyIdToInt());

            $payModel->setCashierId($cashierModel->getId());

            $payModel->setPayee('system');

            $payModel->setPayer($this->getBindId());

            $payModel->setTotalAmount($cashierModel->getTotalAmount());

            $payModel->setPaymentAmount($cashierModel->getTotalAmount());

            $payModel->setStatus('SUCCESS');

            $payModel->setDate(Cal()->getDate());

            PayService::getInstance()->setPayRecord($cashierModel, $payModel);

            PayService::getInstance()->analysisPay($cashierModel, true);

            if (!MasterDao::getSQLDB()->commit()) throw new Exception('提交失败!');

            return true;
        } catch (Exception $e) {
            MasterDao::getSQLDB()->rollBack();

            throw $e;
        }
    }
}
