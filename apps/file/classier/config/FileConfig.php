<?php

namespace apps\file\classier\config;

use apps\core\classier\config\Configure;
use function rapidPHP\V;

class FileConfig
{

    /**
     * Configure
     */
    use Configure;

    /**
     * file host
     * @var string
     * @config host.file
     */
    protected $host;

    /**
     * service
     * @var string
     * @config file.service
     */
    protected $service;

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @return string
     */
    public function getService(): string
    {
        return $this->service;
    }

    /**
     * 获取文件url地址
     * @param $fileId
     * @return string
     */
    public static function getFileUrl($fileId): string
    {
        if (empty($fileId)) return '';

        if (V()->website($fileId)) {
            return $fileId;
        } else {

            return static::getInstance()->getHost() . 'file/' . $fileId;
        }
    }
}
