<?php


namespace application\service;


use application\config\QueueConfig;
use application\dao\QueueDao;
use application\model\AppQueueModel;
use Exception;

class QueueService
{

    /**
     * @var QueueDao
     */
    private $queueDao;

    /**
     * @var QueueService
     */
    private static $instance;

    /**
     * QueueService constructor.
     */
    public function __construct()
    {
        $this->queueDao = new QueueDao();
    }

    /**
     * @return QueueService
     */
    public static function getInstance()
    {
        return self::$instance instanceof self ? self::$instance : self::$instance = new self();
    }

    /**
     * 添加任务队列
     * @param $type
     * @param $param
     * @param $bindId
     * @param $triggerTime
     * @param $createdId
     * @return AppQueueModel
     * @throws Exception
     */
    public function addQueue($type, $param, $bindId, $triggerTime, $createdId = null)
    {
        $queueModel = new AppQueueModel();

        $queueModel->setId(B()->onlyIdToInt());

        $queueModel->setBindId($bindId);

        $queueModel->setType($type);

        $queueModel->setParam($param);

        $queueModel->setTriggerTime($triggerTime);

        $queueModel->setCreatedId($createdId);

        if (!$this->queueDao->addQueue($queueModel)) throw new Exception('添加队列消息失败!');

        return $queueModel;
    }

    /**
     * 获取没有执行的队列
     * @param $maxTaskNum
     * @param array $type
     * @return array
     * @throws Exception
     */
    public function getNotExecQueue($maxTaskNum, ...$type)
    {
        $list = $this->queueDao->getNotExecQueue($maxTaskNum, $type);

        if (empty($list)) return [];

        $ids = array_column($list, 'id');

        $this->setQueueStatus($ids, QueueConfig::STATUS_IN_EXECUTION);

        return $list;
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
        if (empty($queueId)) return true;

        if (!$this->queueDao->setQueueStatus($queueId, $status, $remark))
            throw new Exception('修改队列状态失败!');

        return true;
    }
}