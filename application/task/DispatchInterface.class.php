<?php


namespace application\task;


use application\dao\QueueDao;
use application\model\AppQueueModel;
use Exception;
use rapidPHP\library\core\server\SwooleServer;
use rapidPHP\library\core\server\TaskInterface;
use Swoole\Atomic;
use Swoole\Server;

abstract class DispatchInterface
{
    /**
     * @var TaskInterface
     */
    private $task;

    /**
     * DispatchInterface constructor.
     * @param TaskInterface $task
     */
    public function __construct(TaskInterface $task)
    {
        $this->task = $task;
    }

    /**
     * @return TaskInterface
     */
    public function getTask()
    {
        return $this->task;
    }

    /**
     * 处理
     * @param Server $server
     * @param $taskId
     * @param $reactorId
     * @param $data
     * @return mixed
     */
    abstract public function onTask(Server $server, $taskId, $reactorId, $data);

    /**
     * 处理
     * @param Server $server
     * @param $taskId
     * @param $data
     * @return mixed
     */
    abstract public function onFinish(Server $server, $taskId, $data);
}