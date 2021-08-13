<?php

namespace rapidPHP\modules\application\classier\apps;


use Exception;
use rapidPHP\modules\router\classier\router\WebRouter;
use rapidPHP\modules\server\classier\websocket\swoole\Request;
use rapidPHP\modules\server\classier\websocket\swoole\Response;
use rapidPHP\modules\server\classier\websocket\swoole\Server;
use Swoole\WebSocket\Frame;
use Swoole\WebSocket\Server as SwooleWebSocketServer;
use function rapidPHP\formatException;

class SwooleWebsocketApplication extends WebApplication
{

    /**
     * @var Server
     */
    protected $server;

    /**
     * @return Server
     */
    public function getServer(): ?Server
    {
        return $this->server;
    }

    /**
     * @throws Exception
     */
    public function run()
    {
        $this->server = new Server($this->getConfigWrapper()->getServer()->getSwoole()->getWebsocket());

        $this->server->on('message', [$this, 'onMessage']);

        $this->server->start();
    }

    /**
     * @param SwooleWebSocketServer $server
     * @param Frame $frame
     * @throws Exception
     */
    public function onMessage(SwooleWebSocketServer $server, Frame $frame)
    {
        $startTime = microtime(true);

        try {
            $sessionConfig = $this->server->getConfig()->getSession();

            if (empty($sessionConfig)) throw new Exception('session error', 1008);

            $this->server->parseRequestBody($frame->fd, $header, $cookie, $sessionConfig, $sessionId);

            if (empty($sessionId)) throw new Exception('session id error', 1008);

            $request = new Request($this->server->getServer(), $frame, $header, $cookie, $sessionConfig, $sessionId);

            $response = new Response($this->server->getServer(), $frame->fd, $sessionConfig, $sessionId);

            $context = parent::newWebContext($request, $response, $this->server->getConfig()->getContext());

            WebRouter::getInstance()->run($this, $context);

            $endTime = microtime(true);

            $requestTime = $endTime - $startTime;

            $this->logger(self::LOGGER_ACCESS)
                ->info("-{$request->getIp()} -{$request->getMethod()} -{$request->getUrl(true)} -{$requestTime}");
        } catch (Exception $e) {

            $this->logger(self::LOGGER_ACCESS)->error(formatException($e));
        }
    }
}
