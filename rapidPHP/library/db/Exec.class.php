<?php

namespace rapidPHP\library\db;

use PDO;
use PDOException;
use PDOStatement;
use rapidPHP\library\Db;

class Exec
{

    /**
     * 连接对象
     * @var Db
     */
    private $db;

    /**
     * sql执行语句
     * @var string
     */
    private $sql;

    /**
     * Exec constructor.
     * @param Db $db
     * @param $sql
     */
    public function __construct(Db &$db, $sql)
    {
        $this->sql = $sql;
        $this->db = $db;
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
            $result = $this->db->getConnect()->prepare($this->sql);

            return $result->execute($options);
        } catch (PDOException $e) {
            if ($index > 2) throw $e;

            if ($this->db->handlerException($e)) {
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
            $result = $this->db->getConnect()->prepare($this->sql);

            $result->execute($options);

            $result->setFetchMode($mode);

            return $result;
        } catch (PDOException $e) {
            if ($index > 2) throw $e;

            if ($this->db->handlerException($e)) {
                return $this->getPdoStatement($options, $mode, $index + 1);
            }

            throw $e;
        }
    }

    /**
     * select用这个执行
     * @param $modelClass
     * @param array $options
     * @param int $mode
     * @return Result
     */
    public function get($modelClass = null, array $options = [], $mode = PDO::FETCH_ASSOC)
    {
        $statement = $this->getPdoStatement($options, $mode);

        $result = $statement->fetchAll();

        $statement->closeCursor();

        unset($statement);

        if (!empty($result)) B()->autoTypeConvertByAB($result);

        return new Result($result, $modelClass);
    }

}

