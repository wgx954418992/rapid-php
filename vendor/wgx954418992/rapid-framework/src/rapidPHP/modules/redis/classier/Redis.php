<?php

namespace rapidPHP\modules\redis\classier;

use Exception;
use rapidPHP\modules\redis\config\ConnectConfig;

class Redis extends \Redis
{

    /**
     * Redis constructor.
     * @param ConnectConfig $config
     * @throws Exception
     */
    public function __construct(ConnectConfig $config)
    {
        parent::__construct();

        $this->connect($config->getHost(), $config->getPort());

        if (!empty($config->getAuth()) && !$this->auth($config->getAuth()))
            throw new Exception('auth Fail!');

        $this->select($config->getSelect());
    }

}
