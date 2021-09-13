<?php


namespace rapidPHP\modules\server\config\swoole;

use rapidPHP\modules\server\config\ServerConfig as BaseServerConfig;

class ServerConfig extends BaseServerConfig
{

    /**
     * @var array
     */
    private $co;

    /**
     * @return array|null
     */
    public function getCo(): array
    {
        return $this->co;
    }

    /**
     * @param array|null $co
     */
    public function setCo(array $co): void
    {
        $this->co = $co;
    }
}