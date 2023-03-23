<?php

namespace rapidPHP\modules\database\sql\classier;


use Exception;
use rapidPHP\modules\application\classier\Application;
use rapidPHP\modules\common\classier\Instances;
use rapidPHP\modules\database\sql\config\ConnectConfig;

class SQLSource
{

    /**
     * 采用单例模式
     */
    use Instances;

    /**
     * 实例不存在
     * @return static
     */
    public static function onNotInstance()
    {
        return new static(...func_get_args());
    }

    /**
     * 主库
     */
    const DB_MASTER = 'master';

    /**
     * 从库
     */
    const DB_SALVE = 'salve';

    /**
     * 数据监连接对象，默认为全局缓存，后期可以直接调用 连接池
     * @var SQLDB[]
     */
    protected $dbs;

    /**
     * 获取数据库连接配置
     * @param ConnectConfig|string|null $config
     * @return ConnectConfig
     * @throws Exception
     */
    public function getConfig($config = null)
    {
        if ($config instanceof ConnectConfig) return $config;

        $sql = Application::getInstance()->getConfigWrapper()->getDatabase()->getSql();

        if (empty($sql)) throw new Exception('sql config error');

        if (!$config) return $sql->getMaster();

        switch ($config) {
            case self::DB_MASTER:
                return $sql->getMaster();
            case self::DB_SALVE:
                return $sql->getSalve();
        }

        throw new Exception('config error!');
    }

    /**
     * 获取SQLDB实例 默认获取master 实例
     * @param ConnectConfig|string|null $config
     * @return SQLDB
     * @throws Exception
     */
    public function getDB($config = null)
    {
        $config = $this->getConfig($config);

        $hash = $config->getHash();

        if (isset($this->dbs[$hash]) && $this->dbs[$hash] instanceof SQLDB) {
            $db = $this->dbs[$hash];

            if ($db->getConnect() != null) return $db;

            $db->connect($config);
        } else {
            $db = new SQLDB();

            $db->connect($config);

            $this->dbs[$hash] = $db;
        }

        return $db;
    }

    /**
     * 获取主库
     * @return SQLDB
     * @throws Exception
     */
    public function getMasterDB()
    {
        return $this->getDB(self::DB_MASTER);
    }

    /**
     * 获取从库
     * @return SQLDB
     * @throws Exception
     */
    public function getSalveDB()
    {
        return $this->getDB(self::DB_SALVE);
    }
}
