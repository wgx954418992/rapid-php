<?php

namespace apps\core\classier\dao\master\user;


use apps\core\classier\dao\MasterDao;
use apps\core\classier\model\UserLogModel;
use Exception;
use function rapidPHP\B;
use function rapidPHP\Cal;

class LogDao extends MasterDao
{

    /**
     * LogDao constructor.
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct(UserLogModel::class);
    }

    /**
     * 添加登录记录
     * @param UserLogModel $model
     * @return bool
     * @throws Exception
     */
    public function addLoginLog(UserLogModel $model): bool
    {
        $result = parent::add([
            'bind_id' => $model->getBindId(),
            'token' => $model->getToken(),
            'mode' => $model->getMode(),
            'date' => Cal()->getDate(),
            'ip' => $model->getIp(),
            'device' => $model->getDevice(),
            'is_delete' => false,
            'created_id' => $model->getCreatedId(),
            'created_time' => Cal()->getDate(),
        ], $inserId);

        if ($result) $model->setId($inserId);

        return $result;
    }

    /**
     * 获取登录次数
     * @param $bindId
     * @return int
     * @throws Exception
     */
    public function getLoginCount($bindId): int
    {
        return (int)parent::count('id')
            ->where('is_delete', false)
            ->where('bind_id', $bindId)
            ->getStatement()
            ->fetchValue('count');
    }

    /**
     * 获取登录记录
     * @param $bindId
     * @return array
     * @throws Exception
     */
    public function getLogList($bindId): array
    {
        return $this->get()
            ->where('bind_id', $bindId)
            ->where('is_delete', false)
            ->order('date', 'DESC')
            ->getStatement()
            ->fetchAll();
    }
}