<?php


namespace rapidPHP\library\core\server;


use Swoole\Server;

abstract class TaskInterface
{
    /**
     * @var SwooleServer
     */
    private $swooleServer;

    /**
     * TaskInterface constructor.
     * @param SwooleServer $swooleServer
     */
    public function __construct(SwooleServer $swooleServer)
    {
        $this->swooleServer = $swooleServer;
    }

    /**
     * 初始化
     */
    public function init()
    {
    }

    /**
     * @return SwooleServer
     */
    public function getSwooleServer(): ?SwooleServer
    {
        return $this->swooleServer;
    }

    /**
     * 添加任务
     * @param $data
     * @return bool
     */
    abstract public function addTask($data): bool;

    /**
     * 收到任务
     * @param Server $server SwooleServer
     * @param string|int $taskId 任务id
     * @param string|int $reactorId
     * @param mixed $data 数据
     * @return mixed
     */
    abstract public function onTask(Server $server, $taskId, $reactorId, $data);

    /**
     * @param Server $server SwooleServer
     * @param string|int $taskId 任务id
     * @param mixed $data 数据
     * @return mixed
     */
    abstract public function onFinish(Server $server, $taskId, $data);
}