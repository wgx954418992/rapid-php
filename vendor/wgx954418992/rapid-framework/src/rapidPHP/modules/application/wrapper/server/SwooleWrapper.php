<?php


namespace rapidPHP\modules\application\wrapper\server;


use rapidPHP\modules\server\config\SessionConfig;
use rapidPHP\modules\server\config\swoole\HttpConfig;
use rapidPHP\modules\server\config\swoole\ServerConfig as SwooleServerConfig;
use rapidPHP\modules\server\config\swoole\WebSocketConfig;

class SwooleWrapper
{

    /**
     * @var HttpConfig|null
     */
    private $http;

    /**
     * @var WebSocketConfig|null
     */
    private $websocket;

    /**
     * SwooleConfig constructor.
     * @param HttpConfig|null $http
     * @param WebSocketConfig|null $websocket
     * @param string|null $ip
     * @param int|null $port
     * @param SessionConfig|null $session
     * @param $context
     * @param string|null $task
     * @param array|null $options
     */
    public function __construct(?HttpConfig $http, ?WebSocketConfig $websocket, ?string $ip, ?int $port, ?SessionConfig $session, $context, ?string $task, ?array $options)
    {
        $this->merge($http, $ip, $port, $session, $context, $task, $options);

        $this->merge($websocket, $ip, $port, $session, $context, $task, $options);

        $this->http = $http;

        $this->websocket = $websocket;
    }

    /**
     * @param SwooleServerConfig $config
     * @param string|null $ip
     * @param int|null $port
     * @param SessionConfig|null $session
     * @param $context
     * @param string|null $task
     * @param array|null $options
     */
    public function merge(?SwooleServerConfig $config, ?string $ip, ?int $port, ?SessionConfig $session, $context, ?string $task, ?array $options)
    {
        if ($config != null) return;

        if (empty($config->getIp())) $config->setIp($ip);

        if (empty($config->getPort())) $config->setPort($port);

        if ($config->getSession() == null) $config->setSession($session);

        if (empty($config->getContext())) $config->setContext($context);

        if (empty($config->getTask())) $config->setTask($task);

        $config->setOptions(array_merge($options, $config->getOptions()));
    }

    /**
     * @return HttpConfig|null
     */
    public function getHttp(): ?HttpConfig
    {
        return $this->http;
    }

    /**
     * @param HttpConfig|null $http
     */
    public function setHttp(?HttpConfig $http): void
    {
        $this->http = $http;
    }

    /**
     * @return WebSocketConfig|null
     */
    public function getWebsocket(): ?WebSocketConfig
    {
        return $this->websocket;
    }

    /**
     * @param WebSocketConfig|null $websocket
     */
    public function setWebsocket(?WebSocketConfig $websocket): void
    {
        $this->websocket = $websocket;
    }
}