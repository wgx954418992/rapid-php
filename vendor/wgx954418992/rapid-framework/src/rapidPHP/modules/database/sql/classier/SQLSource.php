<?php

namespace rapidPHP\modules\database\sql\classier;


use Exception;
use rapidPHP\modules\application\classier\Application;
use rapidPHP\modules\database\sql\config\ConnectConfig;

class SQLSource
{

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
    private static $dbs;

    /**
     * 获取数据库连接配置
     * @param ConnectConfig|string|null $config
     * @return ConnectConfig
     * @throws Exception
     */
    public static function getConfig($config = null)
    {
        if ($config instanceof ConnectConfig) return $config;

        $sql = Application::getInstance()->getConfig()->getDatabase()->getSql();

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
    public static function getDB($config = null)
    {
        $config = self::getConfig($config);

        $hash = $config->getHash();

        if (isset(self::$dbs[$hash]) && self::$dbs[$hash] instanceof SQLDB) {
            return self::$dbs[$hash];
        } else {
            $db = new SQLDB();

            $db->connect($config);

            self::$dbs[$hash] = $db;

            return $db;
        }
    }

    /**
     * 获取主库
     * @return SQLDB
     * @throws Exception
     */
    public static function getMasterDB()
    {
        return self::getDB(self::DB_MASTER);
    }

    /**
     * 获取从库
     * @return SQLDB
     * @throws Exception
     */
    public static function getSalveDB()
    {
        return self::getDB(self::DB_SALVE);
    }
}