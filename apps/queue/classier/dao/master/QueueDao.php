<?php

namespace apps\queue\classier\dao\master;

use apps\core\classier\dao\MasterDao;
use apps\core\classier\model\AppQueueModel;
use Exception;
use apps\queue\classier\config\QueueConfig;
use function rapidPHP\Cal;

class QueueDao extends MasterDao
{
    /**
     * QueueDao constructor.
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct(AppQueueModel::class);
    }

    /**
     * 获取没有执行的队列
     * @param $number
     * @param array $type
     * @return AppQueueModel[]|null
     * @throws Exception
     */
    public function getNotExecQueue($number, $type = []): ?array
    {
        $currentTime = (int)microtime(true) * 1000;

        $select = parent::get()
            ->where('trigger_time', $currentTime, '<=:');

        if ($number > 0) $select->limit($number);

        $timeout = $currentTime - QueueConfig::EXECUTION_TIMEOUT;

        $STATUS_WAITING = QueueConfig::STATUS_WAITING;

        $IN_EXECUTION = QueueConfig::STATUS_IN_EXECUTION;

        $select->where("(`status`={$STATUS_WAITING} or (`status`={$IN_EXECUTION} and status_time<={$timeout} ))");

        if (!empty($type)) $select->in('type', $type);

        return $select
            ->forUpdate()
            ->getStatement()
            ->fetchAll($this->getModelOrClass());
    }


    /**
     * 设置队列状态
     * @param $queueId
     * @param $status
     * @param $remark
     * @return bool
     * @throws Exception
     */
    public function setQueueStatus($queueId, $status, $remark = null): bool
    {
        $data['status'] = $status;

        $data['status_time'] = microtime(true) * 1000;

        $data['updated_id'] = -1;

        $data['updated_time'] = Cal()->getDate();

        if (empty($remark)) $data['remark'] = $remark;

        return parent::set($data)->in('id', $queueId)->execute();
    }

    /**
     * 获取队列消息信息
     * @param $queueId
     * @return AppQueueModel|null
     * @throws Exception
     */
    public function getQueue($queueId): ?AppQueueModel
    {
        /** @var AppQueueModel $model */
        $model = parent::get()
            ->where('is_delete', 0)
            ->where('id', $queueId)
            ->forUpdate()
            ->getStatement()
            ->fetch($this->getModelOrClass());

        return $model;
    }

    /**
     * 添加队列消息
     * @param AppQueueModel $queueModel
     * @return bool
     * @throws Exception
     */
    public function addQueue(AppQueueModel $queueModel): bool
    {
        $data = [
            'parent_id' => $queueModel->getParentId(),
            'bind_id' => $queueModel->getBindId(),
            'type' => $queueModel->getType(),
            'param' => json_encode($queueModel->getParam()),
            'trigger_time' => $queueModel->getTriggerTime(),
            'status' => QueueConfig::STATUS_WAITING,
            'status_time' => microtime(true) * 1000,
            'is_delete' => 0,
            'created_id' => $queueModel->getCreatedId(),
            'created_time' => Cal()->getDate(),
        ];

        if (empty($queueModel->getParentId())) $data['parent_id'] = $queueModel->getParentId();

        $result = parent::add($data, $insertId);

        $queueModel->setId($insertId);

        return $result;
    }

    /**
     * 设置队列消息触发时间
     * @param $userId
     * @param $queueId
     * @param $triggerTime
     * @return bool
     * @throws Exception
     */
    public function setQueueTriggerTime($userId, $queueId, $triggerTime): bool
    {
        return parent::set([
            'trigger_time' => $triggerTime,
            'updated_id' => $userId,
            'updated_time' => Cal()->getDate(),
        ])->where('id', $queueId)->execute();
    }

    /**
     * 删除队列
     * @param $userId
     * @param $queueId
     * @return bool
     * @throws Exception
     */
    public function delQueue($userId, $queueId): bool
    {
        $data = [
            'is_delete' => 1,
            'updated_id' => $userId,
            'updated_time' => Cal()->getDate(),
        ];

        return parent::set($data)
            ->where('id', $queueId)
            ->where('parent_id', $queueId)
            ->execute();
    }

    /**
     * 通过bindId 取消没有执行或者超时的队列
     * @param $userId
     * @param $bindId
     * @param $remark
     * @return bool
     * @throws Exception
     */
    public function cancelQueueByBindId($userId, $bindId, $remark = null): bool
    {
        $data['status'] = QueueConfig::STATUS_CANCEL;

        $data['status_time'] = microtime(true) * 1000;

        $data['updated_id'] = $userId;

        $data['updated_time'] = Cal()->getDate();

        if (empty($remark)) $data['remark'] = $remark;

        $currentTime = (int)microtime(true) * 1000;

        $timeout = $currentTime - QueueConfig::EXECUTION_TIMEOUT;

        $STATUS_WAITING = QueueConfig::STATUS_WAITING;

        $IN_EXECUTION = QueueConfig::STATUS_IN_EXECUTION;

        return parent::set($data)
            ->in('id', $bindId)
            ->where("(`status`={$STATUS_WAITING} or (`status`={$IN_EXECUTION} and status_time<={$timeout} ))")
            ->execute();
    }
}