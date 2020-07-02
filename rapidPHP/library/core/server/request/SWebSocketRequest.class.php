<?php

namespace rapidPHP\library\core\server\request;

use rapidPHP\library\core\server\Request;
use Swoole\Http\Request as SwooleRequest;
use Swoole\WebSocket\Frame;
use Swoole\WebSocket\Server;

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
     * @param Frame $frame
     * @param string|null $body
     */
    public function __construct(Frame $frame, ?string $body)
    {
        $this->setFd($frame->fd);

        $data = [];
        $serverParam = [];
        $header = $this->parseHeader($body);
        $cookie = $this->parseCookie($header);

        switch ($frame->opcode) {
            case WEBSOCKET_OPCODE_TEXT:
                $rawData = $this->parseData($frame->data);

                $data = B()->getData($rawData, 'data');

                $serverParam = $this->parseServer($rawData);
                break;
            case WEBSOCKET_OPCODE_BINARY:
                break;
        }

        parent::__construct($data, $data, $cookie, [], $header, $serverParam, $frame->data);
    }

    /**
     * 解析data
     * @param $rawData
     * @param string $delimiter
     * @return array
     */
    private function parseData($rawData, $delimiter = '&')
    {
        $queryArray = explode($delimiter, $rawData);

        $list = [];

        foreach ($queryArray as $name => $value) {
            $data = explode('=', $value);

            $dataName = B()->getData($data, 0);

            $dataValue = B()->getData($data, 1);

            $list[$dataName] = $dataValue;
        }

        return $list;
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
     * @param $data
     * @return array
     */
    private function parseServer($data)
    {
        $url = B()->getData($data, 'url');

        $server = [
            "request_method" => "WebSocket",
            "request_uri" => $url,
            "path_info" => $url,
            "request_time" => time(),
            "request_time_float" => microtime(true),
            "server_protocol" => "HTTP/1.1",
        ];

        return self::getRenameServer($server);
    }

    /**
     * 解析原始头部信息
     * @param $header
     * @return array
     */
    private function parseCookie($header)
    {
        $cookie = B()->getData($header, 'Cookie');

        return $this->parseData($cookie,"\n\r");
    }


    /**
     * 快速获取实例对象
     * @param Frame $frame
     * @param string|null $body
     * @return Request
     */
    public static function getInstance(Frame $frame, ?string $body)
    {
        return new self($frame, $body);
    }
}