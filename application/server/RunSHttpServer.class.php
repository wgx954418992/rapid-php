<?php

namespace application\server;

use application\config\BaseConfig;
use application\context\WebContext;
use Co;
use rapidPHP\library\core\Router;
use rapidPHP\library\core\server\request\SHttpRequest;
use rapidPHP\library\core\server\response\SHttpResponse;
use rapidPHP\library\core\server\SHttpServer;
use Swoole\Http\Request as SwooleRequest;
use Swoole\Http\Response as SwooleResponse;

class RunSHttpServer extends SHttpServer
{
    /**
     * @var RunSHttpServer
     */
    private static $instance;

    /**
     * RunSHttpServer constructor.
     * @param string $ip
     * @param int $port
     * @param string $sessionKey
     * @param array $options
     */
    public function __construct(string $ip = self::DEFAULT_IP, int $port = 9501, string $sessionKey = self::DEFAULT_SESSIONKEY, array $options = [])
    {
        $options = array_merge($options, [
//            'ssl_key_file' => BaseConfig::WEBSITE_SSL_KEY_FILE,

//            'ssl_cert_file' => BaseConfig::WEBSITE_SSL_CERT_FILE,
        ]);

        parent::__construct($ip, $port, $sessionKey, $options);
    }

    /**
     * @return RunSHttpServer
     */
    public static function getInstance()
    {
        return self::$instance instanceof self ? self::$instance : self::$instance = new self();
    }


    /**
     * 收到请求
     * @param SwooleRequest $req
     * @param SwooleResponse $res
     */
    public function onRequest(SwooleRequest $req, SwooleResponse $res)
    {
        parent::onRequest($req, $res);

        $startTime = microtime(true);

        $request = SHttpRequest::getInstance($this, $req, SHttpServer::getSessionKey());

        $this->intranetReload($request, $this->getServer());

        $response = SHttpResponse::getInstance($request->getSessionId(), $res);

        Router::run(new WebContext($request, $response));

        $endTime = microtime(true);

        $requestTime = Cal()->formatSecond($endTime - $startTime);

        echo("{$request->getMethod()} {$request->getUrl(true)} 耗时:{$requestTime} \n");

        $response->end();
    }
}