<?php

namespace rapidPHP\library\core\app;

use Exception;
use rapidPHP\library\db\Driver;

abstract class DBDao
{

    protected $table, $config;

    public function __construct($table, $config = null)
    {
        $this->table = $table;

        $this->config = $config;
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
    protected function getDb()
    {
        return D($this->config)->table($this->table);
    }

    /**
     * 查询
     * @param null $column
     * @return Driver
     * @throws Exception
     */
    public function get($column = null)
    {
        return $this->getDb()->resetSql()->select($column);
    }


    /**
     * 添加
     * @param $data
     * @return bool
     * @throws Exception
     */
    public function add($data)
    {
        return $this->getDb()->resetSql()->insert($data)->execute();
    }


    /**
     * 修改
     * @param $data
     * @return Driver
     * @throws Exception
     */
    public function set($data)
    {
        return $this->getDb()->resetSql()->update($data);
    }

    /**
     * 删除
     * @return Driver
     * @throws Exception
     */
    public function del()
    {
        return $this->getDb()->resetSql()->delete();
    }

    /**
     * count
     * @param string $name
     * @return Driver
     * @throws Exception
     */
    public function count($name = '*')
    {
        return $this->getDb()->resetSql()->select("count({$name}) as count");
    }

    /**
     * sum
     * @param string $name
     * @return Driver
     * @throws Exception
     */
    public function sum($name = '*')
    {
        return $this->getDb()->resetSql()->select("sum({$name}) as sum");
    }

    /**
     * max
     * @param string $name
     * @return Driver
     * @throws Exception
     */
    public function max($name = '*')
    {
        return $this->getDb()->resetSql()->select("max({$name}) as max");
    }

    /**
     * min
     * @param string $name
     * @return Driver
     * @throws Exception
     */
    public function min($name = '*')
    {
        return $this->getDb()->resetSql()->select("min({$name}) as min");
    }
}