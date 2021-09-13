<?php


namespace rapidPHP\modules\application\wrapper;

use Exception;
use rapidPHP\modules\logger\config\LoggerConfig;
use rapidPHP\modules\reflection\classier\Utils;

class ConfigWrapper
{

    /**
     * @var ApplicationWrapper|null
     */
    private $application;

    /**
     * @var array|null
     */
    private $log;

    /**
     * @var ServerWrapper|null
     */
    private $server;

    /**
     * @var RedisWrapper|null
     */
    private $redis;

    /**
     * @var DatabaseWrapper|null
     */
    private $database;

    /**
     * @var ConsoleWrapper|null
     */
    private $console;

    /**
     * @return ApplicationWrapper|null
     */
    public function getApplication(): ?ApplicationWrapper
    {
        return $this->application;
    }

    /**
     * @param ApplicationWrapper|null $application
     */
    public function setApplication(?ApplicationWrapper $application): void
    {
        $this->application = $application;
    }

    /**
     * @return array|null
     */
    public function getLog(): ?array
    {
        return $this->log;
    }

    /**
     * @param $name
     * @return LoggerConfig|null
     * @throws Exception
     */
    public function getLogConfig($name): ?LoggerConfig
    {
        if (!isset($this->log[$name])) return null;

        if ($this->log[$name] instanceof LoggerConfig) {
            return $this->log[$name];
        }

        /** @var LoggerConfig $instance */
        $this->log[$name] = $instance = Utils::getInstance()->toObject(LoggerConfig::class, $this->log[$name]);

        return $instance;
    }

    /**
     * @param array|null $log
     */
    public function setLog(?array $log): void
    {
        $this->log = $log;
    }

    /**
     * @return ServerWrapper|null
     */
    public function getServer(): ?ServerWrapper
    {
        return $this->server;
    }

    /**
     * @param ServerWrapper|null $server
     */
    public function setServer(?ServerWrapper $server): void
    {
        $this->server = $server;
    }

    /**
     * @return RedisWrapper|null
     */
    public function getRedis(): ?RedisWrapper
    {
        return $this->redis;
    }

    /**
     * @param RedisWrapper|null $redis
     */
    public function setRedis(?RedisWrapper $redis): void
    {
        $this->redis = $redis;
    }

    /**
     * @return DatabaseWrapper|null
     */
    public function getDatabase(): ?DatabaseWrapper
    {
        return $this->database;
    }

    /**
     * @param DatabaseWrapper|null $database
     */
    public function setDatabase(?DatabaseWrapper $database): void
    {
        $this->database = $database;
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

}
