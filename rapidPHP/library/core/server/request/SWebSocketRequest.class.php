<?php

namespace rapidPHP\library\core\server\request;

use rapidPHP\library\core\server\Request;
use rapidPHP\library\core\server\SwooleServer;
use rapidPHP\library\StrCharacter;
use Swoole\WebSocket\Frame;

class SWebSocketRequest extends Request
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
     * SWebSocketRequest constructor.
     * @param SwooleServer $swooleServer
     * @param $clientInfo
     * @param Frame $frame
     * @param string|null $body
     * @param string $sessionKey
     */
    public function __construct(SwooleServer $swooleServer, $clientInfo, Frame $frame, ?string $body, string $sessionKey)
    {
        $this->setFd($frame->fd);

        $data = [];
        $serverParam = [];
        $header = $this->parseHeader($body);
        $cookie = $this->parseCookie($header);
        $sessionId = B()->getData($cookie, $sessionKey);

        switch ($frame->opcode) {
            case WEBSOCKET_OPCODE_TEXT:
                $frame->data = rawurldecode($frame->data);

                $data = B()->getUrlQueryStringToArray($frame->data);

                $serverParam = $this->parseServer($clientInfo, $frame->data);
                break;
            case WEBSOCKET_OPCODE_BINARY:
                break;
        }

        parent::__construct($swooleServer, $data, $data, $cookie, [], $sessionId, $header, $serverParam, $frame->data);
    }

    /**
     * 解析原始头部信息
     * @param $body
     * @return array
     */
    private function parseHeader($body)
    {
        $rawHeaders = explode("\r\n", $body);

        return self::getRenameHeader(B()->parseHeaders($rawHeaders));
    }

    /**
     * 解析server
     * @param $clientInfo
     * @param $data
     * @return array
     */
    private function parseServer($clientInfo, $data)
    {
        $urlInfo = parse_url($data);

        $url = B()->getData($urlInfo, 'path');
        if ($url) $url = '/' . ltrim($url, '/*');

        $server = [
            "REQUEST_METHOD" => "WebSocket",
            "REQUEST_URI" => $url,
            "PATH_INFO" => $url,
            "REQUEST_TIME" => time(),
            "REQUEST_TIME_FLOAT" => microtime(true),
            "SERVER_PROTOCOL" => "HTTP/1.1",
        ];

        return self::getRenameServerInfo(array_merge($clientInfo, $server));
    }

    /**
     * 解析原始头部信息
     * @param $header
     * @return array
     */
    private function parseCookie($header)
    {
        $cookie = B()->getData($header, 'Cookie');

        return Str()->parseStr($cookie, "\n\r");
    }

    /**
     * 快速获取实例对象
     * @param SwooleServer $swooleServer
     * @param $clientInfo
     * @param Frame $frame
     * @param string|null $body
     * @param string $sessionKey
     * @return Request
     */
    public static function getInstance(SwooleServer $swooleServer, $clientInfo, Frame $frame, ?string $body, string $sessionKey)
    {
        return new self($swooleServer, $clientInfo, $frame, $body, $sessionKey);
    }
}