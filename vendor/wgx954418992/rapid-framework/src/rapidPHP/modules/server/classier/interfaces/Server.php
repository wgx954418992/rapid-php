<?php

namespace rapidPHP\modules\server\classier\interfaces;

use rapidPHP\modules\server\config\CGIConfig;
use rapidPHP\modules\server\config\ServerConfig;
use rapidPHP\modules\server\config\swoole\HttpConfig as SwooleHttpConfig;
use rapidPHP\modules\server\config\swoole\WebSocketConfig as SwooleWebSocketConfig;

abstract class Server
{
    /**
     * config
     * @var ServerConfig
     */
    protected $config;

    /**
     * 任务接口
     * @var Task|null
     */
    protected $task;

    /**
     * Server constructor.
     * @param ServerConfig $config
     * @param Task|null $task
     */
    public function __construct(ServerConfig $config, ?Task $task = null)
    {
        $this->config = $config;

        $this->task = $task;
    }

    /**
     * @return ServerConfig
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @return Task|null
     */
    public function getTask(): ?Task
    {
        return $this->task;
    }

    /**
     * 添加监听
     * @param string $event
     * @param callable $callback
     */
    abstract public function on(string $event, callable $callback);
}
