<?php

namespace rapidPHP\modules\database\sql\classier;

use Exception;

class SqlDao
{
    /**
     * @var SqlDB
     */
    private $sqlDb;

    /**
     * @var
     */
    private $model;

    /**
     * SqlDao constructor.
     * @param $model
     * @param SqlDB|null $sqlDb
     */
    public function __construct($model, ?SqlDB $sqlDb = null)
    {
        $this->model = $model;
        $this->sqlDb = $sqlDb;
    }

    /**
     * @return SqlDB
     */
    public function getSqlDb(): SqlDB
    {
        return $this->sqlDb;
    }

    /**
     * @param SqlDB $sqlDb
     */
    public function setSqlDb(SqlDB $sqlDb): void
    {
        $this->sqlDb = $sqlDb;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param mixed $model
     */
    public function setModel($model): void
    {
        $this->model = $model;
    }

    /**
     * @param $id
     * @return string
     */
    public function getRId($id)
    {
        return (get_class($this) . $id);
    }

    /**
     * 获取db驱动
     * @return Driver
     * @throws Exception
     */
    public function getDriver()
    {
        return $this->getSqlDb()->table($this->model);
    }

    /**
     * 查询
     * @param null $column
     * @return Driver
     * @throws Exception
     */
    public function get($column = null)
    {
        return $this->getDriver()->resetSql()->select($column);
    }

    /**
     * 添加
     * @param $data
     * @param int $insertId
     * @return bool
     * @throws Exception
     */
    public function add($data, &$insertId = -1)
    {
        return $this->getDriver()->resetSql()->insert($data)->execute([], $insertId);
    }


    /**
     * 修改
     * @param $data
     * @return Driver
     * @throws Exception
     */
    public function set($data)
    {
        return $this->getDriver()->resetSql()->update($data);
    }

    /**
     * 删除
     * @return Driver
     * @throws Exception
     */
    public function del()
    {
        return $this->getDriver()->resetSql()->delete();
    }

    /**
     * count
     * @param string $name
     * @return Driver
     * @throws Exception
     */
    public function count($name = '*')
    {
        return $this->getDriver()->resetSql()->select("count({$name}) as count");
    }

    /**
     * sum
     * @param string $name
     * @return Driver
     * @throws Exception
     */
    public function sum($name = '*')
    {
        return $this->getDriver()->resetSql()->select("sum({$name}) as sum");
    }

    /**
     * max
     * @param string $name
     * @return Driver
     * @throws Exception
     */
    public function max($name = '*')
    {
        return $this->getDriver()->resetSql()->select("max({$name}) as max");
    }

    /**
     * min
     * @param string $name
     * @return Driver
     * @throws Exception
     */
    public function min($name = '*')
    {
        return $this->getDriver()->resetSql()->select("min({$name}) as min");
    }
}