<?php


namespace rapidPHP\modules\server\config;


use rapidPHP\modules\application\classier\context\WebContext;

class CGIConfig
{

    /**
     * @var SessionConfig|null
     */
    private $session;

    /**
     * @var string|WebContext|null
     */
    private $context;

    /**
     * @var array|null
     */
    private $options;

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