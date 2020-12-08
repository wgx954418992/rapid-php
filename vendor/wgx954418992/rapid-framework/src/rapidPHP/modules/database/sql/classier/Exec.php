<?php

namespace rapidPHP\modules\database\sql\classier;

use PDO;
use PDOException;
use PDOStatement;
use rapidPHP\modules\common\classier\Build;

class Exec
{

    /**
     * 连接对象
     * @var SqlDB
     */
    private $db;

    /**
     * sql执行语句
     * @var string
     */
    private $sql;

    /**
     * Exec constructor.
     * @param SqlDB $db
     * @param $sql
     */
    public function __construct(SqlDB $db, $sql)
    {
        $this->sql = $sql;

        $this->db = $db;
    }

    /**
     * @return SqlDB
     */
    public function getDb(): SqlDB
    {
        return $this->db;
    }

    /**
     * @param SqlDB $db
     */
    public function setDb(SqlDB $db): void
    {
        $this->db = $db;
    }

    /**
     * @return string
     */
    public function getSql(): string
    {
        return $this->sql;
    }

    /**
     * @param string $sql
     */
    public function setSql(string $sql): void
    {
        $this->sql = $sql;
    }

    /**
     * 除过select都用这个执行
     * @param array $options
     * @param int $index
     * @return bool
     */
    public function execute(array $options = [], $index = 0)
    {
        try {
            $result = $this->getDb()->getConnect()->prepare($this->getSql());

            return $result->execute($options);
        } catch (PDOException $e) {
            if ($index > 2) throw $e;

            if ($this->getDb()->handlerException($e)) {
                return $this->execute($options, $index + 1);
            }

            throw $e;
        }
    }

    /**
     * 获取pdo流
     * @param array $options
     * @param int $mode
     * @param int $index
     * @return bool|PDOStatement
     */
    public function getPdoStatement(array $options = [], $mode = PDO::FETCH_ASSOC, $index = 0)
    {
        try {
            $result = $this->getDb()->getConnect()->prepare($this->getSql());

            $result->execute($options);

            $result->setFetchMode($mode);

            return $result;
        } catch (PDOException $e) {
            if ($index > 2) throw $e;

            if ($this->getDb()->handlerException($e)) {
                return $this->getPdoStatement($options, $mode, $index + 1);
            }

            throw $e;
        }
    }

    /**
     * select用这个执行
     * @param $model
     * @param array $options
     * @param int $mode
     * @return Result
     */
    public function get($model = null, array $options = [], $mode = PDO::FETCH_ASSOC)
    {
        $statement = $this->getPdoStatement($options, $mode);

        $result = $statement->fetchAll();

        $statement->closeCursor();

        unset($statement);

        if (!empty($result)) Build::getInstance()->toTypeConvertByAO($result);

        return new Result($result, $model);
    }

}

