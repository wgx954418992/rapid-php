<?php

namespace rapidPHP\modules\server\classier\http\swoole;

use Exception;
use rapidPHP\modules\common\classier\Build;
use rapidPHP\modules\server\config\SessionConfig;
use rapidPHP\modules\server\config\swoole\HttpConfig;
use rapidPHP\modules\server\classier\interfaces\server\SwooleServer;
use rapidPHP\modules\server\config\HttpConfig as BaseHttpConfig;
use Swoole\Http\Request as SwooleRequest;
use Swoole\Http\Response as SwooleResponse;
use Swoole\Http\Server as SwooleHttpServer;

class Server extends SwooleServer
{


    /**
     * Server constructor.
     * @param HttpConfig $config
     * @throws Exception
     */
    public function __construct(HttpConfig $config)
    {
        parent::__construct($config, SwooleHttpServer::class);

        parent::on('start', [$this, 'onStart']);

        parent::on('request', [$this, 'onRequest']);
    }

    /**
     * httpServer开启
     * @param \Swoole\Server $server
     */
    public function onStart($server)
    {
        $host = $server->host;

        if ($host === '0.0.0.0') $host = '127.0.0.1';

        if ($this->isHttps()) {
            $mode = 'https';

            if ($server->port != 443) $host .= ':' . $server->port;
        } else {
            $mode = 'http';

            if ($server->port != 80) $host .= ':' . $server->port;
        }

        echo "http server is started at {$mode}://{$host}\n";
    }

    /**
     * 设置客户端的sessionId
     * @param SwooleRequest $req
     * @param SwooleResponse $resp
     * @param SessionConfig|null $sessionConfig
     * @param $sessionId
     */
    public function setSessionId(SwooleRequest $req, SwooleResponse $resp, ?SessionConfig $sessionConfig, &$sessionId = null)
    {
        if ($sessionConfig == null) return;

        $sessionKey = $sessionConfig->getKey();

        if (empty($sessionKey)) return;

        $req->cookie[$sessionKey] = $sessionId = $this->getClientSessionId($req, $resp, $sessionKey);
    }

    /**
     * 获取客户端sessionId
     * @param SwooleRequest $req
     * @param SwooleResponse $res
     * @param $sessionKey
     * @return mixed|string|null
     */
    private function getClientSessionId(SwooleRequest $req, SwooleResponse $res, $sessionKey): ?string
    {
        $sessionId = Build::getInstance()->getData($req->cookie, $sessionKey);

        if (strlen($sessionId) != 32) $sessionId = null;

        if (is_null($sessionId)) {
            $sessionId = BaseHttpConfig::getSessionId();

            if ($res->cookie($sessionKey, $sessionId)) {
                return $sessionId;
            } else {
                return null;
            }
        }

        return $sessionId;
    }

    /**
     * 收到请求
     * @param SwooleRequest $req
     * @param SwooleResponse $resp
     */
    public function onRequest(SwooleRequest $req, SwooleResponse $resp)
    {
        $sessionConfig = $this->getConfig()->getSession();

        $this->setSessionId($req, $resp, $sessionConfig, $sessionId);
    }


}