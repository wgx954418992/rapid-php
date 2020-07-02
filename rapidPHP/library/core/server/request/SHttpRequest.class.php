<?php

namespace rapidPHP\library\core\server\request;

use rapidPHP\library\core\server\Request;
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
     * @param SwooleRequest $request
     */
    public function __construct(SwooleRequest $request)
    {
        $this->setFd($request->fd);

        $request->server = self::getRenameServer($request->server);

        $request->header = self::getRenameHeader($request->header);

        $uri = B()->getData($request->server, 'REQUEST_URI');
        $query = B()->getData($request->server, 'QUERY_STRING');

        if ($uri && $query) {
            $request->server['REQUEST_URI'] .= '?' . $query;
        }

        parent::__construct($request->get, $request->post, $request->files, $request->cookie, $request->header, $request->server, $request->rawContent());

        $this->fd = $request->fd;
    }

    /**
     * 快速获取实例对象
     * @param SwooleRequest $request
     * @return Request
     */
    public static function getInstance(SwooleRequest $request)
    {
        return new self($request);
    }

}