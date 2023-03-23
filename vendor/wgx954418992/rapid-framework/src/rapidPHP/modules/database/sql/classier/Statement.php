<?php


namespace rapidPHP\modules\database\sql\classier;


use Exception;
use PDO;
use PDOStatement;
use rapidPHP\modules\application\classier\Application;
use rapidPHP\modules\common\classier\Build;
use rapidPHP\modules\reflection\classier\Utils as ReflectionUtils;

class Statement
{

    /**
     * @var array|null
     */
    protected $options;

    /**
     * @var SQLDB
     */
    protected $db;

    /**
     * @var string
     */
    protected $sql;

    /**
     * @var bool
     */
    protected $debugDumpParams;

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
     * @param bool $debugDumpParams
     */
    public function setDebugDumpParams(bool $debugDumpParams): void
    {
        $this->debugDumpParams = $debugDumpParams;
    }

    /**
     * 获取statement
     * @param $result
     * @return bool|PDOStatement
     * @throws Exception
     */
    public function getStatement(&$result = null)
    {
        try {
            $statement = @$this->db->getConnect()->prepare($this->sql);

            if ($this->options) {
                foreach ((array)$this->options as $name => $value) {
                    if (is_bool($value)) {
                        $statement->bindValue($name, $value, PDO::PARAM_BOOL);
                    } else if (is_int($value)) {
                        $statement->bindValue($name, $value, PDO::PARAM_INT);
                    } else {
                        $statement->bindValue($name, $value);
                    }
                }
            }

            $result = @$statement->execute();

            if ($this->debugDumpParams) $statement->debugDumpParams();

            return $statement;
        } catch (Exception $e) {
            Application::getInstance()
                ->logger(Application::LOGGER_ERROR)
                ->error("exec sql fail:{$this->sql},".$e->getMessage(),$this->options);

            if ($this->db->onErrorHandler()) {
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
     * @template T
     * @param string|static|T|null $objectClass
     * @return T|array|null
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
     * @return string|int|double|null
     * @throws Exception
     */
    public function fetchValue($name)
    {
        $statement = $this->getStatement();

        $data = $statement->fetch(PDO::FETCH_ASSOC);

        $statement->closeCursor();

        if (empty($data)) return null;

        return array_key_exists($name, $data) ? $data[$name] : null;
    }

    /**
     * 获取全部
     * @template T
     * @param string|static|T|null $objectClass
     * @return T[]
     * @throws Exception
     */
    public function fetchAll($objectClass = null): ?array
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
