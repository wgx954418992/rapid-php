<?php


namespace rapidPHP\modules\application\wrapper;

use rapidPHP\modules\application\wrapper\application\ConsoleWrapper;
use rapidPHP\modules\application\wrapper\application\ScansWrapper;
use rapidPHP\modules\application\wrapper\application\WebWrapper;

class ApplicationWrapper
{

    /**
     * @var ScansWrapper|null
     */
    private $scans;

    /**
     * @var ConsoleWrapper|null
     */
    private $console;

    /**
     * @var WebWrapper|null
     */
    private $web;

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
     * @return ConsoleWrapper|null
     */
    public function getConsole(): ?ConsoleWrapper
    {
        return $this->console;
    }

    /**
     * @param ConsoleWrapper|null $console
     */
    public function setConsole(?ConsoleWrapper $console): void
    {
        $this->console = $console;
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