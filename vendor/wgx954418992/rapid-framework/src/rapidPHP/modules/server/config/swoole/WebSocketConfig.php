<?php

namespace rapidPHP\modules\server\config\swoole;


class WebSocketConfig extends ServerConfig
{
    /**
     * @var string
     */
    private $return_key;

    /**
     * @return string
     */
    public function getReturnKey(): string
    {
        return $this->return_key;
    }

    /**
     * @param string $return_key
     */
    public function setReturnKey(string $return_key): void
    {
        $this->return_key = $return_key;
    }
}