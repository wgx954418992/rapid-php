<?php

namespace rapidPHP\modules\database\sql\classier;

use Exception;
use rapidPHP\modules\common\classier\StrCharacter;
use rapidPHP\modules\database\sql\config\SqlConfig;

abstract class Driver
{

    /**
     * 连接对象
     * @var SqlDB
     */
    private $db;

    /**
     * 对应的model
     * @var string
     */
    protected $model = null;

    /**
     * 表名
     * @var mixed|null
     */
    protected $tableName = null;

    /**
     * 字段
     * @var mixed|null
     */
    protected $tableColumn = null;

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
     * @param SqlDB $db
     * @param null $model
     * @throws Exception
     */
    public function __construct(SqlDB $db, $model = null)
    {
        $this->db = $db;

        $this->sql = SqlConfig::SQL_LIST;

        $this->model = $model;

        $this->tableName = Utils::getInstance()->getTableName($model);

        $this->tableColumn = Utils::getInstance()->getTableColumn($model);
    }

    /**
     * 重置sql语句
     * @param null $name
     * @return $this
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
     * 创建数据库
     * @param $dataBaseName
     * @return $this
     */
    public function createDataBase($dataBaseName)
    {
        $this->sql['query'] = "CREATE DATABASE {$this->joinString}{$dataBaseName}{$this->joinString} ";

        return $this;
    }

    /**
     * 创建表单
     * @param array $column
     * @return $this
     */
    public function createTable(array $column = [])
    {
        $values = '';

        $column = $column ? $column : isset($this->tableColumn) ? $this->tableColumn : [];

        foreach ($column as $index => $value) {
            $values .= "{$this->joinString}{$index}{$this->joinString} {$value} ,";
        }

        $values = StrCharacter::getInstance()->deleteStringLast($values);

        $this->sql['query'] = "CREATE TABLE {$this->joinString}{$this->tableName}{$this->joinString} ({$values}) ";

        return $this;
    }


    /**
     * 执行存储过程
     * @param array $parameter
     * @param string $value
     * @return $this
     */
    public function func($parameter = [], $value = '')
    {
        return $this;
    }


    /**
     * 写到数据
     * @param $data
     * @return $this
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

            $array['keys'] .= "{$this->joinString}{$item}{$this->joinString},";

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
     * @return $this
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

        foreach ($data as $index => $value) {
            $optionsKey = $this->getOptionsKey($index);

            if (substr($value, 0, 2) !== ':$') {
                $setting .= "{$this->joinString}{$index}{$this->joinString}=:{$optionsKey},";

                $this->addOptions($value, $optionsKey);
            } else {
                $setting .= "{$this->joinString}{$index}{$this->joinString}=" . substr($value, 2) . ',';
            }
        }

        return StrCharacter::getInstance()->deleteStringLast($setting);
    }


    /**
     * 删除
     * @return $this
     */
    public function delete()
    {
        $this->sql['delete'] = "DELETE FROM {$this->tableName} ";

        return $this;
    }


    /**
     * 查询
     * @param null $column
     * @return $this
     */
    public function select($column = null)
    {
        if (empty($column)) $column = $this->tableColumn;

        $column = is_array($column) ? Utils::getInstance()->getTableColumn($this->tableName, $column, $this->joinString, $this->joinString) : $column;

        $this->sql['select'] .= "SELECT {$column} FROM {$this->tableName} ";

        return $this;
    }


    /**
     * 设置查询载体
     * @param $carrier
     * @return $this
     */
    public function setCarrier($carrier)
    {
        $this->sql['select'] .= " {$carrier} ";

        return $this;
    }


    /**
     * alias
     * @param $carrier
     * @return $this
     */
    public function alias($carrier)
    {
        $this->sql['select'] .= " AS {$carrier} ";

        return $this;
    }

    /**
     * JOIN
     * @param $table
     * @param $carrier
     * @param array $on
     * @param null $location
     * @return $this
     * @throws Exception
     */
    public function join($table, $carrier, $on = [], $location = null)
    {
        $table = Utils::getInstance()->getTableName($table);

        $this->sql['join'] .= " {$location} JOIN {$this->joinString}{$table}{$this->joinString} {$carrier} " . ($on ? ' ON ' : ' ');

        $this->sql['join'] .= join(" AND ", $on);

        return $this;
    }


    /**
     * LEFT JOIN
     * @param $table
     * @param $carrier
     * @param array $on
     * @return $this
     * @throws Exception
     */
    public function leftJoin($table, $carrier, $on = [])
    {
        $this->join($table, $carrier, $on, 'LEFT');

        return $this;
    }

    /**
     * LEFT JOIN
     * @param $table
     * @param $carrier
     * @param array $on
     * @return $this
     * @throws Exception
     */
    public function rightJoin($table, $carrier, $on = [])
    {
        $this->join($table, $carrier, $on, 'RIGHT');

        return $this;
    }

    /**
     * INNER JOIN
     * @param $table :表
     * @param $carrier :载体
     * @param array $on :条件
     * @return $this
     * @throws Exception
     */
    public function innerJoin($table, $carrier, $on = [])
    {
        $this->join($table, $carrier, $on, 'INNER');

        return $this;
    }

    /**
     * FULL  JOIN
     * @param $table :表
     * @param $carrier :载体
     * @param array $on :条件
     * @return $this
     * @throws Exception
     */
    public function fullJoin($table, $carrier, $on = [])
    {
        $this->join($table, $carrier, $on, 'FULL');

        return $this;
    }


    /**
     * IN
     * @param $name :字段名
     * @param $parameter :参数
     * @param null $match :not
     * @return $this
     */
    public function in($name, $parameter, $match = null)
    {
        $parameter = is_array($parameter) ? $parameter : explode(' ', $parameter);

        $parameterStr = $this->makeInData($name, $parameter, $match);

        $this->where("{$this->joinString}{$name}{$this->joinString} {$parameterStr}");

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
     * @return $this
     */
    public function notIn($name, $parameter)
    {
        $this->in($name, $parameter, 'NOT');

        return $this;
    }


    /**
     * union
     * @param $table
     * @param null $column
     * @return $this
     * @throws Exception
     */
    public function union($table, $column = null)
    {
        $tableName = Utils::getInstance()->getTableName($table);

        $column = Utils::getInstance()->getTableColumn($table, $column, $this->joinString, $this->joinString);

        $this->sql['select'] .= " UNION SELECT {$column} FROM {$this->joinString}{$tableName}{$this->joinString} ";

        return $this;
    }


    /**
     * 给表添加字段
     * @param $fieldName
     * @param $fieldType
     * @return $this
     */
    public function alterAdd($fieldName, $fieldType)
    {
        $this->sql['query'] = "ALTER TABLE  ADD {$this->joinString}{$this->tableName}{$this->joinString} {$this->joinString}{$fieldName}{$this->joinString} $fieldType ";
        return $this;
    }


    /**
     * 删除表字段
     * @param $fieldName
     * @return $this
     */
    public function alterDropColumn($fieldName)
    {
        $this->sql['query'] = "ALTER TABLE ADD {$this->joinString}{$this->tableName}{$this->joinString} DROP COLUMN {$this->joinString}{$fieldName}{$this->joinString} ";
        return $this;
    }


    /**
     * 修改表字段
     * @param $fieldName
     * @param $fieldType
     * @return $this
     */
    public function alterModify($fieldName, $fieldType)
    {
        $this->sql['query'] = "ALTER TABLE {$this->tableName} ALTER COLUMN {$this->joinString}{$fieldName}{$this->joinString} $fieldType ";

        return $this;
    }

    /**
     * on
     * @param $name
     * @param null $values
     * @param string $expression
     * @return $this
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
                if (!$this->sql['on']) {
                    $this->sql['on'] = "ON {$this->joinString}{$name}{$this->joinString}{$expression}{$optionsKey} ";
                } else {
                    $this->sql['on'] .= "AND {$this->joinString}{$name}{$this->joinString}{$expression}{$optionsKey} ";
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
     * @return $this
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
                if (!$this->sql['where']) {
                    $this->sql['where'] = "WHERE {$this->joinString}{$name}{$this->joinString}{$expression}{$optionsKey} ";
                } else {
                    $this->sql['where'] .= "AND {$this->joinString}{$name}{$this->joinString}{$expression}{$optionsKey} ";
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
     * @return $this
     */
    public function order($column, $mode = 'ASC')
    {
        $this->sql['order'] = "ORDER BY {$column} {$mode} ";
        return $this;
    }


    /**
     * 分组
     * @param $column
     * @return $this
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
     * @return $this
     */
    public function limit($page, $total = null)
    {
        return $this;
    }


    /**
     * drop
     * @param string $name
     * @param string $type
     * @return $this
     */
    public function drop($name = '', $type = 'TABLE')
    {
        $name = $name ? $name : $this->tableName;
        $this->sql['query'] = "DROP {$type} {$this->joinString}{$name}{$this->joinString}";
        return $this;
    }


    /**
     * dropTable
     * @return $this
     */
    public function dropTable()
    {
        $this->drop($this->tableName, 'TABLE');
        return $this;
    }

    /**
     * dropDatabase
     * @param $database
     * @return $this
     */
    public function dropDatabase($database)
    {
        $this->drop($database, 'DATABASE');
        return $this;
    }

    /**
     * isNotNull
     * @param $name
     * @return $this
     */
    public function isNotNull($name)
    {
        $this->where("{$this->joinString}{$name}{$this->joinString} IS NOT NULL ");
        return $this;
    }

    /**
     * isNull
     * @param $name
     * @return $this
     */
    public function isNull($name)
    {
        $this->where("{$this->joinString}{$name}{$this->joinString} IS NULL ");
        return $this;
    }


    /**
     * 模糊查询
     * @param $name
     * @param $value
     * @param int $expression
     * @return $this
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
     * @return $this
     */
    public function having($having)
    {
        $this->sql['having'] .= " HAVING $having ";
        return $this;
    }


    /**
     * getTables
     * @param $type
     * @param $database
     * @return Driver
     */
    abstract public function getTables($type, $database);


    /**
     * getTableStructure
     * @param $type
     * @param $database
     * @param $table
     * @return Driver
     */
    abstract public function getTableStructure($type, $database, $table);

    /**
     * 获取创建sql
     * @param $type
     * @param $database
     * @param $table
     * @return Driver
     */
    abstract public function getTableCreateSql($type, $database, $table);


    /**
     * 获取语句
     * @return string
     */
    public function getSql()
    {
        return join(' ', $this->sql);
    }

    /**
     * 获取语句
     * @return string
     */
    public function print()
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
     * @param $options
     * @return array
     */
    public function getOptions($options = [])
    {
        return $options ? $options : $this->options;
    }


    /**
     * 生成OptionsKey，防止多个键重复
     * @param $name
     * @return string
     */
    public function getOptionsKey($name)
    {
        return $name . count($this->getOptions());
    }


    /**
     * 添加options
     * @param $value
     * @param null $key
     * @return Driver
     */
    public function addOptions($value, $key = null)
    {
        $key ? $this->options[$key] = $value : $this->options[] = $value;
        return $this;
    }

    /**
     * 除过select都用这个执行
     * @param array $options
     * @param $insetId
     * @return bool
     */
    public function execute(array $options = [], &$insetId = -1)
    {
        $options = $this->getOptions($options);

        $exec = new Exec($this->db, $this->getSql());

        $result = $exec->execute($options);

        if ($result && $insetId !== -1) $insetId = $this->db->getConnect()->lastInsertId();

        return $result;
    }

    /**
     * select用这个执行
     * @param array $options
     * @param int $mode
     * @return Result
     */
    public function get(array $options = [], $mode = 2)
    {
        $options = $this->getOptions($options);

        $exec = new Exec($this->db, $this->getSql());

        return $exec->get($this->model, $options, $mode);
    }

}

