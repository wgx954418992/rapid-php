<?php

namespace rapidPHP\library\core\server\response;

use rapidPHP\library\core\server\Response;

class CGIResponse extends Response
{

    private static $instance;

    /**
     * 快速获取实例对象
     * @return Response
     */
    public static function getInstance()
    {
        return self::$instance instanceof self ? self::$instance : self::$instance = new self();
    }

    /**
     * 设置HttpCode，如404, 501, 200
     * @param $code
     */
    public function status($code)
    {
        $this->setHeader(["HTTP/1.1 {$code}", "Status: {$code}"]);
    }

    /**
     * 设置Http头信息
     * @param $data
     * @param bool $ucfirst
     */
    public function header($data, $ucfirst = true)
    {
        if ($ucfirst) $data = ucfirst($data);

        header($data);
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
     * @param string $samesite 从  php v7.3.0 版本开始支持
     */
    public function cookie($key, $value, $expire = 0, $path = '/', $domain = '', $secure = false, $httponly = false, $samesite = '')
    {
        if (version_compare(PHP_VERSION, '7.3.0', '>=')) {
            setcookie($key, $value, [
                'path' => $path,
                'domain' => $domain,
                'expires' => $expire,
                'secure' => $secure,
                'httponly' => $httponly,
                'samesite' => $samesite,
            ]);
        } else {
            setcookie($key, $value, $expire, $path, $domain, $secure, $httponly);
        }
    }


    /**
     * 启用Http-Chunk分段向浏览器发送数据
     *
     * @param string $data
     */
    public function write($data)
    {
        echo $data;
    }

    /**
     * 发送文件或者下载文件
     * @param string $filename
     * @param array $options
     */
    public function sendFile($filename, $options = [])
    {
        $fileSize = filesize($filename);

        $headers = [
            'Connection: keep-alive',
            'Accept-Ranges: bytes',
            'Pragma: cache',
            'Content-Length: ' . $fileSize,
        ];

        $isDownload = (int)B()->getData($options, 'download');
        if($isDownload){
            $headers[] = ['Content-Disposition: inline; filename=' . basename($filename)];
            $headers[] = ['Content-Transfer-Encoding: binary'];
        }

        $cacheExpire = B()->getData($options, 'cache-expire');
        if ($cacheExpire > 0) $headers[] = ['Cache-Control: max-age=' . $cacheExpire];

        $mime = B()->getData($options, 'mime');
        if ($mime) $headers[] = ['Content-type: ' . $mime];

        $start = (int)B()->getData($options, 'start');
        $end = (int)B()->getData($options, 'end');
        if ($start > 0 && $end > 0) {
            $headers[] = ['Pragma: no-cache'];
            $headers[] = ['Cache-Control: max-age=0'];
            $headers[] = ['Content-Range: bytes' . ($start - $end / $fileSize)];
        }

        $headers = array_merge($headers, B()->getData($options, 'headers'));
        $this->setHeader($headers);

        $sumBuffer = 0;
        $readBuffer = 4096;

        $handle = fopen($filename, 'rb');

        fseek($handle, $start);

        while (!feof($handle) && $sumBuffer < $end && connection_status() == 0) {

            $length = min($end - $start, $readBuffer);

            $this->write(fread($handle, $length));

            $sumBuffer += $length;
        }

        fclose($handle);
    }

    /**
     * 结束Http响应，发送HTML内容
     * @param string $data
     */
    public function end($data = '')
    {
        echo $data;
        exit();
    }
}