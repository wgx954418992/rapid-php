<?php

namespace apps\core\classier\dao\master;

use apps\core\classier\bean\SignListCondition;
use apps\core\classier\dao\MasterDao;
use apps\core\classier\model\AppSignModel;
use Exception;
use function rapidPHP\Cal;

class SignDao extends MasterDao
{
    /**
     * SignDao
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct(AppSignModel::class);
    }

    /**
     * 签到
     * @param AppSignModel $signModel
     * @return bool
     * @throws Exception
     */
    public function addSign(AppSignModel $signModel): bool
    {
        $result = parent::add([
            'user_id' => $signModel->getUserId(),
            'ymd' => $signModel->getYmd(),
            'is_delete' => false,
            'created_id' => $signModel->getCreatedId(),
            'created_time' => Cal()->getDate(),
        ], $inserId);

        if ($result) $signModel->setId($inserId);

        return $result;
    }


    /**
     * 判断是否已经签到
     * @param $userId
     * @param null $ymd
     * @return bool
     * @throws Exception
     */
    public function checkSign($userId, $ymd = null): bool
    {
        if (empty($ymd)) $ymd = Cal()->getDate(time(), 'Y-m-d');

        $data = $this->get()
            ->where('user_id', $userId)
            ->where('ymd', $ymd)
            ->where('is_delete', false)
            ->getStatement()
            ->fetch();

        return !empty($data);
    }

    /**
     * 获取签到列表
     * @param SignListCondition $condition
     * @return AppSignModel[]
     * @throws Exception
     */
    public function getSignList(SignListCondition $condition)
    {
        $select = parent::get()
            ->where('is_delete', false);

        if (!empty($condition->getIds())) $select->in("id", $condition->getIds());

        if (!empty($condition->getKeyword())) {

            $keyName = $select->getOptionsKey('keyword');

            $select->addOptions("%{$condition->getKeyword()}%", $keyName);

            $select->where("(concat(id,user_id)) LIKE :{$keyName} ");
        }

        if (!empty($condition->getStartTime())) $select->where("ymd", $condition->getStartTime(), '>=:');

        if (!empty($condition->getEndTime())) $select->where("ymd", $condition->getEndTime(), '<:');

        return (array)$select
            ->order($condition->getOrderName(), $condition->getOrderType())
            ->getStatement()
            ->fetchAll($this->getModelOrClass());
    }

}
