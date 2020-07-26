<?php

namespace rapidPHP\library\core\server\request;

use rapidPHP\library\core\server\Request;
use rapidPHP\library\core\server\SwooleServer;
use ReflectionException;
use Swoole\Http\Request as SwooleRequest;

class SHttpRequest extends Request
{
    /**
     * @var
     */
    private $fd;

    /**
     * @return mixed
     */
    public function getFd()
    {
        return $this->fd;
    }

    /**
     * @param mixed $fd
     */
    public function setFd($fd): void
    {
        $this->fd = $fd;
    }

    /**
     * SHttpRequest constructor.
     * @param SwooleServer $swooleServer
     * @param SwooleRequest $request
     * @param string $sessionKey
     */
    public function __construct(SwooleServer $swooleServer, SwooleRequest $request, string $sessionKey)
    {
        $this->setFd($request->fd);

        $sessionId = B()->getData($request->cookie, $sessionKey);

        $request->server = self::getRenameServerInfo($request->server);
        $request->header = self::getRenameHeader($request->header);

        $uri = B()->getData($request->server, 'REQUEST_URI');
        $query = B()->getData($request->server, 'QUERY_STRING');

        if ($uri && $query) {
            $request->server['REQUEST_URI'] .= '?' . $query;
        }

        parent::__construct($swooleServer, $request->get, $request->post,
            $request->files, $request->cookie, $sessionId,
            $request->header, $request->server, $request->rawContent());

        $this->fd = $request->fd;
    }

    /**
     * 快速获取实例对象
     * @param SwooleServer $server
     * @param SwooleRequest $request
     * @param string $sessionKey
     * @return Request
     */
    public static function getInstance(SwooleServer $server, SwooleRequest $request, string $sessionKey)
    {
        return new self($server, $request, $sessionKey);
    }

}