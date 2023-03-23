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
     * join string
     * `id`
     * @return string
     */
    public function getJS(): string
    {
        return '`';
    }

    /**
     * 分页
     * @param $page
     * @param $total
     * @return self|static|Driver
     */
    public function limit($page, $total = null)
    {
        $start = is_null($total) ? $page : ((int)$page) * ((int)$total) - ((int)$total);

        $this->sql['limit'] = "LIMIT $start" . (is_null($total) ? ' ' : ",$total ");

        return $this;
    }

    /**
     * 获取全部表
     * @param int $type
     * @param string $database
     * @return self|static|Driver
     * @throws Exception
     */
    public function getTables(int $type, string $database)
    {
        $typeSqls = [
            1 => "SELECT TABLE_NAME AS name,TABLE_COMMENT AS comment FROM information_schema.TABLES WHERE TABLE_SCHEMA='{$database}' AND TABLE_TYPE='BASE TABLE' ORDER BY name",
            2 => "SELECT TABLE_NAME AS name,TABLE_COMMENT AS comment FROM information_schema.TABLES WHERE TABLE_SCHEMA='{$database}' AND TABLE_TYPE='VIEW' ORDER BY name",
            3 => "SELECT name,comment FROM mysql.proc WHERE db='{$database}' ORDER BY name",
        ];

        if (!isset($typeSqls[$type])) throw new Exception('type error!');

        $this->query($typeSqls[$type]);

        return $this;
    }

    /**
     * getTableStructure
     * @param $type
     * @param string $database
     * @param string $table
     * @return self|static|Driver
     * @throws Exception
     */
    public function getTableStructure($type, string $database, string $table)
    {
        $this->query('SELECT COLUMN_NAME AS name,DATA_TYPE AS type,CHARACTER_MAXIMUM_LENGTH AS length,COLUMN_COMMENT AS `comment` FROM information_schema.COLUMNS')
            ->where('TABLE_SCHEMA', $database)
            ->where('TABLE_NAME', $table)
            ->order('ORDINAL_POSITION', 'ASC');

        return $this;
    }

    /**
     * getTableStructure
     * @param $type
     * @param string $database
     * @param string $tableName
     * @return self|static|Driver
     * @throws Exception
     */
    public function getTableCreateSql($type, string $database, string $tableName)
    {
        $types = [1 => 'TABLE', 2 => 'VIEW'];

        if (!isset($types[$type])) throw new Exception('type error!');

        $this->query("SHOW CREATE {$types[$type]} " . $this->format($database) . '.' . $this->format($tableName));

        return $this;
    }
}
