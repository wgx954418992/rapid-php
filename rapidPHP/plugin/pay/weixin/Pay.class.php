<?php

namespace rapidPHP\plugin\pay\weixin;

class Pay
{

    /**
     * @var Config
     */
    private $config;

    /**
     * @var
     */
    protected static $utils;

    /**
     * PayFactory constructor.
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->setConfig($config);
    }

    /**
     * @return Config
     */
    public function getConfig(): Config
    {
        return $this->config;
    }

    /**
     * @param Config $config
     */
    private function setConfig(Config $config): void
    {
        $this->config = $config;
    }

    /**
     * 工具类
     * @return Utils
     */
    public function utils()
    {
        if (self::$utils instanceof Utils) return self::$utils;

        self::$utils = new Utils($this->config);

        return self::$utils;
    }
}