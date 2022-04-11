<?php

namespace apps\core\classier\service;

use apps\core\classier\dao\master\RechargeDao;
use apps\core\classier\dao\MasterDao;
use apps\core\classier\enum\cashier\BindType;
use apps\core\classier\enum\point\Type as PointType;
use apps\core\classier\enum\recharge\Type;
use apps\core\classier\enum\setting\attribute\point\IntegralRule;
use apps\core\classier\model\AppCashierModel;
use apps\core\classier\model\AppPointModel;
use apps\core\classier\model\AppRechargeModel;
use apps\core\classier\model\CashierBindModel;
use apps\core\classier\model\PointDetailModel;
use apps\queue\classier\service\EventService;
use Exception;
use ReflectionException;
use function rapidPHP\B;

class IntegralService extends PointService
{

    /**
     * IntegralService constructor.
     * @param $bindId
     * @throws ReflectionException
     */
    public function __construct($bindId)
    {
        parent::__construct($bindId, PointType::i(PointType::INTEGRAL));
    }

    /**
     * 积分更改
     * @param AppPointModel $pointModel
     * @param PointDetailModel $detailModel
     * @throws Exception
     */
    public function onChange(AppPointModel $pointModel, PointDetailModel $detailModel)
    {
        EventService::getInstance()
            ->addIntegralChangeEvent($pointModel->getBindId(), $detailModel->getId());
    }

    /**
     * 充值积分
     * @param float $point
     * @return int
     * @throws ReflectionException
     * @throws Exception
     */
    public function rechargeCashier(float $point)
    {
        if ($point < 100) throw new Exception('充值不能小于100');

        /** @var RechargeDao $rechargeDao */
        $rechargeDao = RechargeDao::getInstance();

        $rechargeModel = new AppRechargeModel();

        $rechargeModel->setBindId($this->getBindId());

        $rechargeModel->setAmount($point);

        $rechargeModel->setType(Type::INTEGRAL);

        MasterDao::getSQLDB()->beginTransaction();

        try {
            $rechargeDao->addRecharge($rechargeModel);

            $cashierModel = new AppCashierModel();

            $cashierModel->setId(B()->onlyIdToInt());

            $cashierModel->setTotalAmount($point / 100);

            $cashierModel->setTitle("充值{$point}积分");

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
     * 通过积分规则设置积分点数
     * @param $userId
     * @param IntegralRule $integralRule
     * @param callable|null $verify
     * @return PointDetailModel|bool
     * @throws ReflectionException
     * @throws Exception
     */
    public static function setPointByIU($userId, IntegralRule $integralRule, ?callable $verify = null)
    {
        $integralService = new IntegralService($userId);

        $point = SettingService::getInstance()->getIntegralPoint($integralRule);

        if (is_null($point)) return true;

        if (is_callable($verify)) {
            if (call_user_func_array($verify, [$integralService, $point]) === false) {
                return false;
            }
        }

        return $integralService->addPoint($point, $integralRule->getText(), 0, $integralRule->getRawValue());
    }
}
