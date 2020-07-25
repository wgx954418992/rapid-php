<?php

namespace application\dao;


use application\config\QueueConfig;
use application\model\AppQueueModel;
use Exception;
use rapidPHP\library\core\app\DBDao;

class QueueDao extends DBDao
{
    public function __construct()
    {
        parent::__construct(AppQueueModel::class);
    }

    /**
     * 获取没有执行的队列
     * @param $size
     * @param array $type
     * @return array
     * @throws Exception
     */
    public function getNotExecQueue($size, $type = [])
    {
        $select = parent::get()
            ->where('trigger_time', time(), '<=:');

        if ($size > 0) $select->limit($size);

        $timeout = time() - QueueConfig::EXECUTION_TIMEOUT;

        $STATUS_WAITING = QueueConfig::STATUS_WAITING;

        $IN_EXECUTION = QueueConfig::STATUS_IN_EXECUTION;

        $select->where("(`status`={$STATUS_WAITING} or (`status`={$IN_EXECUTION} and status_time<={$timeout} ))");

        if (!empty($type)) $select->in('type', $type);

        return $select->get()->getResult();
    }


    /**
     * 设置队列状态
     * @param $queueId
     * @param $status
     * @param $remark
     * @return bool
     * @throws Exception
     */
    public function setQueueStatus($queueId, $status, $remark = null)
    {
        $data['status'] = $status;

        $data['status_time'] = time();

        $data['updated_id'] = -1;

        $data['updated_time'] = Cal()->getDate();

        if (empty($remark)) $data['remark'] = $remark;

        return parent::set($data)->in('id', $queueId)->execute();
    }

    /**
     * 获取队列消息信息
     * @param $queueId
     * @return AppQueueModel
     * @throws Exception
     */
    public function getQueue($queueId)
    {
        /** @var AppQueueModel $model */
        $model = parent::get()
            ->where('is_delete', 0)
            ->where('id', $queueId)->get()
            ->getInstance();

        return $model;
    }

    /**
     * 添加队列消息
     * @param AppQueueModel $queueModel
     * @return bool
     * @throws Exception
     */
    public function addQueue(AppQueueModel $queueModel)
    {
        $data = [
            'id' => $queueModel->getId(),
            'type' => $queueModel->getType(),
            'param' => json_encode($queueModel->getParam()),
            'trigger_time' => $queueModel->getTriggerTime(),
            'status' => QueueConfig::STATUS_WAITING,
            'status_time' => time(),
            'is_delete' => 0,
            'created_id' => $queueModel->getCreatedId(),
            'created_time' => Cal()->getDate(),
        ];

        if(empty($queueModel->getParentId())) $data['parent_id'] = $queueModel->getParentId();

        return parent::add($data);
    }

    /**
     * 设置队列消息触发时间
     * @param $userId
     * @param $queueId
     * @param $triggerTime
     * @return bool
     * @throws Exception
     */
    public function setQueueTriggerTime($userId, $queueId, $triggerTime)
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
    public function delQueue($userId, $queueId)
    {
        $data = [
            'is_delete' => 1,
            'updated_id' => $userId,
            'updated_time' => B()->onlyIdToInt(),
        ];

        return parent::set($data)
            ->where('id', $queueId)
            ->where('parent_id', $queueId)
            ->execute();
    }
}