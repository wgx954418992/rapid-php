<?php

namespace rapidPHP\library;

use Exception;
use PDO;
use PDOException;
use rapid\library\rapid;
use rapidPHP\config\DatabaseConfig;
use rapidPHP\library\core\Loader;
use rapidPHP\library\db\Driver;
use rapidPHP\library\db\Exec;
use ReflectionException;

class Db
{

    /**
     * 当前数据库连接实例
     * @var PDO
     */
    protected $connect = null;

    /**
     * 数据库连接配置
     * @var array
     */
    protected $configs = null;

    /**
     * @var array
     */
    private static $dbs = [];

    /**
     * 连接数据库
     * @param array $config
     * @throws Exception
     */
    public function __construct(array $config)
    {
        $string = self::getConfigString($config);

        $username = self::getConfigUsername($config);

        $password = self::getConfigPassword($config);

        try {
            $db = new PDO($string, $username, $password);

            $this->setConnect($db)->setConfig($config);

            $code = $this->getConfigCode($config);

            $code ? $this->query("SET NAMES {$code}")->execute() : null;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * 获取配置链接字符串
     * @param array $config
     * @return string
     */
    public static function getConfigString(array $config)
    {
        if ($string = B()->getData($config, 'string')) {
            return (string)$string;
        } else {
            $host = B()->getData($config, 'host');

            $header = B()->getData($config, 'header');

            $database = B()->getData($config, 'database');

            $databaseType = B()->getData($config, 'databaseType');

            $databaseConnectName = B()->getData($config, 'databaseConnectName');

            return (string)"$databaseType:$header=$host;" . ($database ? "$databaseConnectName=$database" : null);
        }
    }

    /**
     * 获取配置用户名
     * @param array $config
     * @return string
     */
    public static function getConfigUsername(array $config)
    {
        return (string)B()->getData($config, 'username');
    }

    /**
     * 获取配置密码
     * @param array $config
     * @return array|null|string
     */
    public static function getConfigPassword(array $config)
    {
        return B()->getData($config, 'password');
    }

    /**
     * 获取配置驱动
     * @param array $config
     * @return array|null|string
     */
    public static function getConfigDriver(array $config)
    {
        return B()->getData($config, 'driver');
    }

    /**
     * 获取数据库编码
     * @param array $config
     * @return array|null|string
     */
    public static function getConfigCode(array $config)
    {
        return B()->getData($config, 'databaseCode');
    }

    /**
     * 获取配置信息的md5
     * @param null|array $config
     * @return string
     */
    public static function getConfigMd5($config = null)
    {
        if (!$config) if (isset(DatabaseConfig::$default)) $config = DatabaseConfig::$default;

        return md5(self::getConfigString($config));
    }

    /**
     * 快速获取实例
     * @param null|array $config
     * @return Db
     */
    public static function getInstance($config = null)
    {
        $md5 = self::getConfigMd5($config);

        /** @var Db $db */
        $db = B()->getData(self::$dbs, $md5);

        if ($db instanceof Db) return $db;

        try {
            $db = new Db($config);
        } catch (Exception $e) {
        }

        self::$dbs[$md5] = $db;

        return $db;
    }


    /**
     * 获取表name
     * @param $table
     * @return mixed
     */
    public static function getTableName($table)
    {
        if (is_file(Loader::getFilePath($table))) {
            $doc = Reflection::getInstance($table)->getDocComment();

            if (empty($doc)) return $table;

            $name = Reflection::getDocValue($doc, 'table');

            if (!empty($name)) return $name;

            return $name;
        }

        return $table;
    }

    /**
     * 获取表字段
     * @param $table
     * @param null $column
     * @param string $columnLeft
     * @param string $columnRight
     * @return mixed|string
     */
    public static function getTableColumn($table, $column = null, $columnLeft = '`', $columnRight = '`')
    {
        if (is_file(Loader::getFilePath($table))) {
            $properties = array_column(Reflection::getInstance($table)->getProperties(), 'name');

            if (empty($properties)) return '*';

            return self::formatColumn(join(',', $properties), $columnLeft, $columnRight);
        } else if (is_array($column)) {
            return self::formatColumn(join(',', $column), $columnLeft, $columnRight);
        } else if (!empty($column)) {
            return $column;
        } else {
            return '*';
        }
    }

    /**
     * 格式化字段
     * @param $column
     * @param string $columnLeft
     * @param string $columnRight
     * @return mixed
     */
    public static function formatColumn($column, $columnLeft = '`', $columnRight = '`')
    {
        return @preg_replace('/(\w+)/i', "{$columnLeft}$1{$columnRight}", $column);
    }

    /**
     * 设置connect
     * @param PDO $db
     * @return $this
     */
    public function setConnect(PDO $db)
    {
        $this->connect = $db;

        return $this;
    }

    /**
     * getConnect
     * @return PDO
     */
    public function getConnect()
    {
        return $this->connect;
    }

    /**
     * 获取配置
     * @return array
     */
    public function getConfig()
    {
        return $this->configs;
    }

    /**
     * setConfig
     * @param $config
     * @return $this
     */
    public function setConfig($config)
    {
        $this->configs = $config;
        return $this;
    }


    /**
     * 选择表
     * @param null $modelClass
     * @return Driver
     * @throws ReflectionException
     * @throws Exception
     */
    public function table($modelClass = null)
    {
        $pdo = $this->getConnect();

        $config = $this->getConfig();

        $driver = $this->getConfigDriver($config);

        if (!is_file(Loader::getFilePath($driver))) throw new Exception('driver error!');

        $driver = B()->reflectionInstance($driver, [$pdo, $modelClass]);

        if ($driver instanceof Driver) return $driver;

        throw new Exception('driver error!');
    }


    /**
     * 开启事物
     * @return bool
     */
    public function startThing()
    {
        if ($this->isInThing()) return true;

        return $this->getConnect()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) && $this->getConnect()->beginTransaction();
    }

    /**
     * 判断是否在一个事务内
     * @return bool
     */
    public function isInThing()
    {
        return $this->getConnect()->inTransaction();
    }

    /**
     * 提交
     * @param int $index
     * @return bool
     */
    public function commit($index = 0)
    {
        try {
            return $this->getConnect()->commit();
        } catch (PDOException $e) {
            if ($index > 2) throw $e;

            if ($this->handlerException($e)) {
                return $this->commit($index + 1);
            }

            throw $e;
        }
    }

    /**
     * 回滚
     * @return bool
     */
    public function rollBack()
    {
        return $this->getConnect()->rollBack();

    }

    /**
     * 处理异常
     * @param PDOException $e
     * @return Db
     */
    public function handlerException(PDOException $e)
    {
        if ($e->getCode() == 2006 || $e->getCode() == 2013) {
            return $this->reconnect($this->getConfig());
        }

        throw $e;
    }

    /**
     * 重新连接
     * @param null|array $config
     * @return Db
     */
    public function reconnect($config = null)
    {
        $configMd5 = self::getConfigMd5($config);

        $this->close($configMd5);

        return self::getInstance($config);
    }

    /**
     * 关闭连接
     * @param null|array $config
     */
    public function close($config = null)
    {
        $closeMd5 = is_string($config) ? $config : self::getConfigMd5($config);

        /**
         * @var string $md5
         * @var Db $currentDb
         */
        foreach (self::$dbs as $md5 => &$currentDb) {
            if ($closeMd5 == $md5) {
                $currentDb->connect = null;
                $currentDb = null;
                unset(self::$dbs[$md5]);
            }
        }
    }

    /**
     * 执行sql语句
     * @param $sql
     * @return Exec
     */
    public function query($sql)
    {
        return new Exec($this, $sql);
    }
}

