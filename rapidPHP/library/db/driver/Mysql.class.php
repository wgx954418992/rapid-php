<?php

namespace rapidPHP\library\db\driver;


use PDO;
use rapid\library\rapid;
use rapidPHP\library\Db;
use rapidPHP\library\db\Driver;
use rapidPHP\library\StrCharacter;

class Mysql extends Driver
{


    public function __construct(Db &$db, $modelClass)
    {
        parent::__construct($db, $modelClass);
    }


    /**
     * 创建数据库
     * @param $dataBaseName
     * @return $this
     */
    public function createDataBase($dataBaseName)
    {
        $this->sql['query'] = "CREATE DATABASE `{$dataBaseName}` ";

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
            $values .= "`{$index}` {$value} ,";
        }

        $values = Str()->deleteStringLast($values);

        $this->sql['query'] = "CREATE TABLE `{$this->tableName}` ({$values}) ";

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
        $parameterStr = '';

        if (is_array($parameter)) {

            foreach ($parameter as $val) {
                $parameterStr .= "'{$val}',";
            }

        } else if (is_string($parameter)) {
            $parameterStr = $this->sql['func'] ? ",'{$parameter}'" : "'{$parameter}',";
        }

        if ($this->sql['func']) {
            $this->sql['func'] = preg_replace('#\)$#i', "{$parameterStr})", $this->sql['func']);
        } else {
            $parameterStr = Str()->deleteStringLast($parameterStr);

            $this->sql['func'] = "CALL `{$this->tableName}`({$parameterStr})";
        }
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

            $array['keys'] .= "`{$item}`,";

            if (substr($value, 0, 2) !== ':$') {
                $optionsKey = $this->getOptionsKey($item);

                $array['values'] .= ":{$optionsKey},";

                $this->addOptions($value, $optionsKey);
            } else {
                $array['values'] .= substr($value, 2) . ",";
            }
        }

        $array['keys'] = Str()->deleteStringLast($array['keys']);

        $array['values'] = Str()->deleteStringLast($array['values']);

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
                $setting .= "`{$index}`=:{$optionsKey},";

                $this->addOptions($value, $optionsKey);
            } else {
                $setting .= "`{$index}`=" . substr($value, 2) . ',';
            }
        }

        return Str()->deleteStringLast($setting);
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

        $column = is_array($column) ? Db::getTableColumn($this->tableName, $column, '`', '`') : $column;

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
     */
    public function join($table, $carrier, $on = [], $location = null)
    {
        $table = $this->getTableName($table);

        $this->sql['join'] .= " {$location} JOIN `{$table}` {$carrier} " . ($on ? ' ON ' : ' ');

        $this->sql['join'] .= join(" AND ", $on);

        return $this;
    }


    /**
     * LEFT JOIN
     * @param $table
     * @param $carrier
     * @param array $on
     * @return $this
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

        $this->where("`{$name}` {$parameterStr}");

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

        $parameterStr = Str()->deleteStringLast($parameterStr);

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
     */
    public function union($table, $column = null)
    {
        $tableName = $this->getTableName($table);

        $column = $this->getTableColumn($table, $column, '`', '`');

        $this->sql['select'] .= " UNION SELECT {$column} FROM `{$tableName}` ";

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
        $this->sql['query'] = "ALTER TABLE  ADD `{$this->tableName}` `{$fieldName}` $fieldType ";
        return $this;
    }


    /**
     * 删除表字段
     * @param $fieldName
     * @return $this
     */
    public function alterDropColumn($fieldName)
    {
        $this->sql['query'] = "ALTER TABLE ADD `{$this->tableName}` DROP COLUMN `{$fieldName}` ";
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
        $this->sql['query'] = "ALTER TABLE {$this->tableName} ALTER COLUMN `{$fieldName}` $fieldType ";

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
                    $this->sql['on'] = "ON `{$name}`{$expression}{$optionsKey} ";
                } else {
                    $this->sql['on'] .= "AND `{$name}`{$expression}{$optionsKey} ";
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
                    $this->sql['where'] = "WHERE `{$name}`{$expression}{$optionsKey} ";
                } else {
                    $this->sql['where'] .= "AND `{$name}`{$expression}{$optionsKey} ";
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
        $start = is_null($total) ? $page : ((int)$page) * ((int)$total) - ((int)$total);
        $this->sql['limit'] = "LIMIT $start" . (is_null($total) ? ' ' : ",$total ");
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
        $this->sql['query'] = "DROP {$type} `{$name}`";
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
        $this->where("`{$name}` IS NOT NULL ");
        return $this;
    }

    /**
     * isNull
     * @param $name
     * @return $this
     */
    public function isNull($name)
    {
        $this->where("`{$name}` IS NULL ");
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
     * getTablesTypeSql
     * @param int $type
     * @param string $database
     * @return array|null|string
     */
    private function getTablesTypeSql($type, $database)
    {
        $data = array(
            1 => "SELECT TABLE_NAME AS name,TABLE_COMMENT AS comment FROM information_schema.TABLES WHERE TABLE_SCHEMA='{$database}' AND TABLE_TYPE='BASE TABLE' ORDER BY name",
            2 => "SELECT TABLE_NAME AS name,TABLE_COMMENT AS comment FROM information_schema.TABLES WHERE TABLE_SCHEMA='{$database}' AND TABLE_TYPE='VIEW' ORDER BY name",
            3 => "SELECT name,comment FROM mysql.proc WHERE db='{$database}' ORDER BY name",
        );
        return B()->getData($data, $type);
    }

    /**
     * 获取全部表
     * @param int $type
     * @param string $database
     * @return $this
     */
    public function getTables($type, $database)
    {
        $this->sql['query'] = $this->getTablesTypeSql($type, $database);
        return $this;
    }

    /**
     * getTableStructureSql
     * @param $type
     * @param $tableName
     * @param string $database
     * @return array|null|string
     */
    public function getTableStructureSql($type, $database, $tableName)
    {
        $data = [
            1 => "SELECT COLUMN_NAME AS name,DATA_TYPE AS type,CHARACTER_MAXIMUM_LENGTH AS length,COLUMN_COMMENT AS `comment` FROM information_schema.COLUMNS WHERE TABLE_SCHEMA='{$database}' AND TABLE_NAME='{$tableName}'",
            2 => "SELECT COLUMN_NAME AS name,DATA_TYPE AS type,CHARACTER_MAXIMUM_LENGTH AS length,COLUMN_COMMENT AS `comment` FROM information_schema.COLUMNS WHERE TABLE_SCHEMA='{$database}' AND TABLE_NAME='{$tableName}'",
        ];
        return B()->getData($data, $type);
    }


    /**
     * getTableStructure
     * @param $type
     * @param string $database
     * @param $table
     * @return $this
     */
    public function getTableStructure($type, $database, $table)
    {
        $tableName = $this->getTableName($table);

        $this->sql['query'] = $this->getTableStructureSql($type, $database, $tableName);

        return $this;
    }

    /**
     * getTableStructureSql
     * @param $type
     * @param $tableName
     * @param string $database
     * @return array|null|string
     */
    public function getTableCreateSqlString($type, $database, $tableName)
    {
        $data = [
            1 => "show create table {$database}.{$tableName}",
            2 => "show create view {$database}.{$tableName}",
        ];

        return B()->getData($data, $type);
    }

    /**
     * getTableStructure
     * @param $type
     * @param string $database
     * @param $table
     * @return $this
     */
    public function getTableCreateSql($type, $database, $table)
    {
        $tableName = $this->getTableName($table);

        $this->sql['query'] = $this->getTableCreateSqlString($type, $database, $tableName);

        return $this;
    }
}
