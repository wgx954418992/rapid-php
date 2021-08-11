<?php

namespace rapidPHP\modules\server\classier\interfaces\task;

use rapidPHP\modules\server\classier\interfaces\server\SwooleServer;
use rapidPHP\modules\server\classier\interfaces\Task;

abstract class SwooleTask extends Task
{
    /**
     * TaskInterface constructor.
     * @param SwooleServer $swooleServer
     */
    public function __construct(SwooleServer $swooleServer)
    {
        parent::__construct($swooleServer);
    }

    /**
     * @return SwooleServer
     */
    public function getServer()
    {
        return parent::getServer();
    }
}
