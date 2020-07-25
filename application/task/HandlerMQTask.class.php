<?php


namespace application\task;


use application\config\QueueConfig;
use application\config\TaskConfig;
use application\model\AppQueueModel;
use application\service\QueueService;
use Exception;
use rapidPHP\library\core\server\TaskInterface;
use Swoole\Server;

class HandlerMQTask extends DispatchInterface
{


    /**
     * 最大任务数量
     * @var int
     */
    private $maxTaskNum;

    /**
     * HandlerMQTask constructor.
     * @param TaskInterface $task
     * @param $maxTaskNum
     */
    public function __construct(TaskInterface $task, $maxTaskNum)
    {
        parent::__construct($task);

        $this->maxTaskNum = round($maxTaskNum / 2);
    }

    /**
     * 处理任务消息
     * @param Server $server
     * @param $taskId
     * @param $reactorId
     * @param $data
     * @return mixed|void
     * @throws Exception
     */
    public function onTask(Server $server, $taskId, $reactorId, $data)
    {
        try {
            $list = QueueService::getInstance()->getNotExecQueue($this->maxTaskNum,
                QueueConfig::TYPE_SEND_MSG,
                QueueConfig::TYPE_SEND_EMAIL);

            if (empty($list)) {
                $server->finish($data);

                return;
            }

            $son = [];

            foreach ($list as $value) {
                $model = new AppQueueModel($value);

                $param = B()->jsonDecode($model->getParam());

                $son[] = [
                    TaskConfig::TASK_PARAM => $param,
                    TaskConfig::TASK_TYPE => $model->getType(),
                    TaskConfig::TASK_QUEUE_ID => $model->getId(),
                ];
            }

            $task = [
                TaskConfig::TASK_SON => $son,
                TaskConfig::TASK_TYPE => TaskConfig::TASK_SERVICE_HANDLER_MQ,
            ];

            $server->finish($task);
        } catch (Exception $e) {
            $server->finish($data);
        }
    }

    /**
     * 收到任务执行完毕
     * @param Server $server
     * @param $taskId
     * @param $data
     * @return mixed|void
     */
    public function onFinish(Server $server, $taskId, $data)
    {

    }
}