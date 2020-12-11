<?php


namespace rapidPHP\modules\database\sql\classier;


use Exception;
use PDO;
use PDOStatement;
use rapidPHP\modules\common\classier\Build;
use rapidPHP\modules\reflection\classier\Utils as ReflectionUtils;

class Statement
{

    /**
     * @var array|null
     */
    private $options;

    /**
     * @var SQLDB
     */
    private $db;

    /**
     * @var string
     */
    private $sql;

    /**
     * Statement constructor.
     * @param SQLDB $db
     * @param string $sql
     */
    public function __construct(SQLDB $db, string $sql)
    {
        $this->db = $db;

        $this->sql = $sql;
    }

    /**
     * 获取statement
     * @param null $result
     * @return bool|PDOStatement
     * @throws Exception
     */
    public function getStatement(&$result = null)
    {
        try {
            $statement = @$this->db->getConnect()->prepare($this->sql);

            $result = @$statement->execute($this->options);

            return $statement;
        } catch (Exception $e) {
            if ($this->db->onErrorHandler($e)) {
                return $this->getStatement($result);
            }

            throw $e;
        }

    }

    /**
     * @param array|null $options
     */
    public function setOptions(?array $options): void
    {
        $this->options = $options;
    }

    /**
     * @return array|null
     */
    public function getOptions(): ?array
    {
        return $this->options;
    }

    /**
     * execute
     * @return bool
     * @throws Exception
     */
    public function execute(): bool
    {
        $statement = $this->getStatement($result);

        $statement->closeCursor();

        return $result;
    }

    /**
     * 获取一条
     * @param string|null $objectClass
     * @return mixed|object|void|null
     * @throws Exception
     */
    public function fetch($objectClass = null)
    {
        $statement = $this->getStatement();

        $data = $statement->fetch(PDO::FETCH_ASSOC);

        $statement->closeCursor();

        if (empty($data)) return null;

        Build::getInstance()->toTypeConvertByAO($data);

        if (empty($objectClass)) return $data;

        return ReflectionUtils::getInstance()->toObject($objectClass, $data);
    }

    /**
     * 获取value
     * @param $name
     * @return mixed|null
     * @throws Exception
     */
    public function fetchValue($name)
    {
        $statement = $this->getStatement();

        $data = $statement->fetch(PDO::FETCH_ASSOC);

        $statement->closeCursor();

        if (empty($data)) return null;

        return isset($data[$name]) ? $data[$name] : null;
    }

    /**
     * 获取全部
     * @param string|null $objectClass
     * @return mixed|object|void|null
     * @throws Exception
     */
    public function fetchAll($objectClass = null)
    {
        $statement = $this->getStatement();

        $data = $statement->fetchAll(PDO::FETCH_ASSOC);

        $statement->closeCursor();

        if (empty($data)) return null;

        Build::getInstance()->toTypeConvertByAO($data);

        if (empty($objectClass)) return $data;

        foreach ($data as $index => $datum) {
            $data[$index] = ReflectionUtils::getInstance()->toObject($objectClass, $datum);
        }

        return $data;
    }

}