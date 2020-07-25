<?php

namespace application\server;

use application\config\BaseConfig;
use application\context\WebSocketContext;
use Co;
use Exception;
use rapidPHP\library\core\Mapping;
use rapidPHP\library\core\Router;
use rapidPHP\library\core\server\Request;
use rapidPHP\library\core\server\request\SWebSocketRequest;
use rapidPHP\library\core\server\response\SWebSocketResponse;
use rapidPHP\library\core\server\SWebSocketServer;
use Swoole\Http\Request as SwooleRequest;
use Swoole\WebSocket\Frame;
use Swoole\WebSocket\Server;

class RunSWebSocketServer extends SWebSocketServer
{
    /**
     * request 原始body
     * @var array
     */
    private $requestBodys = [];

    /**
     * @var RunSWebSocketServer
     */
    private static $instance;

    /**
     * RunSWebSocketServer constructor.
     * @param string $ip
     * @param int $port
     * @param string $sessionKey
     * @param array $options
     */
    public function __construct(string $ip = self::DEFAULT_IP, int $port = 9502, string $sessionKey = self::DEFAULT_SESSIONKEY, array $options = [])
    {
        $options = array_merge($options, [
//            'ssl_key_file' => BaseConfig::WEBSITE_SSL_KEY_FILE,

//            'ssl_cert_file' => BaseConfig::WEBSITE_SSL_CERT_FILE,
        ]);

        parent::__construct($ip, $port, $sessionKey, $options);
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
     * 解析请求原生data
     * @param $sessionId
     * @param SwooleRequest $req
     * @return string
     */
    private function parseReqData($sessionId, SwooleRequest $req)
    {
        $req->cookie[parent::getSessionKey()] = $sessionId;

        $data = preg_replace(["#(cookie:(.*)\n)#i", '#(\r\n\r\n)#'], '', $req->getData());

        return $data . "\r\nCookie: " . B()->toUrlString($req->cookie, false, true, ';');
    }

    /**
     * @param Server $server
     * @param SwooleRequest $req
     */
    public function onOpen(Server $server, SwooleRequest $req)
    {
        parent::onOpen($server, $req);

        $sessionId = $req->cookie[parent::getSessionKey()];
        if (empty($sessionId)) {
            $server->disconnect($req->fd, 1008, 'SessionId Get Error!');
            return;
        }

        $this->requestBodys[$req->fd] = $this->parseReqData($sessionId, $req);
    }

    /**
     * @param Server $server
     * @param Frame $frame
     * @throws Exception
     */
    public function onMessage(Server $server, Frame $frame)
    {
        $body = isset($this->requestBodys[$frame->fd]) ? $this->requestBodys[$frame->fd] : null;

        $request = SWebSocketRequest::getInstance($this, $server->getClientInfo($frame->fd), $frame, $body, parent::getSessionKey());

        $this->intranetReload($request, $this->getServer());

        echo("{$request->getMethod()} {$request->getUrl(true)} " . Cal()->getDate() . " \n");

        $response = SWebSocketResponse::getInstance($request->getSessionId(), $server, $frame->fd);

        Router::run(new WebSocketContext($request, $response));
    }

    /**
     * 关闭websocket
     * @param Server $server
     * @param $fd
     */
    public function onClose(Server $server, $fd)
    {
        unset($this->requestBodys[$fd]);
    }
}