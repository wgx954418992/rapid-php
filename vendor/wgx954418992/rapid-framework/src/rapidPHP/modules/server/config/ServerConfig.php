<?php


namespace rapidPHP\modules\server\config;

use rapidPHP\modules\application\classier\context\WebContext;

class ServerConfig
{

    /**
     * ip
     * @var string|null
     */
    private $ip;

    /**
     * port
     * @var int|null
     */
    private $port;

    /**
     * @var SessionConfig|null
     */
    private $session;

    /**
     * @var string|WebContext|null
     */
    private $context;

    /**
     * @var string|null
     */
    private $task;

    /**
     * @var array|null
     */
    private $options;

    /**
     * @return string|null
     */
    public function getIp(): ?string
    {
        return $this->ip;
    }

    /**
     * @param string|null $ip
     */
    public function setIp(?string $ip): void
    {
        $this->ip = $ip;
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
     * @return SessionConfig|null
     */
    public function getSession(): ?SessionConfig
    {
        return $this->session;
    }

    /**
     * @param SessionConfig|null $session
     */
    public function setSession(?SessionConfig $session): void
    {
        $this->session = $session;
    }

    /**
     * @return WebContext|string|null
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * @param WebContext|string|null $context
     */
    public function setContext($context): void
    {
        $this->context = $context;
    }

    /**
     * @return string|null
     */
    public function getTask(): ?string
    {
        return $this->task;
    }

    /**
     * @param string|null $task
     */
    public function setTask(?string $task): void
    {
        $this->task = $task;
    }

    /**
     * @return array|null
     */
    public function getOptions(): ?array
    {
        return $this->options;
    }

    /**
     * @param array|null $options
     */
    public function setOptions(?array $options): void
    {
        $this->options = $options;
    }
}