<?php

namespace rapidPHP\library\core\server;

abstract class Response
{

    /**
     * 设置HttpCode，如404, 501, 200
     * @param $code
     */
    abstract public function status($code);

    /**
     * 设置Http头信息
     * @param $data
     * @param bool $ucfirst
     */
    abstract public function header($data, $ucfirst = true);

    /**
     * 设置Http头信息
     * @param $header
     */
    public function setHeader($header)
    {
        if (is_array($header)) {
            foreach ($header as $value) {
                if (!empty($value)) {
                    $this->header($value);
                }
            }
        } else if (is_string($header) && !empty($header)) {
            $this->header($header);
        }
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
     */
    abstract public function cookie($key, $value, $expire = 0, $path = '/', $domain = '', $secure = false, $httponly = false, $samesite = '');


    /**
     * 启用Http-Chunk分段向浏览器发送数据
     *
     * @param string $data
     */
    abstract public function write($data);

    /**
     * 发送文件到浏览器。
     * @param string $filename 文件名
     * @param array $options[
     *  start:0, //发送文件的开始位置
     *  end:0, //发送文件的结束位置
     *  mime:0, //setHeader的Content-Type
     *  download: false, //是否下载，如果是下载的话，则会调用basename获 $filename 的取文件名
     *  cache-expire: 0, //缓存时间
     *  headers:[], //headers 此headers可以替换默认生成的headers
     * ]
     */
    abstract public function sendFile($filename, $options = []);

    /**
     * 结束Http响应，发送HTML内容
     * @param string $data
     */
    abstract public function end($data = '');
}