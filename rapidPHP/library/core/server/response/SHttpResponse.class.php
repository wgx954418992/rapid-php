<?php

namespace rapidPHP\library\core\server\response;

use rapidPHP\library\core\server\Request;
use rapidPHP\library\core\server\Response;
use Swoole\Http\Response as SwooleResponse;

class SHttpResponse extends Response
{
    /**
     * 是否结束
     * @var bool
     */
    private $isEnd = false;

    /**
     * @var SwooleResponse
     */
    private $swooleResponse;

    /**
     * @return bool
     */
    public function isEnd(): bool
    {
        return $this->isEnd;
    }

    /**
     * @return SwooleResponse
     */
    public function getSwooleResponse(): SwooleResponse
    {
        return $this->swooleResponse;
    }

    /**
     * SHttpResponse constructor.
     * @param string|null $sessionId
     * @param SwooleResponse $response
     */
    public function __construct(?string $sessionId, SwooleResponse $response)
    {
        parent::__construct($sessionId);

        $this->swooleResponse = $response;
    }

    /**
     * 快速获取实例对象
     * @param string|null $sessionId
     * @param SwooleResponse $response
     * @return SHttpResponse
     */
    public static function getInstance(?string $sessionId, SwooleResponse $response)
    {
        return new self($sessionId, $response);
    }

    /**
     * 设置HttpCode，如404, 501, 200
     * @param $code
     * @return bool
     */
    public function status($code): bool
    {
        if ($this->isEnd) return false;

        return $this->swooleResponse->status($code);
    }

    /**
     * 设置Http头信息
     * @param $data
     * @param bool $ucfirst
     * @return bool
     */
    public function header($data, $ucfirst = true): bool
    {
        if ($this->isEnd) return false;

        $data = explode(":", $data);

        $key = B()->getData($data, 0);

        $value = trim(B()->getData($data, 1));

        return $this->swooleResponse->header($key, $value, false);
    }

    /**
     * 重定向
     * @param $url
     * @param int $httpCode
     * @return bool
     */
    public function redirect($url, $httpCode = 302): bool
    {
        $this->swooleResponse->redirect($url, $httpCode);

        $this->isEnd = true;

        return true;
    }

    /**
     * 设置Cookie
     *
     * @param string $key
     * @param string $value
     * @param int $expire
     * @param string $path
     * @param string $domain
     * @param bool $secure
     * @param bool $httponly
     * @param string $samesite 从 v4.4.6 版本开始支持
     * @return bool
     */
    public function cookie($key, $value, $expire = 0, $path = '/', $domain = '', $secure = false, $httponly = false, $samesite = ''): bool
    {
        if ($this->isEnd) return false;

        return $this->swooleResponse->cookie($key, $value, $expire, $path, $domain, $secure, $httponly, $samesite);
    }


    /**
     * 启用Http-Chunk分段向浏览器发送数据
     *
     * @param string $data
     * @param array $options
     * @return bool
     */
    public function write($data, $options = []): bool
    {
        if ($this->isEnd) return false;

        if (empty($data)) return false;

        return $this->swooleResponse->write($data);
    }

    /**
     * 发送文件或者下载文件
     * @param string $filename
     * @param array $options
     * @return bool
     */
    public function sendFile($filename, $options = []): bool
    {
        if ($this->isEnd) return false;

        $this->isEnd = $this->printFile($filename, array_merge(['download' => true], $options));

        return $this->isEnd;
    }

    /**
     * 结束Http响应，发送HTML内容
     * @param string $data
     * @param array $options
     * @return bool
     */
    public function end($data = '', $options = []): bool
    {
        if ($this->isEnd) return false;

        $this->isEnd = $this->swooleResponse->end($data);

        return $this->isEnd;
    }
}