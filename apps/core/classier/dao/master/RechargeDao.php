<?php

namespace apps\core\classier\dao\master;

use apps\core\classier\dao\MasterDao;
use apps\core\classier\model\AppRechargeModel;
use Exception;
use ReflectionException;
use function rapidPHP\Cal;

class RechargeDao extends MasterDao
{

    /**
     * RechargeDao constructor.
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct(AppRechargeModel::class);
    }

    /**
     * 添加充值
     * @param AppRechargeModel $rechargeModel
     * @return bool
     * @throws Exception
     */
    public function addRecharge(AppRechargeModel $rechargeModel): bool
    {
        $result = $this->add([
            'bind_id' => $rechargeModel->getBindId(),
            'amount' => $rechargeModel->getAmount(),
            'type' => $rechargeModel->getType(),
            'cashier_id' => $rechargeModel->getCashierId(),
            'is_delete' => false,
            'created_id' => $rechargeModel->getId(),
            'created_time' => Cal()->getDate(),
        ], $insertId);

        if ($result) $rechargeModel->setId($insertId);

        return $result;
    }

    /**
     * 设置收银信息
     * @param $id
     * @param $cashierId
     * @return bool
     * @throws Exception
     */
    public function setCashier($id, $cashierId): bool
    {
        return $this->set([
            'cashier_id' => $cashierId,
        ])->where('id', $id)->execute();
    }


    /**
     * 获取充值信息
     * @param $rechargeId
     * @return AppRechargeModel|null
     * @throws ReflectionException
     * @throws Exception
     */
    public function getRecharge($rechargeId)
    {
        return $this->get()
            ->where('is_delete', false)
            ->where('id', $rechargeId)
            ->getStatement()
            ->fetch($this->getModelOrClass());
    }

    /**
     * 获取列表
     * @param $bindId
     * @param $page
     * @param $size
     * @return array
     * @throws Exception
     */
    public function getList($bindId, $page, $size): array
    {
        return (array)$this->get()
            ->where('is_delete', false)
            ->where('bind_id', $bindId)
            ->order('created_time', 'DESC')
            ->limit($page, $size)
            ->getStatement()
            ->fetchAll($this->getModelOrClass());
    }
}
