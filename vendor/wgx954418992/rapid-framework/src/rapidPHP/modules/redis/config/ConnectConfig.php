<?php

namespace rapidPHP\modules\redis\config;

class ConnectConfig
{
    /**
     * redis 地址
     * @var string|null
     */
    private $host = '';

    /**
     * redis 端口
     * @var int|null
     */
    private $port = 6379;

    /**
     * redis 密码
     * @var string|null
     */
    private $auth = '';

    /**
     * 数据库 默认0
     * @var int|null
     */
    private $select = 0;

    /**
     * 缓存前缀
     * @var string|null
     */
    private $prefix = null;

    /**
     * @return string|null
     */
    public function getHost(): ?string
    {
        return $this->host;
    }

    /**
     * @param string|null $host
     */
    public function setHost(?string $host): void
    {
        $this->host = $host;
    }

    /**
     * @return int|null
     */
    public function getPort(): ?int
    {
        return $this->port;
    }

    /**
     * @param int|null $port
     */
    public function setPort(?int $port): void
    {
        $this->port = $port;
    }

    /**
     * @return string|null
     */
    public function getAuth(): ?string
    {
        return $this->auth;
    }

    /**
     * @param string|null $auth
     */
    public function setAuth(?string $auth): void
    {
        $this->auth = $auth;
    }

    /**
     * @return int|null
     */
    public function getSelect(): ?int
    {
        return $this->select;
    }

    /**
     * @param int|null $select
     */
    public function setSelect(?int $select): void
    {
        $this->select = $select;
    }


    /**
     * @return string|null
     */
    public function getPrefix(): ?string
    {
        return $this->prefix;
    }

    /**
     * @param string|null $prefix
     */
    public function setPrefix(?string $prefix): void
    {
        $this->prefix = $prefix;
    }

}
