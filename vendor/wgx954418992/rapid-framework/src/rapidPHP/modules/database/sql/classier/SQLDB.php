<?php

namespace rapidPHP\modules\database\sql\classier;


use Exception;
use PDO;
use rapidPHP\modules\database\sql\classier\driver\Mysql;
use rapidPHP\modules\database\sql\config\ConnectConfig;
use rapidPHP\modules\reflection\classier\Classify;
use PDOStatement;

class SQLDB
{
    /**
     * 重新连接codes
     */
    const ERROR_RECONNECT_CODES = [
        2006,
        2013,
    ];

    /**
     * @var int
     */
    private $reconnectCount = 0;

    /**
     * 当前数据库连接实例
     * @var PDO
     */
    private $connect = null;

    /**
     * 数据库连接配置
     * @var ConnectConfig
     */
    private $config = null;

    /**
     * 获取配置
     * @return ConnectConfig|null
     */
    public function getConfig(): ?ConnectConfig
    {
        return $this->config;
    }

    /**
     * 连接数据库
     * @param ConnectConfig $config
     * @throws Exception
     */
    public function connect(ConnectConfig $config)
    {
        $this->connect = new PDO($config->getUrl(), $config->getUsername(), $config->getPassword(), [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);

        $this->config = $config;

        if ($code = $config->getCharacterCode()) {
            $this->query("SET NAMES {$code}")->execute();
        }
    }


    /**
     * getConnect
     * @return PDO
     */
    public function getConnect(): ?PDO
    {
        return $this->connect;
    }

    /**
     * 选择表
     * @param string|null $tableName
     * @return Driver|Mysql
     * @throws Exception
     */
    public function table(string $tableName = null)
    {
        $config = $this->getConfig();

        $driver = Classify::getInstance($config->getDriver())
            ->newInstance($this, $tableName);

        if ($driver instanceof Driver) return $driver;

        throw new Exception('driver error!');
    }

    /**
     * 判断是否在一个事务内
     * @return bool
     */
    public function isInThing(): bool
    {
        return $this->getConnect()->inTransaction();
    }

    /**
     * 开启事物
     * @return bool
     * @throws Exception
     */
    public function beginTransaction(): bool
    {
        if ($this->isInThing()) return true;

        try {
            return @$this->getConnect()->beginTransaction();
        } catch (Exception $e) {
            if ($this->onErrorHandler()) {
                return $this->beginTransaction();
            }
            throw $e;
        }
    }

    /**
     * 提交
     * @return bool
     * @throws Exception
     */
    public function commit(): bool
    {
        try {
            return @$this->getConnect()->commit();
        } catch (Exception $e) {
            if ($this->onErrorHandler()) {
                return $this->commit();
            }
            throw $e;
        }
    }

    /**
     * 回滚
     * @return bool
     * @throws Exception
     */
    public function rollBack(): bool
    {
        try {
            return @$this->getConnect()->rollBack();
        } catch (Exception $e) {
            if ($this->onErrorHandler()) {
                return $this->rollBack();
            }
            throw $e;
        }
    }

    /**
     * 处理异常
     * @return bool
     * @throws Exception
     */
    public function onErrorHandler(): bool
    {
        list(1 => $code) = $this->getConnect()->errorInfo();

        if (in_array($code, self::ERROR_RECONNECT_CODES)) {
            $this->reconnect();

            return true;
        }
        
        return false;
    }

    /**
     * 重新连接
     * @throws Exception
     */
    public function reconnect()
    {
        if ($this->reconnectCount >= 2) throw new Exception('database exception reconnect error!');

        $this->close();

        $this->connect($this->getConfig());

        $this->reconnectCount++;
    }

    /**
     * 关闭连接
     */
    public function close()
    {
        $this->connect = null;
    }

    /**
     * 执行sql语句
     * @param $sql
     * @return Statement
     */
    public function query($sql)
    {
        return new Statement($this, $sql);
    }
}

