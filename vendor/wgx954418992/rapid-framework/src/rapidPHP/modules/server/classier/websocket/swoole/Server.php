<?php

namespace rapidPHP\modules\server\classier\websocket\swoole;

use Exception;
use rapidPHP\modules\common\classier\Build;
use rapidPHP\modules\common\classier\Http;
use rapidPHP\modules\common\classier\StrCharacter;
use rapidPHP\modules\common\classier\Uri;
use rapidPHP\modules\server\config\SessionConfig;
use rapidPHP\modules\server\config\swoole\WebSocketConfig;
use rapidPHP\modules\server\config\HttpConfig;
use rapidPHP\modules\server\classier\interfaces\server\SwooleServer;
use rapidPHP\modules\server\config\HttpConfig as BaseHttpConfig;
use Swoole\Http\Request as SwooleRequest;
use Swoole\WebSocket\Server as SwooleWebSocketServer;

class Server extends SwooleServer
{

    /**
     * request 原始body
     * @var array
     */
    protected $requestBody = [];

    /**
     * Service constructor.
     * @param WebSocketConfig $config
     * @throws Exception
     */
    public function __construct(WebSocketConfig $config)
    {
        parent::__construct($config, SwooleWebSocketServer::class);

        parent::on('start', [$this, 'onStart']);

        parent::on("open", [$this, 'onOpen']);

        parent::on('close', [$this, 'onClose']);
    }

    /**
     * 获取客户端sessionId
     * @param SwooleRequest $req
     * @param SwooleWebSocketServer $server
     * @param $sessionKey
     * @return mixed|string|null
     */
    private function getClientSessionId(SwooleRequest $req, SwooleWebSocketServer $server, $sessionKey): ?string
    {
        $sessionId = Build::getInstance()->getData($req->cookie, $sessionKey);

        if (strlen($sessionId) != 32) $sessionId = null;

        if (is_null($sessionId)) {
            $sessionId = BaseHttpConfig::getSessionId();

            $setCookie = Response::getCookieString($sessionKey, $sessionId, 0, '/');

            if ($server->push($req->fd, $setCookie)) {
                return $sessionId;
            } else {
                return null;
            }
        }

        return $sessionId;
    }

    /**
     * request 转string
     * @param SwooleRequest $req
     * @return string
     */
    private function requestToString(SwooleRequest $req): string
    {
        $data = preg_replace(["#(cookie:(.*)\n)#i", '#(\r\n\r\n)#'], '', $req->getData());

        return $data . "\r\nCookie: " . Uri::getInstance()->toQuery($req->cookie, false, true, ';');
    }

    /**
     * 解析request原生body
     * @param $fd
     * @param SessionConfig $sessionConfig
     * @param $header
     * @param $cookie
     * @param $sessionId
     * @throws Exception
     */
    public function parseRequestBody($fd, &$header, &$cookie, SessionConfig $sessionConfig, &$sessionId)
    {
        $body = array_key_exists($fd, $this->requestBody) ? $this->requestBody[$fd] : null;

        if (empty($body)) throw new Exception('request error!', 1008);

        $header = $this->parseHeader($body);

        $cookie = $this->parseCookie($header);

        if (empty($sessionConfig)) throw new Exception('session error', 1008);

        $sessionId = Build::getInstance()->getData($cookie, $sessionConfig->getKey());

        if (empty($sessionId)) throw new Exception('SessionId Get Error!', 1008);
    }

    /**
     * 解析原始头部信息
     * @param $body
     * @return array
     */
    public function parseHeader($body): array
    {
        $rawHeaders = explode("\r\n", $body);

        return HttpConfig::getRenameHeader(Http::getInstance()->parseHeaders($rawHeaders));
    }

    /**
     * 解析原始头部信息
     * @param $header
     * @return array
     */
    public function parseCookie($header): array
    {
        $cookie = Build::getInstance()->getData($header, 'Cookie');

        return StrCharacter::getInstance()->parseStr($cookie, "\n\r");
    }

    /**
     * websocket开启
     * @param SwooleWebSocketServer $server
     */
    public function onStart($server)
    {
        $server = parent::getServer();

        $host = $server->host;

        if ($host === '0.0.0.0') $host = '127.0.0.1';

        if ($this->isHttps()) {
            $mode = 'wss';

            if ($server->port != 443) $host .= ':' . $server->port;
        } else {
            $mode = 'ws';

            if ($server->port != 80) $host .= ':' . $server->port;
        }

        echo "websocket server is started at {$mode}://{$host}\n";
    }


    /**
     * @param SwooleWebSocketServer $server
     * @param SwooleRequest $req
     */
    public function onOpen(SwooleWebSocketServer $server, SwooleRequest $req)
    {
        try {
            $sessionConfig = $this->getConfig()->getSession();

            if (empty($sessionConfig)) throw new Exception('session error!');

            $req->cookie[$sessionConfig->getKey()] = $sessionId = $this->getClientSessionId($req, $server, $sessionConfig->getKey());

            if (empty($sessionId)) throw new Exception('session error!');
        } catch (Exception $e) {
            $server->disconnect($req->fd, $e->getCode(), $e->getMessage());

            return;
        }

        $this->requestBody[$req->fd] = $this->requestToString($req);
    }


    /**
     * 关闭
     * @param SwooleWebSocketServer $server
     * @param $fd
     */
    public function onClose(SwooleWebSocketServer $server, $fd)
    {
        $this->requestBody[$fd] = null;

        unset($this->requestBody[$fd]);
    }
}
