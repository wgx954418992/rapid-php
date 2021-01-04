<?php

namespace rapidPHP\modules\database\sql\classier\driver;

use Exception;
use rapidPHP\modules\common\classier\Build;
use rapidPHP\modules\common\classier\StrCharacter;
use rapidPHP\modules\database\sql\classier\Driver;
use rapidPHP\modules\database\sql\classier\SQLDB;
use rapidPHP\modules\database\sql\classier\Utils;

class Mysql extends Driver
{

    /**
     * @var string
     */
    protected $joinString = '`';

    /**
     * Mysql constructor.
     * @param SQLDB $db
     * @param $tableName
     * @throws Exception
     */
    public function __construct(SQLDB $db, $tableName)
    {
        parent::__construct($db, $tableName);
    }


    /**
     * 执行存储过程
     * @param array $parameter
     * @param string $value
     * @return self|static|Driver
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
            $parameterStr = StrCharacter::getInstance()->deleteStringLast($parameterStr);

            $this->sql['func'] = "CALL `{$this->tableName}`({$parameterStr})";
        }
        return $this;
    }


    /**
     * 分页
     * @param $page
     * @param null $total
     * @return self|static|Driver
     */
    public function limit($page, $total = null)
    {
        $start = is_null($total) ? $page : ((int)$page) * ((int)$total) - ((int)$total);
        $this->sql['limit'] = "LIMIT $start" . (is_null($total) ? ' ' : ",$total ");
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
        return Build::getInstance()->getData($data, $type);
    }

    /**
     * 获取全部表
     * @param int $type
     * @param string $database
     * @return self|static|Driver
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
    public function getTableStructureSql($type, string $database, string $tableName)
    {
        $data = [
            1 => "SELECT COLUMN_NAME AS name,DATA_TYPE AS type,CHARACTER_MAXIMUM_LENGTH AS length,COLUMN_COMMENT AS `comment` FROM information_schema.COLUMNS WHERE TABLE_SCHEMA='{$database}' AND TABLE_NAME='{$tableName}'",
            2 => "SELECT COLUMN_NAME AS name,DATA_TYPE AS type,CHARACTER_MAXIMUM_LENGTH AS length,COLUMN_COMMENT AS `comment` FROM information_schema.COLUMNS WHERE TABLE_SCHEMA='{$database}' AND TABLE_NAME='{$tableName}'",
        ];
        return Build::getInstance()->getData($data, $type);
    }


    /**
     * getTableStructure
     * @param $type
     * @param string $database
     * @param $tableName
     * @return self|static|Driver
     * @throws Exception
     */
    public function getTableStructure($type, string $database, string $tableName)
    {
        $this->sql['query'] = $this->getTableStructureSql($type, $database, $tableName);

        return $this;
    }

    /**
     * getTableStructureSql
     * @param $type
     * @param string $database
     * @param $tableName
     * @return array|null|string
     */
    public function getTableCreateSqlString($type, string $database, string $tableName)
    {
        $data = [
            1 => "show create table `{$database}`.`{$tableName}`",
            2 => "show create view `{$database}`.`{$tableName}`",
        ];

        return Build::getInstance()->getData($data, $type);
    }

    /**
     * getTableStructure
     * @param $type
     * @param  $database
     * @param $tableName
     * @return self|static|Driver
     * @throws Exception
     */
    public function getTableCreateSql($type, string $database, string $tableName)
    {
        $this->sql['query'] = $this->getTableCreateSqlString($type, $database, $tableName);

        return $this;
    }
}
