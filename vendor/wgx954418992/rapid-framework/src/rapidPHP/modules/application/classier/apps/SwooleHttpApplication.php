<?php

namespace rapidPHP\modules\application\classier\apps;


use Exception;
use rapidPHP\modules\router\classier\router\WebRouter;
use rapidPHP\modules\server\classier\http\swoole\Request;
use rapidPHP\modules\server\classier\http\swoole\Response;
use rapidPHP\modules\server\classier\http\swoole\Server;
use Swoole\Http\Request as SwooleRequest;
use Swoole\Http\Response as SwooleResponse;
use function rapidPHP\formatException;

class SwooleHttpApplication extends WebApplication
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
        $this->server = new Server($this->getConfig()->getServer()->getSwoole()->getHttp());

        $this->server->on('request', [$this, 'onRequest']);

        $this->server->start();
    }

    /**
     * 收到请求
     * @param SwooleRequest $req
     * @param SwooleResponse $resp
     * @throws Exception
     */
    public function onRequest(SwooleRequest $req, SwooleResponse $resp)
    {
        try{
            $startTime = microtime(true);

            $sessionConfig = $this->server->getConfig()->getSession();

            $this->server->setSessionId($req, $resp, $sessionConfig, $sessionId);

            $request = new Request($this->server->isHttps(), $req, $sessionConfig, $sessionId);

            $response = new Response($resp, $sessionConfig, $sessionId);

            $this->server->intranetReload($request);

            $context = parent::newWebContext($request, $response, $this->server->getConfig()->getContext());

            WebRouter::getInstance()->run($this, $context);

            $resp->end();

            $endTime = microtime(true);

            $requestTime = $endTime - $startTime;

            $this->logger(self::LOGGER_ACCESS)
                ->info("-{$request->getIp()} -{$request->getMethod()} -{$request->getUrl(true)} -{$requestTime}");
        }catch (Exception $e){
            $this->logger(self::LOGGER_ACCESS)->error(formatException($e));
        }
    }
}