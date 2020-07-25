<?php


namespace application\task;


use application\config\QueueConfig;
use application\config\TaskConfig;
use application\service\QueueService;
use Exception;
use rapidPHP\library\core\server\TaskInterface;
use Swoole\Server;

class SendMsgTask extends DispatchInterface
{


    /**
     * SendMsgTask constructor.
     * @param TaskInterface $task
     */
    public function __construct(TaskInterface $task)
    {
        parent::__construct($task);

        //init dao model ...
    }

    /**
     * 获取任务接口
     * @return UnifiedDispatchTask
     */
    public function getTask()
    {
        /** @var UnifiedDispatchTask $task */
        $task = parent::getTask();

        return $task;
    }


    /**
     * 收到任务
     * @param Server $server
     * @param $taskId
     * @param $reactorId
     * @param $data
     * @return mixed|void
     */
    public function onTask(Server $server, $taskId, $reactorId, $data)
    {
        try {
            $param = B()->getData($data, TaskConfig::TASK_PARAM);

            if (empty($param)) throw new Exception('参数错误');

            $telephone = B()->getData($param, 'telephone');

            if (empty($telephone)) throw new Exception('telephone 错误');

            //sendSMs(telephone)
        } catch (Exception $e) {
            var_dump($e->getMessage());
            // add log
        }

        $server->finish($data);
    }

    /**
     * 发送短信完毕，结束掉这个队列
     * @param Server $server
     * @param $taskId
     * @param $data
     * @return mixed|void
     * @throws Exception
     */
    public function onFinish(Server $server, $taskId, $data)
    {
        if (isset($data[TaskConfig::TASK_QUEUE_ID])) {
            QueueService::getInstance()->setQueueStatus(
                $data[TaskConfig::TASK_QUEUE_ID],
                QueueConfig::STATUS_COMPLETE
            );
        }
    }
}