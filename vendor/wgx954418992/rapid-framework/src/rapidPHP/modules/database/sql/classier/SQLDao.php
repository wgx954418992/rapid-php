<?php

namespace rapidPHP\modules\database\sql\classier;

use Exception;
use rapidPHP\modules\core\classier\Model;
use rapidPHP\modules\database\sql\classier\driver\Mysql;
use rapidPHP\modules\reflection\classier\Classify;

abstract class SQLDao
{

    /**
     * SQL DB 子类可以继承这个，如果要实现读写分类，主从分离，就继承不同的SQLDao
     * @var SQLDB
     */
    private $db;

    /**
     * 表名字
     * @var string
     */
    private $tableName;

    /**
     * @var array|string
     */
    private $tableField;

    /**
     * @var string|Model
     */
    private $modelOrClass;

    /**
     * SQLDao constructor.
     * @param SQLDB $db
     * @param $modelOrClass
     */
    public function __construct(SQLDB $db, $modelOrClass)
    {
        $this->db = $db;

        $this->modelOrClass = $modelOrClass;

        if (is_subclass_of($modelOrClass, Model::class)) {
            $this->tableName = $modelOrClass::NAME;

            $this->tableField = $this->getModelField($modelOrClass);
        } else {
            $this->tableField = '*';
        }
    }

    /**
     * @return SQLDB
     */
    public function getDb()
    {
        return $this->db;
    }

    /**
     * @return array|string
     */
    public function getTableField()
    {
        return $this->tableField;
    }

    /**
     * 获取model字段
     * @param $modelOrClass
     * @return array|string|null
     */
    public function getModelField($modelOrClass)
    {
        try {
            $classify = Classify::getInstance($modelOrClass);

            $tableField = $classify->getPropertiesNames();

            if (empty($this->tableField)) return '*';

            return $tableField;
        } catch (Exception $e) {
            return '*';
        }
    }

    /**
     * @return Model|string
     */
    public function getModelOrClass()
    {
        return $this->modelOrClass;
    }

    /**
     * @return string
     */
    public function getTableName(): string
    {
        return $this->tableName;
    }

    /**
     * 获取驱动
     * @return Driver|Mysql
     * @throws Exception
     */
    public function getDriver()
    {
        return $this->db->table($this->getTableName());
    }

    /**
     * @param $id
     * @return string
     */
    public function getRId($id): string
    {
        return (static::class . $id);
    }

    /**
     * 查询
     * @param null $column
     * @return Driver|Mysql
     * @throws Exception
     */
    public function get($column = null)
    {
        return $this->getDriver()
            ->resetSql()
            ->select(!$column ? $this->getTableField() : $column);
    }

    /**
     * 添加
     * @param $data
     * @param int $insertId
     * @return bool
     * @throws Exception
     */
    public function add($data, &$insertId = -1): bool
    {
        return $this->getDriver()
            ->resetSql()
            ->insert($data)
            ->execute($insertId);
    }

    /**
     * 修改
     * @param $data
     * @return Driver|Mysql
     * @throws Exception
     */
    public function set($data)
    {
        return $this->getDriver()
            ->resetSql()
            ->update($data);
    }

    /**
     * 删除
     * @return Driver|Mysql
     * @throws Exception
     */
    public function del()
    {
        return $this->getDriver()
            ->resetSql()
            ->delete();
    }

    /**
     * count
     * @param string $name
     * @return Driver|Mysql
     * @throws Exception
     */
    public function count($name = '*')
    {
        return $this->getDriver()
            ->resetSql()
            ->select("count({$name}) as count");
    }

    /**
     * sum
     * @param string $name
     * @return Driver|Mysql
     * @throws Exception
     */
    public function sum($name = '*')
    {
        return $this->getDriver()
            ->resetSql()
            ->select("sum({$name}) as sum");
    }

    /**
     * max
     * @param string $name
     * @return Driver|Mysql
     * @throws Exception
     */
    public function max($name = '*')
    {
        return $this->getDriver()
            ->resetSql()
            ->select("max({$name}) as max");
    }

    /**
     * min
     * @param string $name
     * @return Driver|Mysql
     * @throws Exception
     */
    public function min($name = '*')
    {
        return $this->getDriver()
            ->resetSql()
            ->select("min({$name}) as min");
    }
}