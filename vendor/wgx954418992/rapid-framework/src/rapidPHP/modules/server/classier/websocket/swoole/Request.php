<?php

namespace rapidPHP\modules\server\classier\websocket\swoole;

use rapidPHP\modules\common\classier\Build;
use rapidPHP\modules\common\classier\Uri;
use rapidPHP\modules\server\config\SessionConfig;
use rapidPHP\modules\server\classier\interfaces\Request as RequestInterface;
use Swoole\WebSocket\Frame;
use Swoole\WebSocket\Server as SwooleWebSocketServer;

class Request extends RequestInterface
{
    /**
     * @var
     */
    private $fd;

    /**
     * Request constructor.
     * @param SwooleWebSocketServer $server
     * @param Frame $frame
     * @param $header
     * @param $cookie
     * @param SessionConfig $sessionConfig
     * @param string $sessionId
     */
    public function __construct(SwooleWebSocketServer $server, Frame $frame, $header, $cookie, SessionConfig $sessionConfig, string $sessionId)
    {
        $this->fd = $frame->fd;

        switch ($frame->opcode) {
            case WEBSOCKET_OPCODE_TEXT:
                $frame->data = rawurldecode($frame->data);

                $data = Uri::getInstance()->toArray($frame->data);

                $clientInfo = $server->getClientInfo($frame->fd);

                $serverParam = $this->parseServer($clientInfo, $frame->data);
                break;
            default:
                $data = [];

                $serverParam = [];
                break;
        }

        parent::__construct(
            $data,
            $data,
            $cookie,
            [],
            $header,
            $serverParam,
            $frame->data,
            $sessionConfig,
            $sessionId
        );
    }

    /**
     * @return mixed
     */
    public function getFd()
    {
        return $this->fd;
    }


    /**
     * 解析server
     * @param $clientInfo
     * @param $data
     * @return array
     */
    public function parseServer($clientInfo, $data)
    {
        $urlInfo = parse_url($data);

        $url = Build::getInstance()->getData($urlInfo, 'path');

        if ($url) $url = '/' . ltrim($url, '/*');

        $server = [
            "REQUEST_METHOD" => "WebSocket",
            "REQUEST_URI" => $url,
            "PATH_INFO" => $url,
            "REQUEST_TIME" => time(),
            "REQUEST_TIME_FLOAT" => microtime(true),
            "SERVER_PROTOCOL" => "WebSocket",
        ];

        return parent::getRenameServerInfo(array_merge($clientInfo, $server));
    }

}