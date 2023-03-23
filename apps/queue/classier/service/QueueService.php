<?php


namespace apps\queue\classier\service;


use apps\core\classier\dao\MasterDao;
use apps\core\classier\model\AppQueueModel;
use apps\queue\classier\enum\Status;
use Exception;
use apps\queue\classier\dao\master\QueueDao;
use rapidPHP\modules\common\classier\Instances;

class QueueService
{

    /**
     * 使用单例模式
     */
    use Instances;

    /**
     * 不存在创建
     * @return static
     */
    public static function onNotInstance()
    {
        return new static();
    }

    /**
     * @var QueueDao
     */
    private $queueDao;

    /**
     * QueueService constructor.
     */
    public function __construct()
    {
        $this->queueDao = QueueDao::getInstance();
    }

    /**
     * 添加任务队列
     * @param $type
     * @param $param
     * @param $bindId
     * @param $triggerTime
     * @param $createdId
     * @param null $parentId
     * @return AppQueueModel
     * @throws Exception
     */
    public function addQueue($type, $param, $bindId, $triggerTime, $createdId, $parentId = null)
    {
        $queueModel = new AppQueueModel();

        $queueModel->setBindId($bindId);

        $queueModel->setType($type);

        $queueModel->setParam($param);

        $queueModel->setRemark('');

        if (is_null($triggerTime)) $triggerTime = microtime(true) * 1000;

        if (strlen($triggerTime) === 10) {
            $triggerTime = $triggerTime * 1000;
        }

        $queueModel->setTriggerTime($triggerTime);

        $queueModel->setCreatedId($createdId);

        if (!empty($parentId)) $queueModel->setParentId($parentId);

        if (!$this->queueDao->addQueue($queueModel)) throw new Exception('添加队列消息失败!');

        return $queueModel;
    }


    /**
     * 获取没有执行的队列
     * @param $number
     * @param array $type
     * @return AppQueueModel[]|null
     * @throws Exception
     */
    public function getNotExecQueue($number, ...$type): ?array
    {
        MasterDao::getSQLDB()->beginTransaction();

        try {
            $list = $this->queueDao->getNotExecQueue($number, $type, $ids);

            if (!empty($ids)) {
                $this->queueDao->setQueueStatus($ids, Status::IN_EXECUTION);
            }

            if (!MasterDao::getSQLDB()->commit()) throw new Exception('提交队列事务失败!');

            return $list;
        } catch (Exception $e) {
            MasterDao::getSQLDB()->rollBack();

            throw $e;
        }
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
        if (empty($queueId)) return true;

        $isThing = MasterDao::getSQLDB()->isInThing();

        if (!$isThing) MasterDao::getSQLDB()->beginTransaction();

        try {

            $queueModel = $this->queueDao->getQueue($queueId);

            if ($queueModel == null) return true;

            if (!$this->queueDao->setQueueStatus($queueId, $status, $remark))
                throw new Exception('修改队列状态失败!');

            if (!$isThing && !MasterDao::getSQLDB()->commit()) throw new Exception('提交队列事务失败!');

        } catch (Exception $e) {
            if (!$isThing) MasterDao::getSQLDB()->rollBack();

            throw $e;
        }

        return true;
    }


    /**
     * 获取队列消息信息
     * @param $bindId
     * @param null $type
     * @param null $status
     * @return AppQueueModel|null
     * @throws Exception
     */
    public function getQueueByBTS($bindId, $type = null, $status = null)
    {
        return $this->queueDao->getQueueByBTS($bindId, $type, $status);
    }

    /**
     * 通过bindId 取消队列
     * @param $userId
     * @param $bindId
     * @param null $remark
     * @return bool
     * @throws Exception
     */
    public function cancelQueueByBindId($userId, $bindId, $remark = null): bool
    {
        if (!$this->queueDao->cancelQueueByBindId($userId, $bindId, $remark))
            throw new Exception('取消队列失败!');

        return true;
    }

}
