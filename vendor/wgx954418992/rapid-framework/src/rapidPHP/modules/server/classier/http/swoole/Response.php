<?php

namespace rapidPHP\modules\server\classier\http\swoole;

use rapidPHP\modules\common\classier\Build;
use rapidPHP\modules\server\config\SessionConfig;
use rapidPHP\modules\server\classier\interfaces\Response as ResponseInterface;
use Swoole\Http\Response as SwooleResponse;

class Response extends ResponseInterface
{
    /**
     * 是否结束
     * @var bool
     */
    protected $isEnd = false;

    /**
     * @var SwooleResponse
     */
    protected $swooleResponse;

    /**
     * Response constructor.
     * @param SwooleResponse $swooleResponse
     * @param SessionConfig|null $sessionConfig
     * @param string|null $sessionId
     */
    public function __construct(SwooleResponse $swooleResponse, ?SessionConfig $sessionConfig, ?string $sessionId)
    {
        parent::__construct($sessionConfig, $sessionId);

        $this->swooleResponse = $swooleResponse;
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

        $key = Build::getInstance()->getData($data, 0);

        $value = trim(Build::getInstance()->getData($data, 1));

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
     * @param string|null $value
     * @param int $expire
     * @param string|null $path
     * @param string|null $domain
     * @param bool $secure
     * @param bool $httponly
     * @param string|null $samesite 从 v4.4.6 版本开始支持
     * @return bool
     */
    public function cookie(string $key, ?string $value, $expire = 0, $path = '/', $domain = '', $secure = false, $httponly = false, $samesite = ''): bool
    {
        if ($this->isEnd) return false;

        return $this->swooleResponse->cookie($key, $value, $expire, $path, $domain, $secure, $httponly, $samesite);
    }


    /**
     * 启用Http-Chunk分段向浏览器发送数据
     *
     * @param string|null $data
     * @param array $options
     * @return bool
     */
    public function write(?string $data, array $options = []): bool
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
    public function sendFile(string $filename, $options = []): bool
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
