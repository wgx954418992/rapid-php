<?php

namespace apps\core\classier\dao\master;


use apps\core\classier\dao\MasterDao;
use apps\core\classier\model\AppCashierModel;
use apps\core\classier\wrapper\CashierWrapper;
use Exception;
use function rapidPHP\Cal;

class CashierDao extends MasterDao
{

    /**
     * CashierDao constructor.
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct(AppCashierModel::class);
    }


    /**
     * 添加收银
     * @param AppCashierModel $cashierModel
     * @return bool
     * @throws Exception
     */
    public function addCashier(AppCashierModel $cashierModel): bool
    {
        $data = [
            'id' => $cashierModel->getId(),
            'title' => $cashierModel->getTitle(),
            'total_amount' => $cashierModel->getTotalAmount(),
            'payment_amount' => $cashierModel->getPaymentAmount(),
            'is_delete' => false,
            'created_id' => $cashierModel->getCreatedId(),
            'created_time' => Cal()->getDate(),
        ];

        if (!is_null($cashierModel->getIsPay())){
            $data['is_pay'] = $cashierModel->getIsPay();
        }

        if (!is_null($cashierModel->getPayType())){
            $data['pay_type'] = $cashierModel->getPayType();
        }

        if (!is_null($cashierModel->getPayTime())){
            $data['pay_time'] = $cashierModel->getPayTime();
        }

        return $this->add($data);
    }

    /**
     * 设置收银
     * @param AppCashierModel $cashierModel
     * @return bool
     * @throws Exception
     */
    public function setCashier(AppCashierModel $cashierModel): bool
    {
        $data = [
            'updated_id' => $cashierModel->getUpdatedId(),
            'updated_time' => Cal()->getDate(),
        ];

        if (!is_null($cashierModel->getIsPay())){
            $data['is_pay'] = $cashierModel->getIsPay();
        }

        if (!is_null($cashierModel->getPaymentAmount())){
            $data['payment_amount'] = $cashierModel->getPaymentAmount();
        }

        if (!is_null($cashierModel->getPayType())){
            $data['pay_type'] = $cashierModel->getPayType();
        }

        if (!is_null($cashierModel->getPayTime())){
            $data['pay_time'] = $cashierModel->getPayTime();
        }

        return $this->set($data)->where('id',$cashierModel->getId())->execute();
    }


    /**
     * 获取收银信息
     * @param $cashierId
     * @return CashierWrapper|null
     * @throws Exception
     */
    public function getCashier($cashierId): ?CashierWrapper
    {
        return $this->get()
            ->where('is_delete', false)
            ->where('id', $cashierId)
            ->getStatement()
            ->fetch(CashierWrapper::class);
    }
}
