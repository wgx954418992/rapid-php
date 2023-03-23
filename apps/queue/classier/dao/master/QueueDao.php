<?php

namespace apps\queue\classier\dao\master;

use apps\core\classier\dao\MasterDao;
use apps\core\classier\model\AppQueueModel;
use apps\queue\classier\enum\Status;
use Exception;
use apps\queue\classier\config\QueueConfig;
use rapidPHP\modules\reflection\classier\Utils;
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
            'status' => Status::WAITING,
            'status_time' => microtime(true) * 1000,
            'is_delete' => false,
            'created_id' => $queueModel->getCreatedId(),
            'created_time' => Cal()->getDate(),
        ];

        if (empty($queueModel->getRemark())) $data['remark'] = $queueModel->getRemark();

        if (empty($queueModel->getParentId())) $data['parent_id'] = $queueModel->getParentId();

        $result = parent::add($data, $insertId);

        $queueModel->setId($insertId);

        return $result;
    }

    /**
     * 获取没有执行的队列
     * @param $number
     * @param array $type
     * @param null $ids
     * @return AppQueueModel[]|null
     * @throws Exception
     */
    public function getNotExecQueue($number, array $type = [], &$ids = null): ?array
    {
        $currentTime = (int)microtime(true) * 1000;

        $select = parent::get()
            ->where('trigger_time', $currentTime, '<=:');

        if ($number > 0) $select->limit($number);

        $timeout = $currentTime - QueueConfig::getInstance()->getExecutionTimeout();

        $STATUS_WAITING = Status::WAITING;

        $IN_EXECUTION = Status::IN_EXECUTION;

        $select->where("(`status`={$STATUS_WAITING} or (`status`={$IN_EXECUTION} and status_time<={$timeout} ))");

        if (!empty($type)) $select->in('type', $type);

        $result = $select
            ->forUpdate()
            ->getStatement()
            ->fetchAll();

        if (!$result) return null;

        $ids = array_column($result, 'id');

        Utils::getInstance()->toObjects($this->getModelOrClass(), $result);

        return $result;
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

        if (!empty($remark)) $data['remark'] = $remark;

        if (is_array($queueId)){
            return $this->set($data)->in('id', $queueId)->execute();
        }else{
            return $this->set($data)->where('id', $queueId)->execute();
        }
    }

    /**
     * 获取队列消息信息
     * @param $queueId
     * @return AppQueueModel|null
     * @throws Exception
     */
    public function getQueue($queueId): ?AppQueueModel
    {
        return parent::get()
            ->where('is_delete', false)
            ->where('id', $queueId)
            ->forUpdate()
            ->getStatement()
            ->fetch($this->getModelOrClass());
    }

    /**
     * 获取队列消息信息
     * @param $bindId
     * @param null $type
     * @param null $status
     * @return AppQueueModel|null
     * @throws Exception
     */
    public function getQueueByBTS($bindId, $type = null, $status = null): ?AppQueueModel
    {
        $select = parent::get()->where('is_delete', false);

        if (!is_null($bindId)) $select->where('bind_id', $bindId);

        if (!is_null($type)) $select->where('type', $type);

        if (!is_null($status)) $select->in('status', $status);

        return $select
            ->forUpdate()
            ->getStatement()
            ->fetch($this->getModelOrClass());
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
            'is_delete' => true,
            'updated_id' => $userId,
            'updated_time' => Cal()->getDate(),
        ];

        return $this->set($data)
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
        $data['status'] = Status::CANCEL;

        $data['status_time'] = microtime(true) * 1000;

        $data['updated_id'] = $userId;

        $data['updated_time'] = Cal()->getDate();

        if (empty($remark)) $data['remark'] = $remark;

        $currentTime = (int)microtime(true) * 1000;

        $timeout = $currentTime - QueueConfig::getInstance()->getExecutionTimeout();

        $STATUS_WAITING = Status::WAITING;

        $IN_EXECUTION = Status::IN_EXECUTION;

        return $this->set($data)
            ->in('id', $bindId)
            ->where("(`status`={$STATUS_WAITING} or (`status`={$IN_EXECUTION} and status_time<={$timeout} ))")
            ->execute();
    }
}
