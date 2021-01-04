<?php

namespace rapidPHP\modules\application\wrapper;

use rapidPHP\modules\application\classier\context\WebContext;
use rapidPHP\modules\server\config\SessionConfig;

class ConsoleWrapper
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
}