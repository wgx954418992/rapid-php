<?php

namespace apps\core\classier\dao\master;


use apps\core\classier\bean\CashOutListCondition;
use apps\core\classier\dao\MasterDao;
use apps\core\classier\model\AppCashoutModel;
use Exception;
use rapidPHP\modules\database\sql\classier\Driver;
use rapidPHP\modules\database\sql\classier\driver\Mysql;
use function rapidPHP\Cal;

class CashOutDao extends MasterDao
{

    /**
     * CashOutDao constructor.
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct(AppCashoutModel::class);
    }

    /**
     * 添加申请提现
     * @param AppCashoutModel $cashOutModel
     * @return bool
     * @throws Exception
     */
    public function addCashOut(AppCashoutModel $cashOutModel): bool
    {
        $result = $this->add([
            'user_id' => $cashOutModel->getUserId(),
            'amount' => $cashOutModel->getAmount(),
            'account' => $cashOutModel->getAccount(),
            'account_type' => $cashOutModel->getAccountType(),
            'name' => $cashOutModel->getName(),
            'status' => $cashOutModel->getStatus(),
            'is_delete' => false,
            'created_id' => $cashOutModel->getCreatedId(),
            'created_time' => Cal()->getDate(),
        ], $insertId);

        if ($result) $cashOutModel->setId($insertId);

        return $result;
    }


    /**
     * 设置提现状态
     * @param AppCashoutModel $identityModel
     * @return bool
     * @throws Exception
     */
    public function setCashoutStatus(AppCashoutModel $identityModel): bool
    {
        return $this->set([
            'status' => $identityModel->getStatus(),
            'updated_id' => $identityModel->getUpdatedId(),
            'updated_time' => Cal()->getDate(),
        ])
            ->where('id', $identityModel->getId())
            ->execute();
    }

    /**
     * 后去收银账号信息
     * @param $cashoytId
     * @return AppCashoutModel|null
     * @throws Exception
     */
    public function getCashout($cashoytId): ?AppCashoutModel
    {
        return $this->get()
            ->where('is_delete', false)
            ->where('id', $cashoytId)
            ->getStatement()
            ->fetch(AppCashoutModel::class);
    }

    /**
     * 获取提现列表查询对象
     * @param CashOutListCondition $condition
     * @return Driver|Mysql
     * @throws Exception
     */
    private function getCashoutListSelect(CashOutListCondition $condition)
    {
        $select = $this->get();

        if (!empty($condition->getKeyword())) {

            $keyName = $select->getOptionsKey('keyword');

            $select->addOptions("%{$condition->getKeyword()}%", $keyName);

            $select->where("(concat(id,account,name)) LIKE :{$keyName} ");
        }

        if ($condition->getIds()) $select->in('id', $condition->getIds());

        if ($condition->getBindId()) $select->in('bind_id', $condition->getBindId());

        if ($condition->getStatus()) $select->in('status', $condition->getStatus());

        if (!empty($condition->getStartTime())) $select->where("created_time", $condition->getStartTime(), '>=:');

        if (!empty($condition->getEndTime())) $select->where("created_time", $condition->getEndTime(), '<:');

        return $select->where('is_delete', false);
    }


    /**
     * 获取提现列表
     * @param CashOutListCondition $condition
     * @return AppCashoutModel[]
     * @throws Exception
     */
    public function getCashoutList(CashOutListCondition $condition): array
    {
        $select = $this->getCashoutListSelect($condition);

        $select->limit($condition->getPage(), $condition->getSize());

        return (array)$select->order($condition->getOrderName(), $condition->getOrderType())
            ->getStatement()
            ->fetchAll(AppCashoutModel::class);
    }

    /**
     * 获取提现列表查询总数量
     * @param CashOutListCondition $condition
     * @return int
     * @throws Exception
     */
    public function getCashoutListCount(CashOutListCondition $condition): int
    {
        $select = $this->getCashoutListSelect($condition);

        return (int)$select->resetSql('select')
            ->select('count(id) as count')
            ->getStatement()
            ->fetchValue('count');
    }

}
