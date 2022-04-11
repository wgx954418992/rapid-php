<?php

namespace apps\file\classier\config;

use apps\core\classier\config\Configure;

class OSSConfig
{

    /**
     * Configure
     */
    use Configure;

    /**
     * service
     * @var string
     * @config oss.service
     */
    protected $service;

    /**
     * @return string
     */
    public function getService(): string
    {
        return $this->service;
    }
}
