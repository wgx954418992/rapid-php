<?php


namespace apps\app\classier\database\sql;


use Exception;
use rapidPHP\modules\application\classier\Application;
use rapidPHP\modules\database\sql\classier\SQLDB;

abstract class DBSource
{

    /**
     * 数据监连接对象，默认为全局缓存，后期可以直接调用 连接池
     * @var SQLDB
     */
    private static $db;

    /**
     * 获取连接
     * @return SQLDB
     * @throws Exception
     */
    public static function getDb()
    {
        if (self::$db instanceof SQLDB) return self::$db;

        $masterConfig = Application::getInstance()->getConfig()->getDatabase()
            ->getSql()
            ->getMaster();

        self::$db = new SQLDB();

        self::$db->connect($masterConfig);

        return self::$db;
    }
}