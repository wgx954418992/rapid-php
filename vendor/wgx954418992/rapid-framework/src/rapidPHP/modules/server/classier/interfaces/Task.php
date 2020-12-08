<?php

namespace rapidPHP\modules\server\classier\interfaces;

abstract class Task
{
    /**
     * @var Server
     */
    private $server;

    /**
     * Task constructor.
     * @param Server $server
     */
    public function __construct(Server $server)
    {
        $this->server = $server;
    }

    /**
     * @return Server
     */
    public function getServer()
    {
        return $this->server;
    }

    /**
     * 添加任务
     * @param $data
     * @return bool
     */
    abstract public function addTask($data): bool;

    /**
     * 收到任务
     * @param string|int $taskId 任务id
     * @param string|int $reactorId
     * @param mixed $data 数据
     * @return mixed
     */
    abstract public function onTask($taskId, $reactorId, $data);

    /**
     * @param string|int $taskId 任务id
     * @param mixed $data 数据
     * @return mixed
     */
    abstract public function onFinish($taskId, $data);
}