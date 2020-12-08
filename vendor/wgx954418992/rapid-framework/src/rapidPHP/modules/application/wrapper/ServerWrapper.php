<?php


namespace rapidPHP\modules\application\wrapper;

use rapidPHP\modules\application\wrapper\server\SwooleWrapper;
use rapidPHP\modules\server\config\CGIConfig;

class ServerWrapper
{
    /**
     * @var CGIConfig|null
     */
    private $cgi;

    /**
     * @var SwooleWrapper|null
     */
    private $swoole;

    /**
     * ServerConfig constructor.
     * @param CGIConfig|null $cgi
     * @param SwooleWrapper|null $swoole
     */
    public function __construct(?CGIConfig $cgi, ?SwooleWrapper $swoole)
    {
        $this->cgi = $cgi;

        $this->swoole = $swoole;
    }

    /**
     * @return CGIConfig|null
     */
    public function getCgi(): ?CGIConfig
    {
        return $this->cgi;
    }

    /**
     * @return SwooleWrapper|null
     */
    public function getSwoole(): ?SwooleWrapper
    {
        return $this->swoole;
    }
}