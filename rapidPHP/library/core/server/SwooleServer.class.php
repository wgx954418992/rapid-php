<?php


namespace rapidPHP\library\core\server;


use application\config\TaskConfig;
use Co;
use ReflectionException;
use Swoole\Server;

abstract class SwooleServer
{
    /**
     * key task_worker_num
     */
    const KEY_TASK_WORKER_NUM = 'task_worker_num';

    /**
     * key ssl_key_file
     */
    const KEY_SSL_KEY_FILE = 'ssl_key_file';

    /**
     * key ssl_cert_file
     */
    const KEY_SSL_CERT_FILE = 'ssl_cert_file';

    /**
     * 默认ip
     */
    const DEFAULT_IP = '0.0.0.0';

    /**
     * 默认session key
     */
    const DEFAULT_SESSIONKEY = 'PHPSESSID';

    /**
     * ip地址
     * @var string
     */
    private $ip;

    /**
     * 端口
     * @var int
     */
    private $port;

    /**
     * @var string
     */
    private $sessionKey;

    /**
     * 可选设置
     * @var array
     */
    private $options = [
        //开启静态文件处理
        'enable_static_handler' => true,
        //静态文件目录
        'document_root' => ROOT_PATH,

        'enable_coroutine' => true,

        'package_max_length' => 50 * 1024 * 1024,

        /**
         * 设置启动的Worker进程数。
         * 业务代码是全异步非阻塞的，这里设置为CPU核数的1-4倍最合理
         * 业务代码为同步阻塞，需要根据请求响应时间和系统负载来调整，例如：100-500
         * 默认设置为SWOOLE_CPU_NUM，最大不得超过SWOOLE_CPU_NUM * 1000
         * 比如1个请求耗时100ms，要提供1000QPS的处理能力，那必须配置100个进程或更多。但开的进程越多，占用的内存就会大大增加，而且进程间切换的开销就会越来越大。所以这里适当即可。不要配置过大。
         * 假设每个进程占用40M内存，100个进程就需要占用4G内存
         * @var int
         */
        'worker_num' => 1,

        /**
         * 配置Task进程的数量，配置此参数后将会启用task功能。所以Server务必要注册onTask、onFinish2个事件回调函数。如果没有注册，服务器程序将无法启动。
         * Task进程是同步阻塞的，配置方式与Worker同步模式一致
         * 最大值不得超过SWOOLE_CPU_NUM * 1000
         * 单个task的处理耗时，如100ms，那一个进程1秒就可以处理1/0.1=10个task
         * task投递的速度，如每秒产生2000个task
         * 2000/10=200，需要设置task_worker_num => 200，启用200个task进程
         * @var int
         */
        'task_worker_num' => 10,
    ];

    /**
     * Server Name
     * @var string
     */
    private $serverClass;

    /**
     * server
     * @var Server
     */
    private $server;

    /**
     * 任务接口
     * @var TaskInterface
     */
    private $taskInterface;

    /**
     * 是否已经初始化taskInterface
     * @var bool
     */
    protected $isInitTaskInterface = false;

    /**
     * 初始化构建基本参数
     * SwooleServer constructor.
     *
     * 要创建的server 对的class传入
     * @param $serverClass
     *
     * ip 如果要外网访问，请传入 0.0.0.0
     * @param string $ip
     *
     * 端口
     * @param int $port
     *
     * 定义http 或者websocket cookie里面的session key，
     * 如果第一次访问cookie里面没有 HTTP_SESSIONID 值，
     * 则服务器自动生成全球唯一的id，设置到客户端头部的cookie里面
     * <如果需要同步cgi 跟 swoolHttpServer swoolWebSocket session则把 sessionKey 都设置成 PHPSESSID >
     * @param string $sessionKey
     *
     * 可选属性
     * @param array $options
     */
    public function __construct($serverClass,
                                string $ip = self::DEFAULT_IP,
                                int $port = 9501,
                                string $sessionKey = self::DEFAULT_SESSIONKEY,
                                array $options = [])
    {
        $this->serverClass = $serverClass;
        $this->ip = $ip;
        $this->port = $port;
        $this->sessionKey = $sessionKey;
        $this->options = array_merge($this->options, $options);

        if (!defined('SWOOLE_HOOK_ALL')) define('SWOOLE_HOOK_ALL', 1879048191);
        if (!defined('SWOOLE_HOOK_CURL')) define('SWOOLE_HOOK_CURL', 268435456);
    }

    /**
     * 快速获取实例对象
     * @return SHttpServer
     */
    abstract public static function getInstance();

    /**
     * @return string
     */
    public function getIp(): string
    {
        return $this->ip;
    }

    /**
     * @param $ip
     * @return $this
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
        return $this;
    }

    /**
     * @return int
     */
    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * @param $port
     * @return $this
     */
    public function setPort($port)
    {
        $this->port = $port;
        return $this;
    }

    /**
     * @return string
     */
    public function getSessionKey(): string
    {
        return $this->sessionKey;
    }

    /**
     * @param $sessionKey
     * @return $this
     */
    public function setSessionKey($sessionKey)
    {
        $this->sessionKey = $sessionKey;
        return $this;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @return string
     */
    public function getServerClass(): string
    {
        return $this->serverClass;
    }

    /**
     * @return Server|\Swoole\Http\Server|\Swoole\WebSocket\Server
     */
    public function getServer()
    {
        return $this->server;
    }

    /**
     * @return TaskInterface|null
     */
    public function getTaskInterface(): ?TaskInterface
    {
        return $this->taskInterface;
    }


    /**
     * @param string $class
     * @return $this
     * @throws ReflectionException
     */
    public function setTaskInterface($class)
    {
        if (is_string($class)) {
            $this->taskInterface = B()->reflectionInstance($class, [$this]);
        } else if ($class instanceof TaskInterface) {
            $this->taskInterface = $class;
        }

        return $this;
    }

    /**
     * 是否https
     * @return bool
     */
    public function isHttps()
    {
        $sslFile = B()->getData($this->getOptions(), self::KEY_SSL_KEY_FILE);

        return $sslFile && is_file($sslFile);
    }

    /**
     * 创建Server
     * @param array $options
     * @return $this
     * @throws ReflectionException
     */
    public function create(array $options = ['hook_flags' => SWOOLE_HOOK_ALL | SWOOLE_HOOK_CURL])
    {
        Co::set($options);

        $param = [$this->getIp(), $this->getPort()];

        if ($this->isHttps()) {
            $param[] = SWOOLE_PROCESS;
            $param[] = SWOOLE_TCP | SWOOLE_SSL;
        }

        $this->server = B()->reflectionInstance($this->getServerClass(), $param);

        return $this;
    }

    /**
     * 添加监听
     * @param string $event
     * @param callable $callback
     */
    protected final function on(string $event, callable $callback)
    {
        $this->getServer()->on($event, $callback);
    }

    /**
     *  开启web服务，只能调用一次
     * @return $this
     */
    public function start()
    {
        $this->getServer()->set($this->getOptions());

        $this->on("start", [$this, 'onStart']);

        $this->on('task', [$this, 'onTask']);

        $this->on('finish', [$this, 'onFinish']);

        $this->getServer()->start();

        return $this;
    }

    /**
     * 内网重启
     * @param Request $request
     * @param Server $server
     */
    public function intranetReload(Request $request, Server $server)
    {
        $ip = $request->getIp();

        if (is_null($ip) || !filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
            $server->reload();
        }
    }

    /**
     * server开启
     * @param $server
     */
    public function onStart($server)
    {
        // TODO: Change the autogenerated stub
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
        if ($this->taskInterface != null) {
            $this->taskInterface->onTask($server, $taskId, $reactorId, $data);
        }

        // TODO: Change the autogenerated stub
    }

    /**
     * 任务结束
     * @param Server $server
     * @param $taskId
     * @param $data
     */
    public function onFinish($server, $taskId, $data)
    {
        if ($this->taskInterface != null) {
            $this->taskInterface->onFinish($server, $taskId, $data);
        }

        // TODO: Change the autogenerated stub
    }
}