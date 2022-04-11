<?php

namespace apps\core\classier\dao\master\cashier;


use apps\core\classier\dao\MasterDao;
use apps\core\classier\model\CashierBindModel;
use Exception;
use function rapidPHP\Cal;

class BindDao extends MasterDao
{

    /**
     * BindDao constructor.
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct(CashierBindModel::class);
    }


    /**
     * 添加收银关联表
     * @param CashierBindModel $bindModel
     * @return bool
     * @throws Exception
     */
    public function addBind(CashierBindModel $bindModel): bool
    {
        $result = $this->add([
            'cashier_id' => $bindModel->getCashierId(),
            'bind_id' => $bindModel->getBindId(),
            'bind_type' => $bindModel->getBindType(),
            'is_delete' => false,
            'created_id' => $bindModel->getId(),
            'created_time' => Cal()->getDate(),
        ], $insertId);

        if ($result) $bindModel->setId($insertId);

        return $result;
    }


    /**
     * 通过收银获取列表
     * @param $cashierId
     * @return CashierBindModel[]
     * @throws Exception
     */
    public function getBindListByCashier($cashierId): array
    {
        return (array)$this->get()
            ->where('is_delete', false)
            ->where('cashier_id', $cashierId)
            ->getStatement()
            ->fetchAll($this->getModelOrClass());
    }

    /**
     * 获取收银关联表信息通过绑定的id列表
     * @param $bindIds
     * @return CashierBindModel|null
     * @throws Exception
     */
    public function getBindByBindList($bindIds)
    {
        return $this->get()
            ->where('is_delete', false)
            ->in('bind_id', $bindIds)
            ->getStatement()
            ->fetch($this->getModelOrClass());
    }
}
