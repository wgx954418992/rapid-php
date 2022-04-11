<?php

namespace apps\core\classier\dao\master\cashier;


use apps\core\classier\dao\MasterDao;
use apps\core\classier\model\CashierPayModel;
use Exception;
use function rapidPHP\Cal;

class PayDao extends MasterDao
{

    /**
     * PayDao constructor.
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct(CashierPayModel::class);
    }


    /**
     * 添加收银实际收款
     * @param CashierPayModel $cashierModel
     * @return bool
     * @throws Exception
     */
    public function addPay(CashierPayModel $cashierModel): bool
    {
        $result = $this->add([
            'cashier_id' => $cashierModel->getCashierId(),
            'payee' => $cashierModel->getPayee(),
            'payer' => $cashierModel->getPayer(),
            'date' => $cashierModel->getDate(),
            'status' => $cashierModel->getStatus(),
            'total_amount' => $cashierModel->getTotalAmount(),
            'payment_amount' => $cashierModel->getPaymentAmount(),
            'is_delete' => false,
            'created_id' => $cashierModel->getCreatedId(),
            'created_time' => Cal()->getDate(),
        ], $insertId);

        if ($result) $cashierModel->setId($insertId);

        return $result;
    }

    /**
     * 修改收银实际收款
     * @param CashierPayModel $cashierModel
     * @return bool
     * @throws Exception
     */
    public function setPay(CashierPayModel $cashierModel): bool
    {
        return $this->set([
            'payee' => $cashierModel->getPayee(),
            'payer' => $cashierModel->getPayer(),
            'date' => $cashierModel->getDate(),
            'status' => $cashierModel->getStatus(),
            'total_amount' => $cashierModel->getTotalAmount(),
            'payment_amount' => $cashierModel->getPaymentAmount(),
            'updated_id' => $cashierModel->getUpdatedId(),
            'updated_time' => Cal()->getDate(),
        ])->where('id', $cashierModel->getId())->execute();
    }

    /**
     * 获取支付信息
     * @param $id
     * @return CashierPayModel|null
     * @throws Exception
     */
    public function getPay($id)
    {
        return $this->get()
            ->where('is_delete', false)
            ->where('id', $id)
            ->getStatement()
            ->fetch($this->getModelOrClass());
    }

    /**
     * 获取收银实际收款信息
     * @param $cashierId
     * @return CashierPayModel|null
     * @throws Exception
     */
    public function getPayByCashier($cashierId)
    {
        return $this->get()
            ->where('is_delete', false)
            ->where('cashier_id', $cashierId)
            ->getStatement()
            ->fetch($this->getModelOrClass());
    }
}
