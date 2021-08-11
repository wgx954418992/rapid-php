<?php

namespace rapidPHP\modules\server\classier\interfaces;

use Exception;
use rapidPHP\modules\common\classier\AR;
use rapidPHP\modules\common\classier\Build;
use rapidPHP\modules\io\classier\Output;
use rapidPHP\modules\server\config\SessionConfig;

abstract class Response implements Output
{

    /**
     * sessionId
     * @var string|null
     */
    protected $sessionId;

    /**
     * @var SessionConfig|null
     */
    protected $sessionConfig;

    /**
     * Response constructor.
     * @param SessionConfig|null $sessionConfig
     * @param string|null $sessionId
     */
    public function __construct(?SessionConfig $sessionConfig, ?string $sessionId)
    {
        $this->sessionConfig = $sessionConfig;

        $this->sessionId = $sessionId;
    }

    /**
     * @return string|null
     */
    public function getSessionId(): ?string
    {
        return $this->sessionId;
    }

    /**
     * @return SessionConfig|null
     */
    public function getSessionConfig()
    {
        return $this->sessionConfig;
    }

    /**
     * 设置HttpCode，如404, 501, 200
     * @param $code
     * @return bool
     */
    abstract public function status($code): bool;


    /**
     * 设置Http头信息
     * @param $data
     * @param bool $ucfirst
     * @return bool
     */
    abstract public function header($data, $ucfirst = true): bool;

    /**
     * 设置Http头信息
     * @param $header
     * @return bool
     */
    public function setHeader($header): bool
    {
        $result = [];

        if (is_array($header)) {
            foreach ($header as $value) {
                if (!empty($value)) {
                    $result[] = $this->header($value);
                }
            }

            return AR::getInstance()->isAllAppointValue($result, true);
        } else if (is_string($header) && !empty($header)) {
            return $this->header($header);
        }
        return false;
    }

    /**
     * 重定向
     * @param $url
     * @param int $httpCode
     * @return bool
     */
    abstract public function redirect($url, $httpCode = 302): bool;

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
    abstract public function cookie(string $key, ?string $value, $expire = 0, $path = '/', $domain = '', $secure = false, $httponly = false, $samesite = ''): bool;

    /**
     * 设置session
     * @param $key
     * @param $value
     * @return bool
     * @throws Exception
     */
    public function session(string $key, $value): bool
    {
        $sessionConfig = $this->sessionConfig;

        if ($sessionConfig == null) return false;

        if (empty($this->sessionId)) return false;

        $cacheService = $sessionConfig->getService();

        if ($cacheService == null) return false;

        if (empty($this->getSessionId())) return false;

        $cacheKey = 'session_' . $this->getSessionId();

        $cacheData = $cacheService->get($cacheKey);

        if (!is_array($cacheData)) $cacheData = [];

        if (empty($value)) {
            unset($cacheData[$key]);
        } else {
            $cacheData[$key] = serialize($value);
        }

        return $cacheService->add($cacheKey, $cacheData);
    }

    /**
     * 启用Http-Chunk分段向浏览器发送数据
     *
     * @param string|null $data
     * @param array $options
     * @return bool
     */
    abstract public function write(?string $data, array $options = []): bool;

    /**
     * 输出文件到浏览器。
     * @param string $filename 文件名
     * @param array $options [
     *  start:0, //发送文件的开始位置
     *  end:0, //发送文件的结束位置
     *  mime:0, //setHeader的Content-Type
     *  download: false, //是否下载，如果是下载的话，则会调用basename获 $filename 的取文件名
     *  cache-expire: 0, //缓存时间
     *  headers:[], //headers 此headers可以替换默认生成的headers
     * ]
     * @return bool
     */
    public function printFile(string $filename, $options = []): bool
    {
        $fileSize = filesize($filename);

        $headers = [
            'Connection: keep-alive',
            'Accept-Ranges: bytes',
            'Pragma: cache',
            'Content-Length: ' . $fileSize,
        ];

        $isDownload = (bool)Build::getInstance()->getData($options, 'download');

        if ($isDownload) {
            $disName = Build::getInstance()->getData($options, 'filename');

            $headers[] = 'Content-Disposition: inline; filename=' . Build::getInstance()->contrast($disName, basename($filename));

            $headers[] = 'Content-Transfer-Encoding: binary';
        }

        $cacheExpire = Build::getInstance()->getData($options, 'cache-expire');

        if ($cacheExpire > 0) $headers[] = 'Cache-Control: max-age=' . $cacheExpire;

        $mime = Build::getInstance()->getData($options, 'mime');

        if ($mime) $headers[] = 'Content-type: ' . $mime;

        $start = (int)Build::getInstance()->getData($options, 'start');

        $end = (int)Build::getInstance()->getData($options, 'end');

        if ($start > 0 && $end > 0) {
            $headers[] = 'Pragma: no-cache';

            $headers[] = 'Cache-Control: max-age=0';

            $headers[] = 'Content-Range: bytes ' . $start . "-" . $end . "/" . $fileSize;
        }

        $headers = array_merge($headers, (array)Build::getInstance()->getData($options, 'headers'));

        $this->setHeader($headers);

        $sumBuffer = 0;

        $readBuffer = 4096;

        $handle = fopen($filename, 'rb');

        fseek($handle, $start);

        if ($end <= 0) $end = $fileSize;

        while (!feof($handle) && $sumBuffer < $end && connection_status() == 0) {

            $length = min($end - $start, $readBuffer);

            $this->write(fread($handle, $length));

            $sumBuffer += $length;
        }

        fclose($handle);

        return true;
    }

    /**
     * 发送文件到浏览器。
     * @param string $filename 文件名
     * @param array $options [
     *  start:0, //发送文件的开始位置
     *  end:0, //发送文件的结束位置
     *  mime:0, //setHeader的Content-Type
     *  download: false, //是否下载，如果是下载的话，则会调用basename获 $filename 的取文件名
     *  cache-expire: 0, //缓存时间
     *  headers:[], //headers 此headers可以替换默认生成的headers
     * ]
     * @return bool
     */
    abstract public function sendFile(string $filename, $options = []): bool;

    /**
     * 结束Http响应，发送HTML内容
     * @param string $data
     * @param array $options
     * @return bool
     */
    abstract public function end($data = '', $options = []): bool;
}
