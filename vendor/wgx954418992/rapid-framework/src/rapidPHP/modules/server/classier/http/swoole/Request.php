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
     * @var SwooleHttpRequest
     */
    protected $request;

    /**
     * Request constructor.
     * @param $isHttps
     * @param SwooleHttpRequest $req
     * @param SessionConfig|null $sessionConfig
     * @param string|null $sessionId
     */
    public function __construct($isHttps, SwooleHttpRequest $req, ?SessionConfig $sessionConfig, ?string $sessionId)
    {
        $this->request = $req;

        $server = self::getRenameServerInfo($this->request->server);

        $header = HttpConfig::getRenameHeader($this->request->header);

        $uri = Build::getInstance()->getData($server, 'REQUEST_URI');

        $query = Build::getInstance()->getData($server, 'QUERY_STRING');

        if ($uri && $query) $server['REQUEST_URI'] .= '?' . $query;

        $server['SCHEME'] = $isHttps ? 'https' : 'http';

        parent::__construct(
            $req->get,
            $req->post,
            $req->files,
            $req->cookie,
            $header,
            $server,
            $sessionConfig,
            $sessionId
        );
    }

    /**
     * @return SwooleHttpRequest
     */
    public function getSwooleRequest()
    {
        return $this->request;
    }

    /**
     * @return int
     */
    public function getFd(): int
    {
        return $this->request->fd;
    }

    /**
     * raw content
     * @return string
     */
    public function rawContent(): string
    {
        return $this->request->rawContent();
    }
}
