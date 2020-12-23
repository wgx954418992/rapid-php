<?php

namespace rapidPHP\modules\database\sql\classier;

use Exception;
use rapidPHP\modules\common\classier\StrCharacter;
use rapidPHP\modules\database\sql\classier\driver\Mysql;
use rapidPHP\modules\database\sql\config\SqlConfig;

abstract class Driver
{

    /**
     * 连接对象
     * @var SQLDB
     */
    private $db;

    /**
     * 表名
     * @var mixed|null
     */
    protected $tableName = null;

    /**
     * 预先执行参数
     * @var array
     */
    protected $options = [];

    /**
     * sql语句
     * ->defaultSql
     * @var array
     */
    protected $sql;

    /**
     * `id`
     * @var string
     */
    protected $joinString = '';

    /**
     * Driver constructor.
     * @param SQLDB $db
     * @param null $tableName
     * @throws Exception
     */
    public function __construct(SQLDB $db, $tableName)
    {
        $this->db = $db;

        $this->sql = SqlConfig::SQL_LIST;

        $this->tableName = Utils::getInstance()->formatColumn($tableName, $this->joinString);
    }

    /**
     * @return mixed|null
     */
    public function getTableName()
    {
        return $this->tableName;
    }

    /**
     * @return string
     */
    public function getJoinString(): string
    {
        return $this->joinString;
    }

    /**
     * 重置sql语句
     * @param null $name
     * @return self|static|Mysql
     */
    public function resetSql($name = null)
    {
        if (is_null($name)) {
            $this->sql = SqlConfig::SQL_LIST;
        } else if (isset($this->sql[$name])) {
            $this->sql[$name] = null;
        }
        return $this;
    }

    /**
     * 获取别的driver sql
     * @param $callOrDriver
     * @param bool $isMergeOptions
     * @return self|static|Mysql|string|string[]
     */
    private function getDriverSql($callOrDriver, $isMergeOptions = true, &$tableName = null)
    {
        if (is_callable($callOrDriver)) {
            $driver = call_user_func($callOrDriver, $this);
        } else {
            $driver = $callOrDriver;
        }

        if (!($driver instanceof Driver)) return null;

        $tableName = $driver->getTableName();

        $sql = $driver->getSql();

        $options = $driver->getOptions();

        foreach ($options as $name => $value) {
            $key = $this->getOptionsKey($name);

            $name = ":{$name}";

            $position = strpos($sql, $name);

            if (is_int($position)) {
                $sql = substr_replace($sql, ':' . $key, $position, strlen($name));

                if ($isMergeOptions) $this->addOptions($value, $key);
            }
        }

        return $sql;
    }

    /**
     * 创建数据库
     * @param $dataBaseName
     * @return self|static|Mysql
     */
    public function createDataBase($dataBaseName)
    {
        $this->sql['query'] = "CREATE DATABASE " . Utils::getInstance()->formatColumn($dataBaseName, $this->joinString) . ' ';

        return $this;
    }

    /**
     * 创建表单
     * @param array $column
     * @return self|static|Mysql
     */
    public function createTable(array $column = [])
    {
        $values = '';

        foreach ($column as $name => $value) {
            $name = Utils::getInstance()->formatColumn($name, $this->joinString);

            $values .= "{$name} {$value} ,";
        }

        $values = StrCharacter::getInstance()->deleteStringLast($values);

        $this->sql['query'] = "CREATE TABLE {$this->tableName} ({$values}) ";

        return $this;
    }


    /**
     * 执行存储过程
     * @param array $parameter
     * @param string $value
     * @return self|static|Mysql
     */
    public function func($parameter = [], $value = '')
    {
        return $this;
    }


    /**
     * 写到数据
     * @param $data
     * @return self|static|Mysql
     */
    public function insert($data)
    {
        $data = $this->makeInsertData($data);

        $this->sql['insert'] = "INSERT INTO {$this->tableName} ({$data['keys']}) VALUES ({$data['values']}) ";

        return $this;
    }


    /**
     * 生成写入数据
     * @param $data
     * @return array
     */
    private function makeInsertData($data)
    {
        $array = ['keys' => '', 'values' => ''];

        foreach ($data as $item => $value) {
            if (is_null($value)) continue;

            $array['keys'] .= Utils::getInstance()->formatColumn($item, $this->joinString) . ",";

            if (substr($value, 0, 2) !== ':$') {
                $optionsKey = $this->getOptionsKey($item);

                $array['values'] .= ":{$optionsKey},";

                $this->addOptions($value, $optionsKey);
            } else {
                $array['values'] .= substr($value, 2) . ",";
            }
        }

        $array['keys'] = StrCharacter::getInstance()->deleteStringLast($array['keys']);

        $array['values'] = StrCharacter::getInstance()->deleteStringLast($array['values']);

        return $array;
    }


    /**
     * 修改
     * @param array $data
     * @return self|static|Mysql
     */
    public function update(array $data)
    {
        $this->sql['update'] = "UPDATE {$this->tableName} SET " . $this->makeUpdateData($data);

        return $this;
    }

    /**
     * 生成update数据
     * @param array $data
     * @return string
     */
    private function makeUpdateData(array $data)
    {
        $setting = '';

        foreach ($data as $name => $value) {
            if (is_callable($value) || $value instanceof Driver) {
                $name = Utils::getInstance()->formatColumn($name, $this->joinString);

                $setting .= "{$name}=({$this->getDriverSql($value)}),";
            } else {
                $optionsKey = $this->getOptionsKey($name);

                $name = Utils::getInstance()->formatColumn($name, $this->joinString);

                if (substr($value, 0, 2) !== ':$') {

                    $setting .= "{$name}=:{$optionsKey},";

                    $this->addOptions($value, $optionsKey);
                } else {
                    $setting .= "{$name}=" . substr($value, 2) . ',';
                }
            }
        }

        return StrCharacter::getInstance()->deleteStringLast($setting);
    }


    /**
     * 删除
     * @param null $callOrDriver
     * @return self|static|Mysql
     */
    public function delete($callOrDriver = null)
    {
        $this->sql['delete'] = "DELETE FROM";

        if ($callOrDriver) {
            $this->sql['delete'] .= " ({$this->getDriverSql($callOrDriver)}) ";
        } else {
            $this->sql['delete'] .= " {$this->tableName} ";
        }

        return $this;
    }


    /**
     * 查询
     * @param null $column
     * @param null $callOrDriver
     * @return self|static|Mysql
     */
    public function select($column, $callOrDriver = null)
    {
        if ($column && is_array($column)) {
            $column = Utils::getInstance()->formatColumn(join(',', $column), $this->joinString);
        }

        $this->sql['select'] .= "SELECT {$column} FROM";

        if ($callOrDriver) {
            $this->sql['select'] .= " ({$this->getDriverSql($callOrDriver)}) ";
        } else {
            $this->sql['select'] .= " {$this->tableName} ";
        }

        return $this;
    }


    /**
     * 设置查询载体
     * @param $carrier
     * @return self|static|Mysql
     */
    public function setCarrier($carrier)
    {
        $this->sql['select'] .= ' ' . Utils::getInstance()->formatColumn($carrier) . ' ';

        return $this;
    }


    /**
     * alias
     * @param $carrier
     * @return self|static|Mysql
     */
    public function alias($carrier)
    {
        $this->sql['select'] .= " AS " . Utils::getInstance()->formatColumn($carrier) . ' ';

        return $this;
    }


    /**
     * JOIN
     * @param $tableName
     * @param $callOrDriver
     * @param null $location
     * @return self|static|Mysql
     */
    public function join($tableName, $callOrDriver = null, $location = null)
    {
        $drivetSql = '';

        if ($tableName instanceof Driver) {
            $callOrDriver = $tableName;

            $drivetSql = $this->getDriverSql($callOrDriver);

            $tableName = $callOrDriver->getTableName();
        } else if (is_callable($tableName)) {
            $callOrDriver = $tableName;

            $drivetSql = $this->getDriverSql($callOrDriver, true, $tableName);
        } else {
            $tableName = Utils::getInstance()->formatColumn($tableName, $this->joinString);
        }

        $currentSql = $this->getSql();

        $this->resetSql();

        $this->sql['join'] = "{$currentSql} {$location} JOIN {$tableName}{$drivetSql}";

        return $this;
    }


    /**
     * LEFT JOIN
     * @param $tableName
     * @param $callOrDriver
     * @return self|static|Mysql
     */
    public function leftJoin($tableName, $callOrDriver = null)
    {
        $this->join($tableName, $callOrDriver, 'LEFT');

        return $this;
    }

    /**
     * LEFT JOIN
     * @param $tableName
     * @param $callOrDriver
     * @return self|static|Mysql
     */
    public function rightJoin($tableName, $callOrDriver = null)
    {
        $this->join($tableName, $callOrDriver, 'right');

        return $this;
    }

    /**
     * INNER JOIN
     * @param $tableName
     * @param $callOrDriver
     * @return self|static|Mysql
     */
    public function innerJoin($tableName, $callOrDriver = null)
    {
        $this->join($tableName, $callOrDriver, 'INNER');

        return $this;
    }

    /**
     * FULL  JOIN
     * @param $tableName :表
     * @param $callOrDriver
     * @return self|static|Mysql
     */
    public function fullJoin($tableName, $callOrDriver = null)
    {
        $this->join($tableName, $callOrDriver, 'FULL');

        return $this;
    }


    /**
     * IN
     * @param $name :字段名
     * @param $parameter :参数
     * @param null $match :not
     * @return self|static|Mysql
     */
    public function in($name, $parameter, $match = null)
    {
        $parameter = is_array($parameter) ? $parameter : explode(' ', $parameter);

        $parameterStr = $this->makeInData($name, $parameter, $match);

        $name = Utils::getInstance()->formatColumn($name);

        $this->where("{$name} {$parameterStr}");

        return $this;
    }

    /**
     * 生成in数据
     * @param $name
     * @param $parameter
     * @param null $match
     * @return string
     */
    private function makeInData($name, $parameter, $match = null)
    {
        $parameterStr = "{$match} IN (";

        if (empty($parameter)) return $parameterStr . ")";

        foreach ($parameter as $value) {

            $optionsKey = $this->getOptionsKey($name);

            $parameterStr .= ":{$optionsKey},";

            $this->addOptions($value, $optionsKey);
        }

        $parameterStr = StrCharacter::getInstance()->deleteStringLast($parameterStr);

        return $parameterStr . ")";
    }


    /**
     * not in
     * @param $name :字段名
     * @param $parameter :参数
     * @return self|static|Mysql
     */
    public function notIn($name, $parameter)
    {
        $this->in($name, $parameter, 'NOT');

        return $this;
    }

    /**
     * union
     * @param $callOrDriver
     * @param string $param
     * @return self|static|Mysql
     */
    public function union($callOrDriver, $param = '')
    {
        $currentSql = $this->getSql();

        $this->resetSql();

        if (empty($currentSql)) {
            $this->sql['select'] = " UNION {$param} {$this->getDriverSql($callOrDriver)} ";
        } else {
            $this->sql['select'] = "({$currentSql}) UNION {$param} ({$this->getDriverSql($callOrDriver)})";
        }

        return $this;
    }


    /**
     * 给表添加字段
     * @param $fieldName
     * @param $fieldType
     * @return self|static|Mysql
     */
    public function alterAdd($fieldName, $fieldType)
    {
        $fieldName = Utils::getInstance()->formatColumn($fieldName, $this->joinString);

        $this->sql['query'] = "ALTER TABLE  ADD {$this->tableName} {$fieldName} $fieldType ";

        return $this;
    }


    /**
     * 删除表字段
     * @param $fieldName
     * @return self|static|Mysql
     */
    public function alterDropColumn($fieldName)
    {
        $fieldName = Utils::getInstance()->formatColumn($fieldName, $this->joinString);

        $this->sql['query'] = "ALTER TABLE ADD {$this->tableName} DROP COLUMN {$fieldName} ";

        return $this;
    }


    /**
     * 修改表字段
     * @param $fieldName
     * @param $fieldType
     * @return self|static|Mysql
     */
    public function alterModify($fieldName, $fieldType)
    {
        $fieldName = Utils::getInstance()->formatColumn($fieldName, $this->joinString);

        $this->sql['query'] = "ALTER TABLE {$this->tableName} ALTER COLUMN {$fieldName} $fieldType ";

        return $this;
    }

    /**
     * on
     * @param $name
     * @param null $values
     * @param string $expression
     * @return self|static|Mysql
     */
    public function on($name, $values = null, $expression = '=:')
    {
        if (!is_null($name)) {
            if (is_null($values)) {
                if (!$this->sql['on']) {
                    $this->sql['on'] = "ON {$name} ";
                } else {
                    $this->sql['on'] .= "AND {$name} ";
                }
            } else {
                $optionsKey = $this->getOptionsKey($name);

                $name = Utils::getInstance()->formatColumn($name, $this->joinString);

                if (!$this->sql['on']) {
                    $this->sql['on'] = "ON {$name}{$expression}{$optionsKey} ";
                } else {
                    $this->sql['on'] .= "AND {$name}{$expression}{$optionsKey} ";
                }
                $this->addOptions($values, $optionsKey);
            }
        }
        return $this;
    }


    /**
     * 条件
     * @param $name
     * @param $values
     * @param string $expression
     * @return self|static|Mysql
     */
    public function where($name, $values = null, $expression = '=:')
    {
        if (!is_null($name)) {
            if (is_null($values)) {
                if (!$this->sql['where']) {
                    $this->sql['where'] = "WHERE {$name} ";
                } else {
                    $this->sql['where'] .= "AND {$name} ";
                }
            } else {
                $optionsKey = $this->getOptionsKey($name);

                $name = Utils::getInstance()->formatColumn($name, $this->joinString);

                if (!$this->sql['where']) {
                    $this->sql['where'] = "WHERE {$name}{$expression}{$optionsKey} ";
                } else {

                    $this->sql['where'] .= "AND {$name}{$expression}{$optionsKey} ";
                }
                $this->addOptions($values, $optionsKey);
            }
        }
        return $this;
    }


    /**
     * 排序
     * @param $column
     * @param string $mode
     * @return self|static|Mysql
     */
    public function order($column, $mode = 'ASC')
    {
        $this->sql['order'] = "ORDER BY {$column} {$mode} ";
        return $this;
    }


    /**
     * 分组
     * @param $column
     * @return self|static|Mysql
     */
    public function group($column)
    {
        $this->sql['group'] = "GROUP BY {$column} ";
        return $this;
    }

    /**
     * 分页
     * @param $page
     * @param null $total
     * @return self|static|Mysql
     */
    public function limit($page, $total = null)
    {
        return $this;
    }


    /**
     * drop
     * @param string $name
     * @param string $type
     * @return self|static|Mysql
     */
    public function drop($name = '', $type = 'TABLE')
    {
        $name = $name ? $name : $this->tableName;

        $this->sql['query'] = "DROP {$type} {$name}";

        return $this;
    }


    /**
     * dropTable
     * @return self|static|Mysql
     */
    public function dropTable()
    {
        $this->drop($this->tableName, 'TABLE');

        return $this;
    }

    /**
     * dropDatabase
     * @param $database
     * @return self|static|Mysql
     */
    public function dropDatabase($database)
    {
        $database = Utils::getInstance()->formatColumn($database, $this->joinString);

        $this->drop($database, 'DATABASE');

        return $this;
    }

    /**
     * isNotNull
     * @param $name
     * @return self|static|Mysql
     */
    public function isNotNull($name)
    {
        $name = Utils::getInstance()->formatColumn($name, $this->joinString);

        $this->where("{$name} IS NOT NULL ");

        return $this;
    }

    /**
     * isNull
     * @param $name
     * @return self|static|Mysql
     */
    public function isNull($name)
    {
        $name = Utils::getInstance()->formatColumn($name, $this->joinString);

        $this->where("{$name} IS NULL ");

        return $this;
    }


    /**
     * 模糊查询
     * @param $name
     * @param $value
     * @param int $expression
     * @return self|static|Mysql
     */
    public function like($name, $value, $expression = 3)
    {
        switch ($expression) {
            case 1:
                $expressionStr = "$value%";
                break;
            case 2:
                $expressionStr = "%$value";
                break;
            case 3:
                $expressionStr = "%$value%";
                break;
            default:
                $expressionStr = "$value";
        }

        $this->where($name, $expressionStr, ' LIKE :');

        return $this;
    }


    /**
     * having
     * @param $having
     * @return self|static|Mysql
     */
    public function having($having)
    {
        $this->sql['having'] .= " HAVING $having ";
        return $this;
    }


    /**
     * for update
     * @return $this
     */
    public function forUpdate()
    {
        $this->sql['select'] .= " for update ";
        return $this;
    }

    /**
     * getTables
     * @param $type
     * @param $database
     * @return static|Mysql
     */
    abstract public function getTables($type, string $database);


    /**
     * getTableStructure
     * @param $type
     * @param string $database
     * @param string $table
     * @return static|Mysql
     */
    abstract public function getTableStructure($type, string $database, string $table);

    /**
     * 获取创建sql
     * @param $type
     * @param string $database
     * @param string $tableName
     * @return static|Mysql
     */
    abstract public function getTableCreateSql($type, string $database, string $tableName);


    /**
     * 获取语句
     * @return string
     */
    public function getSql(): string
    {
        return str_replace('  ', ' ', join(' ', $this->sql));
    }

    /**
     * 获取语句
     * @return string
     */
    public function print(): string
    {
        $sql = $this->getSql();

        $options = $this->getOptions();

        foreach ($options as $name => $value) {
            if (!is_numeric($value)) $value = "'{$value}'";

            $name = ":{$name}";

            $position = strpos($sql, $name);

            if (is_int($position)) {
                $sql = substr_replace($sql, $value, $position, strlen($name));
            }
        }

        return $sql;
    }


    /**
     * 获取预先执行参数
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }


    /**
     * 生成OptionsKey，防止多个键重复
     * @param $name
     * @return string
     */
    public function getOptionsKey($name): string
    {
        $name = str_replace(['.', '='], '_', $name);

        return $name . count($this->getOptions());
    }

    /**
     * 添加options
     * @param $value
     * @param null $key
     * @return static|Mysql
     */
    public function addOptions($value, $key = null)
    {
        $key ? $this->options[$key] = $value : $this->options[] = $value;

        return $this;
    }

    /**
     * @return Statement
     */
    public function getStatement()
    {
        $statement = $this->db->query($this->getSql());

        $statement->setOptions($this->getOptions());

        return $statement;
    }

    /**
     * 除过select都用这个执行
     * @param int $insetId
     * @return bool
     * @throws Exception
     */
    public function execute(&$insetId = -1): bool
    {
        $statement = $this->getStatement();

        $result = $statement->execute();

        if ($result && $insetId !== -1) $insetId = $this->db->getConnect()->lastInsertId();

        return $result;
    }
}

