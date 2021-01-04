<?php


namespace rapidPHP\modules\application\wrapper;

use rapidPHP\modules\application\classier\context\WebContext;
use rapidPHP\modules\application\wrapper\application\ScansWrapper;
use rapidPHP\modules\application\wrapper\application\WebWrapper;
use rapidPHP\modules\server\config\SessionConfig;

class ApplicationWrapper
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
     * @var ScansWrapper|null
     */
    private $scans;

    /**
     * @var WebWrapper|null
     */
    private $web;

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
     * @return ScansWrapper|null
     */
    public function getScans(): ?ScansWrapper
    {
        return $this->scans;
    }

    /**
     * @param ScansWrapper|null $scans
     */
    public function setScans(?ScansWrapper $scans): void
    {
        $this->scans = $scans;
    }


    /**
     * @return WebWrapper|null
     */
    public function getWeb(): ?WebWrapper
    {
        return $this->web;
    }

    /**
     * @param WebWrapper|null $web
     */
    public function setWeb(?WebWrapper $web): void
    {
        $this->web = $web;
    }

}