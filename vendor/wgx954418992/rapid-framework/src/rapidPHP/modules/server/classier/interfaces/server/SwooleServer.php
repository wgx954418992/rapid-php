<?php

namespace rapidPHP\modules\server\classier\interfaces\server;


use Co;
use Exception;
use rapidPHP\modules\common\classier\Build;
use rapidPHP\modules\reflection\classier\Classify;
use rapidPHP\modules\server\classier\interfaces\Request;
use rapidPHP\modules\server\classier\interfaces\Server;
use rapidPHP\modules\server\classier\interfaces\task\SwooleTask;
use rapidPHP\modules\server\config\swoole\ServerConfig;
use Swoole\Http\Server as SwooleHttpServer;
use Swoole\Server as BaseSwooleServer;
use Swoole\WebSocket\Server as SwooleWebSocketServer;


abstract class SwooleServer extends Server
{

    /**
     * server
     * @var BaseSwooleServer|SwooleHttpServer|SwooleWebSocketServer
     */
    protected $server;

    /**
     * SwooleServer constructor.
     * @param ServerConfig $config
     * @param string $serverClass
     * @throws Exception
     */
    public function __construct(ServerConfig $config, string $serverClass)
    {
        $taskClass = $config->getTask();

        if (!empty($taskClass)) {
            /** @var SwooleTask $task */
            $task = Classify::getInstance($taskClass)->newInstance($this);
        }

        parent::__construct($config, $task ?? null);

        if (empty($serverClass)) throw new Exception('server class error!');

        if (!empty($config->getCo())) Co::set($config->getCo());

        $parameters = [$config->getIp(), $config->getPort()];

        if ($this->isHttps()) {
            $parameters[] = SWOOLE_PROCESS;
            $parameters[] = SWOOLE_TCP | SWOOLE_SSL;
        }

        $this->server = Classify::getInstance($serverClass)->newInstanceArgs($parameters);
    }

    /**
     * @return BaseSwooleServer|SwooleHttpServer|SwooleWebSocketServer
     */
    public function getServer()
    {
        return $this->server;
    }

    /**
     * 是否https
     * @return bool
     */
    public function isHttps(): bool
    {
        $sslFile = Build::getInstance()
            ->getData($this->getConfig()->getOptions(), 'ssl_key_file');

        return $sslFile && is_file($sslFile);
    }

    /**
     * 添加监听
     * @param string $event
     * @param callable $callback
     */
    public function on(string $event, callable $callback)
    {
        $this->server->on($event, $callback);
    }

    /**
     *  开启web服务，只能调用一次
     */
    public function start()
    {
        $this->server->set($this->getConfig()->getOptions());

        $this->on('start', [$this, 'onStart']);

        $this->on('task', [$this, 'onTask']);

        $this->on('finish', [$this, 'onFinish']);

        $this->server->start();
    }

    /**
     * server开启
     * @param mixed|BaseSwooleServer|Server $server
     */
    public function onStart($server)
    {

    }


    /**
     * 收到任务请求
     * @param mixed|BaseSwooleServer|Server $server
     * @param $taskId
     * @param $reactorId
     * @param $data
     */
    public function onTask($server, $taskId, $reactorId, $data)
    {
        if ($this->getTask() != null) {
            $this->getTask()->onTask($taskId, $reactorId, $data);
        }
    }

    /**
     * 任务结束
     * @param mixed|BaseSwooleServer|Server $server
     * @param $taskId
     * @param $data
     */
    public function onFinish($server, $taskId, $data)
    {
        if ($this->getTask() != null) {
            $this->getTask()->onFinish($taskId, $data);
        }
    }

    /**
     * 内网重启
     * @param Request $request
     */
    public function intranetReload(Request $request)
    {
        $ip = $request->getIp();

        if (is_null($ip) || !filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
            $this->server->reload();
        }
    }

}
