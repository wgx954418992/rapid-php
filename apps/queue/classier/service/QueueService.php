<?php


namespace apps\queue\classier\service;


use apps\core\classier\dao\MasterDao;
use apps\core\classier\model\AppOrderModel;
use apps\core\classier\model\AppQueueModel;
use apps\core\classier\model\AppUserModel;
use Exception;
use apps\queue\classier\config\QueueConfig;
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

        $queueModel->setTriggerTime($triggerTime);

        $queueModel->setCreatedId($createdId);

        if (!empty($parentId)) $queueModel->setParentId($parentId);

        if (!$this->queueDao->addQueue($queueModel)) throw new Exception('添加队列消息失败!');

        return $queueModel;
    }

    /**
     * 添加订单处理队列
     * @param $type
     * @param AppOrderModel|null $orderModel
     * @param null $triggerTime
     * @param array $options
     * @param null $parentId
     * @return AppQueueModel
     * @throws Exception
     */
    public function addOrderQueue($type, ?AppOrderModel $orderModel, $triggerTime = null, $options = [], $parentId = null)
    {
        if (empty($triggerTime)) $triggerTime = microtime(true) * 1000;

        return $this->addQueue(
            $type,
            array_merge($options, [QueueConfig::PARAM_KEY_ORDER_ID => $orderModel->getId()]),
            $orderModel->getId(),
            $triggerTime,
            $orderModel->getUserId(),
            $parentId
        );
    }

    /**
     * 添加发送模板消息
     * @param $userId
     * @param $templateId
     * @param $openIdList
     * @param $page
     * @param $data
     * @param null $parentId
     * @return array
     * @throws Exception
     */
    public function addNotifyQueue(AppUserModel $userModel, $templateId, $openIdList, $page, $data, $parentId = null)
    {
        if (empty($openIdList)) return [];

        if (empty($templateId)) throw new Exception('模板id错误!');

        if (empty($data)) throw new Exception('data 错误!');

        if (is_string($openIdList)) $openIdList = [$openIdList];

        $queueIdList = [];

        foreach ($openIdList as $openId) {

            $params = [
                QueueConfig::PARAM_KEY_MINI_TEMPLATE_ID => $templateId,
                QueueConfig::PARAM_KEY_MINI_OPEN_ID => $openId,
                QueueConfig::PARAM_KEY_MINI_PAGE => $page,
                QueueConfig::PARAM_KEY_MINI_DATA => $data,
            ];

            $model = $this->addQueue(
                QueueConfig::TYPE_NOTIFY_MINI,
                $params,
                $openId,
                $triggerTime,
                $orderModel->getUserId(),
                $parentId
            );

            $model = new AppQueueModel();

            if (!empty($parentId)) $model->setParentId($parentId);

            $model->setType(QueueConfig::TYPE_NOTIFY_MINI);

            $model->setParam($msg);

            $model->setTriggerTime(time());

            $model->setCreatedId($userId);

            if (!$this->queueDao->addQueue($model)) throw new Exception('添加发送模板消息失败!');

            $queueIdList[$openId] = $queueId;
        }

        return $queueIdList;
    }


    /**
     * 获取没有执行的队列
     * @param $number
     * @param array $type
     * @return AppQueueModel[]
     * @throws Exception
     */
    public function getNotExecQueue($number, ...$type): array
    {
        MasterDao::getSQLDB()->beginTransaction();

        try {
            $list = $this->queueDao->getNotExecQueue($number, $type);

            if (!empty($list)) {
                $ids = array_column($list, 'id');

                $this->setQueueStatus($ids, QueueConfig::STATUS_IN_EXECUTION);
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

        if (!$this->queueDao->setQueueStatus($queueId, $status, $remark))
            throw new Exception('修改队列状态失败!');

        return true;
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