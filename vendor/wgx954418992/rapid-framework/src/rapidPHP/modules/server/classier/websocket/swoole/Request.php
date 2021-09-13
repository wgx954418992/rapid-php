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
     * @var Frame
     */
    protected $frame;

    /**
     * @var string|null
     */
    protected $data;

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
        $this->frame = $frame;

        switch ($frame->opcode) {
            case WEBSOCKET_OPCODE_TEXT:
                $this->data = rawurldecode($this->frame->data);

                $data = Uri::getInstance()->toArray($this->data);

                $clientInfo = $server->getClientInfo($this->frame->fd);

                $serverParam = $this->parseServer($clientInfo, $this->data);
                break;
            default:
                $data = [];

                $serverParam = [];
                break;
        }

        parent::__construct(
            $data,
            $data,
            null,
            $cookie,
            $header,
            $serverParam,
            $sessionConfig,
            $sessionId
        );
    }

    /**
     * frame
     * @return Frame
     */
    public function getFrame()
    {
        return $this->frame;
    }

    /**
     * @return int
     */
    public function getFd(): int
    {
        return $this->frame->fd;
    }

    /**
     * frame
     * @return string
     */
    public function rawContent(): string
    {
        return $this->frame->data;
    }

    /**
     * 解析server
     * @param $clientInfo
     * @param $data
     * @return array
     */
    public function parseServer($clientInfo, $data): array
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
