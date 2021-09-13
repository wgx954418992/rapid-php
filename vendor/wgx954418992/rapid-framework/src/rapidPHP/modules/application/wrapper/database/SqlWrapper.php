<?php


namespace rapidPHP\modules\application\wrapper\database;

use rapidPHP\modules\database\sql\config\ConnectConfig;

class SqlWrapper
{

    /**
     * @var ConnectConfig|null
     */
    private $master;


    /**
     * @var ConnectConfig|null
     */
    private $salve;

    /**
     * @return ConnectConfig|null
     */
    public function getMaster(): ?ConnectConfig
    {
        return $this->master;
    }

    /**
     * @param ConnectConfig|null $master
     */
    public function setMaster(?ConnectConfig $master): void
    {
        $this->master = $master;
    }

    /**
     * @return ConnectConfig|null
     */
    public function getSalve(): ?ConnectConfig
    {
        return $this->salve;
    }

    /**
     * @param ConnectConfig|null $salve
     */
    public function setSalve(?ConnectConfig $salve): void
    {
        $this->salve = $salve;
    }
}