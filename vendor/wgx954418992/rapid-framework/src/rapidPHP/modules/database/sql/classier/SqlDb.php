<?php

namespace rapidPHP\modules\database\sql\classier;


use Exception;
use PDO;
use PDOException;
use rapidPHP\modules\database\sql\config\ConnectConfig;
use rapidPHP\modules\reflection\classier\Classify;

class SqlDB
{

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
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * 连接数据库
     * @param ConnectConfig $config
     */
    public function connect(ConnectConfig $config)
    {
        $db = new PDO($config->getUrl(), $config->getUsername(), $config->getPassword());

        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->connect = $db;

        $this->config = $config;

        $code = $config->getCharacterCode();

        $code ? $this->query("SET NAMES {$code}")->execute() : null;
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
     * 选择表
     * @param null $model
     * @return Driver
     * @throws Exception
     */
    public function table($model = null)
    {
        $config = $this->getConfig();

        $driver = Classify::getInstance($config->getDriver())
            ->newInstance($this, $model);

        if ($driver instanceof Driver) return $driver;

        throw new Exception('driver error!');
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
     * 开启事物
     * @return bool
     */
    public function startThing()
    {
        if ($this->isInThing()) return true;

        return $this->getConnect()->beginTransaction();
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
     * @return SqlDB
     */
    public function handlerException(PDOException $e)
    {
        if ($e->getCode() == 2006 || $e->getCode() == 2013) {
            return $this->reconnect();
        }

        throw $e;
    }

    /**
     * 重新连接
     * @return $this
     */
    public function reconnect()
    {
        $this->close();

        $this->connect($this->getConfig());

        return $this;
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
     * @return Exec
     */
    public function query($sql)
    {
        return new Exec($this, $sql);
    }
}

