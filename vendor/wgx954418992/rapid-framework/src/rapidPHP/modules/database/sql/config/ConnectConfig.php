<?php

namespace rapidPHP\modules\database\sql\config;

use Exception;
use rapidPHP\modules\pool\config\PoolConfig;
use rapidPHP\modules\common\classier\Build;
use rapidPHP\modules\common\classier\Uri;
use rapidPHP\modules\database\sql\classier\driver\Mysql;
use rapidPHP\modules\database\sql\config\connect\ModelConfig;

class ConnectConfig
{

    /**
     * url
     *
     * @url mysql:host={host};dbname={database}
     *
     * @var string|null
     */
    private $url;

    /**
     * 用户名
     * @var string|null
     */
    private $username;

    /**
     * 密码
     * @var string|null
     */
    private $password;

    /**
     * 驱动
     * @var string|null
     */
    private $driver;

    /**
     * 数据库
     * @var string|null
     */
    private $database;

    /**
     * 数据库编码
     * @var string|null
     */
    private $characterCode;

    /**
     * model
     * @var ModelConfig|null
     */
    private $model;

    /**
     * pool
     * @var PoolConfig|null
     */
    private $pool;

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string|null $url
     * @throws Exception
     */
    public function setUrl(?string $url): void
    {
        if (empty($url)) {
            $this->url = $url;

            return;
        }

        $urlParse = Uri::getInstance()->parseUrl($url);

        if (!isset($urlParse[Uri::URL_QUERY])) throw new Exception('url input error!');

        $query = Uri::getInstance()->toArray($urlParse[Uri::URL_QUERY]);

        $this->database = Build::getInstance()->getData($query, SqlConfig::CONFIG_KEY_DATABASE);

        $this->characterCode = Build::getInstance()->getData($query, SqlConfig::CONFIG_KEY_CHARACTER_CODE);

        $scheme = Build::getInstance()->getData($urlParse, Uri::URL_SCHEME);

        if (empty($scheme)) throw new Exception('url scheme error!');

        $host = Build::getInstance()->getData($urlParse, Uri::URL_HOST);

        if (empty($host)) throw new Exception('url host error!');

        $port = Build::getInstance()->getData($urlParse, Uri::URL_PORT);

        if (!empty($port)) $host .= ":{$port}";

        switch (strtolower($scheme)) {
            case 'mysql':
                $this->driver = Mysql::class;

                $this->url = "mysql:host={$host};";

                if (!empty($this->database)) {
                    $this->url .= "dbname={$this->database}";
                }
                break;
        }
    }

    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string|null $username
     */
    public function setUsername(?string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string|null $password
     */
    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string|null
     */
    public function getDriver(): ?string
    {
        return $this->driver;
    }

    /**
     * @return string|null
     */
    public function getDatabase(): ?string
    {
        return $this->database;
    }

    /**
     * @return string|null
     */
    public function getCharacterCode(): ?string
    {
        return $this->characterCode;
    }

    /**
     * @return ModelConfig|null
     */
    public function getModel(): ?ModelConfig
    {
        return $this->model;
    }

    /**
     * @param ModelConfig|null $model
     */
    public function setModel(?ModelConfig $model): void
    {
        $this->model = $model;
    }

    /**
     * @return PoolConfig|null
     */
    public function getPool(): ?PoolConfig
    {
        return $this->pool;
    }

    /**
     * @param PoolConfig|null $pool
     */
    public function setPool(?PoolConfig $pool): void
    {
        $this->pool = $pool;
    }
}
