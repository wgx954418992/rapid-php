<?php

namespace rapidPHP\modules\server\classier\http\swoole;

use rapidPHP\modules\common\classier\Build;
use rapidPHP\modules\server\config\SessionConfig;
use rapidPHP\modules\server\config\HttpConfig;
use rapidPHP\modules\server\classier\interfaces\Request as RequestInterface;
use Swoole\Http\Request as SwooleHttpRequest;

class Request extends RequestInterface
{
    /**
     * @var int
     */
    protected $fd;

    /**
     * Request constructor.
     * @param $isHttps
     * @param SwooleHttpRequest $req
     * @param SessionConfig|null $sessionConfig
     * @param string|null $sessionId
     */
    public function __construct($isHttps, SwooleHttpRequest $req, ?SessionConfig $sessionConfig, ?string $sessionId)
    {
        $this->fd = $req->fd;

        $req->server = self::getRenameServerInfo($req->server);

        $req->header = HttpConfig::getRenameHeader($req->header);

        $uri = Build::getInstance()->getData($req->server, 'REQUEST_URI');

        $query = Build::getInstance()->getData($req->server, 'QUERY_STRING');

        if ($uri && $query) $req->server['REQUEST_URI'] .= '?' . $query;

        $req->server['SCHEME'] = $isHttps ? 'https' : 'http';

        parent::__construct(
            $req->get,
            $req->post,
            $req->files,
            $req->cookie,
            $req->header,
            $req->server,
            $sessionConfig,
            $sessionId
        );
    }

    /**
     * @return int
     */
    public function getFd()
    {
        return $this->fd;
    }
}
