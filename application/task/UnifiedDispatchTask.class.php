<?php


namespace application\task;


use application\config\QueueConfig;
use application\config\TaskConfig;
use Exception;
use rapidPHP\library\core\server\SwooleServer;
use rapidPHP\library\core\server\TaskInterface;
use ReflectionException;
use Swoole\Atomic;
use Swoole\Server;
use Swoole\Timer;

class UnifiedDispatchTask extends TaskInterface
{

    /**
     * 任务无锁原子计数器
     * @var Atomic
     */
    private $taskAtomic;

    /**
     * 最大任务数量
     * @var int
     */
    private $maxTaskNum;

    /**
     * 处理任务池
     * @var array
     */
    public $handlerTasks = [
        TaskConfig::TASK_SERVICE_HANDLER_MQ => HandlerMQTask::class,
        QueueConfig::TYPE_SEND_MSG => SendMsgTask::class,
    ];

    /**
     * UnifiedDispatchTask constructor.
     * @param SwooleServer $swooleServer
     * @throws ReflectionException
     */
    public function __construct(SwooleServer $swooleServer)
    {
        parent::__construct($swooleServer);

        $this->taskAtomic = new Atomic(0);

        $this->maxTaskNum = (int)B()->getData($swooleServer->getOptions(), $swooleServer::KEY_TASK_WORKER_NUM);

        foreach ($this->handlerTasks as $index => $task) {
            $this->handlerTasks[$index] = B()->reflectionInstance($task, [$this, $this->maxTaskNum]);
        }
    }

    /**
     * 初始化
     */
    public function init()
    {
        parent::init();

        /**
         * 每隔一秒添加执行任务队列消息处理
         */
        Timer::tick(1000, function () {
            try {
                $this->addTask([TaskConfig::TASK_TYPE => TaskConfig::TASK_SERVICE_HANDLER_MQ]);
            } catch (Exception $e) {
                echo $e->getMessage() . "\n";
            }
        });
    }

    /**
     * 获取处理任务对象
     * @param $data
     * @return object|null
     */
    private function getHandlerTask($data)
    {
        $type = B()->getData($data, TaskConfig::TASK_TYPE);

        /** @var DispatchInterface $class */
        $class = isset($this->handlerTasks[$type]) ? $this->handlerTasks[$type] : null;

        return $class;
    }

    /**
     * 添加任务
     * @param $data
     * @return bool
     * @throws Exception
     */
    public function addTask($data): bool
    {
        $swooleServer = $this->getSwooleServer();

        if ($this->maxTaskNum > 0 && $this->taskAtomic->get() >= $this->maxTaskNum)
            throw new Exception('暂时不能添加任务哦!');

        $swooleServer->getServer()->task($data);

        $this->taskAtomic->add(1);

        return true;
    }

    /**
     * 收到任务
     * @param Server $server
     * @param int|string $taskId
     * @param int|string $reactorId
     * @param mixed $data
     * @return mixed|void
     */
    public function onTask(Server $server, $taskId, $reactorId, $data)
    {
        try {
            /** @var DispatchInterface $handlerTask */
            $handlerTask = $this->getHandlerTask($data);

            if (empty($handlerTask)) {
                $server->finish($data);
            } else {
                $handlerTask->onTask($server, $taskId, $reactorId, $data);
            }
        } catch (Exception $e) {
            $server->finish($data);
        }
    }

    /**
     * 结束任务
     * @param Server $server
     * @param int|string $taskId
     * @param mixed $data
     * @return mixed|void
     * @throws Exception
     */
    public function onFinish(Server $server, $taskId, $data)
    {
        $this->taskAtomic->sub(1);

        try {
            /** @var DispatchInterface $handlerTask */
            $handlerTask = $this->getHandlerTask($data);

            if ($handlerTask instanceof DispatchInterface) {
                $handlerTask->onFinish($server, $taskId, $data);
            }

            //如果有子task，则创建子task
            $son = B()->getData($data, TaskConfig::TASK_SON);
            if (empty($son)) return;

            foreach ($son as $value){
                $this->addTask($value);
            }
        } catch (Exception $e) {

        }
    }


}