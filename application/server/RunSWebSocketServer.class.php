<?php

namespace application\server;

use application\controller\WebSocketExceptionController;
use Exception;
use rapidPHP\library\core\Router;
use rapidPHP\library\core\server\request\SWebSocketRequest;
use rapidPHP\library\core\server\response\SWebSocketResponse;
use rapidPHP\library\core\server\SWebSocketServer;
use Swoole\Http\Request as SwooleRequest;
use Swoole\WebSocket\Frame;
use Swoole\WebSocket\Server;

class RunSWebSocketServer extends SWebSocketServer
{
    /**
     * @var RunSWebSocketServer
     */
    private static $instance;

    /**
     *  设置启动的Worker进程数。
     * 业务代码是全异步非阻塞的，这里设置为CPU核数的1-4倍最合理
     * 业务代码为同步阻塞，需要根据请求响应时间和系统负载来调整，例如：100-500
     * 默认设置为SWOOLE_CPU_NUM，最大不得超过SWOOLE_CPU_NUM * 1000
     * 比如1个请求耗时100ms，要提供1000QPS的处理能力，那必须配置100个进程或更多。但开的进程越多，占用的内存就会大大增加，而且进程间切换的开销就会越来越大。所以这里适当即可。不要配置过大。
     * 假设每个进程占用40M内存，100个进程就需要占用4G内存
     */
    const WORKER_NUM = 1;

    /**
     * 配置Task进程的数量，配置此参数后将会启用task功能。所以Server务必要注册onTask、onFinish2个事件回调函数。如果没有注册，服务器程序将无法启动。
     * Task进程是同步阻塞的，配置方式与Worker同步模式一致
     * 最大值不得超过SWOOLE_CPU_NUM * 1000
     * 单个task的处理耗时，如100ms，那一个进程1秒就可以处理1/0.1=10个task
     * task投递的速度，如每秒产生2000个task
     * 2000/10=200，需要设置task_worker_num => 200，启用200个task进程
     */
    const TASK_WORKER_NUM = 10;


    /**
     * request 原始body
     * @var array
     */
    private $requestBodys;

    /**
     * SwooleRunServer constructor.
     */
    public function __construct()
    {
        $this->requestBodys = [];

        $this->setPort(9502);

        $this->setOptions([
            'worker_num' => self::WORKER_NUM,

            'task_worker_num' => self::TASK_WORKER_NUM,
        ]);
    }

    /**
     * @return RunSWebSocketServer
     */
    public static function getInstance()
    {
        return self::$instance instanceof self ? self::$instance : self::$instance = new self();
    }

    /**
     * 开始
     * @param Server $server
     * @throws Exception
     */
    public function onStart($server)
    {
        parent::onStart($server);
    }

    /**
     * @param Server $server
     * @param SwooleRequest $req
     */
    public function onOpen(Server $server, SwooleRequest $req)
    {
        $this->requestBodys[$req->fd] = $req->getData();
    }

    /**
     * @param Server $server
     * @param Frame $frame
     * @throws Exception
     */
    public function onMessage($server, Frame $frame)
    {
        $body = isset($this->requestBodys[$frame->fd]) ? $this->requestBodys[$frame->fd] : null;

        $request = SWebSocketRequest::getInstance($frame, $body);

        echo("{$request->getMethod()} {$request->getUrl(true)} " . B()->getDate() . " \n");

        $response = SWebSocketResponse::getInstance($server, $frame->fd);

        Router::run(new WebSocketExceptionController($request, $response), $request, $response);

        $response->end();
    }

    /**
     * 关闭websocket
     * @param Server $server
     * @param $fd
     */
    public function onClose(Server $server, $fd)
    {
        var_dump((memory_get_usage()));

        unset($this->requestBodys[$fd]);
    }

    /**
     * 收到任务请求
     * @param Server $server
     * @param $taskId
     * @param $reactorId
     * @param $data
     */
    public function onTask($server, $taskId, $reactorId, $data)
    {
        $server->finish($data);
    }

    /**
     * 任务结束
     * @param Server $server
     * @param $taskId
     * @param $data
     */
    public function onFinish($server, $taskId, $data)
    {
        parent::onFinish($server, $taskId, $data);
    }
}