<?php

namespace rapidPHP\library\core\server\response;

use rapidPHP\library\core\server\Response;
use Swoole\WebSocket\Server;

class SWebSocketResponse extends Response
{
    /**
     * @var Server
     */
    private $server;

    /**
     * @var int
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
     * Response constructor.
     * @param Server $server
     * @param $fd
     */
    public function __construct(Server $server, $fd)
    {
        $this->server = $server;
        $this->fd = $fd;
    }

    /**
     * 快速获取实例对象
     * @param Server $response
     * @param $fd
     * @return Response
     */
    public static function getInstance(Server $response, $fd)
    {
        return new self($response, $fd);
    }

    /**
     * 此方法模拟http发送header status
     * @param $code
     */
    public function status($code)
    {
        $this->server->push($this->fd, "Header-Status: $code");
    }

    /**
     * 此方法模拟http发送header
     * @param $data
     * @param bool $ucfirst
     */
    public function header($data, $ucfirst = true)
    {
        $data = explode(":", $data);

        $key = B()->getData($data, 0);

        $value = trim(B()->getData($data, 1));

        $this->server->push($this->fd, "Header-{$key}: {$value}");
    }

    /**
     * 此方法模拟http发送cookie
     *
     * @param string $key
     * @param string $value
     * @param int $expire
     * @param string $path
     * @param string $domain
     * @param bool $secure
     * @param bool $httponly
     * @param string $samesite 从 v4.4.6 版本开始支持
     */
    public function cookie($key, $value, $expire = 0, $path = '/', $domain = '', $secure = false, $httponly = false, $samesite = '')
    {
        $cookie = ["{$key}={$value}"];

        if ($expire != 0) $cookie[] = "expires=" . date($expire);
        if (!empty($path)) $cookie[] = "path={$path}";
        if (!empty($domain)) $cookie[] = "domain={$domain}";
        if (!empty($secure)) $cookie[] = "secure";
        if (!empty($httponly)) $cookie[] = "httponly";
        if (!empty($samesite)) $cookie[] = "samesite={$samesite}";

        $this->server->push($this->fd, "Header-Set-Cookie: " . join(";", $cookie));
    }

    /**
     * 给客户端发送数据
     *
     * @param string $data
     */
    public function write($data)
    {
        if (empty($data)) return;

        $this->server->push($this->fd, $data);
    }

    /**
     * 发送文件
     * @param string $filename
     * @param array $options
     */
    public function sendFile($filename, $options = [])
    {
        $start = (int)B()->getData($options, 'start');

        $end = (int)B()->getData($options, 'end');

        $this->server->sendFile($this->fd, $filename, $start, max(0, $end - $start));
    }

    /**
     * 次方法只是发送数据，并不是真正的技术，请自行调用disconnect
     * @param string $data
     */
    public function end($data = '')
    {
        if (empty($data)) return;

        $this->server->push($this->fd, $data);
    }
}