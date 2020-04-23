<?php

namespace rapidPHP\library\core\app;

use Exception;
use rapidPHP\library\Db;
use rapidPHP\library\db\Driver;

class DBDao
{

    protected $modelClass, $config;

    public function __construct($modelClass, $config = null)
    {
        $this->config = $config;

        $this->modelClass = $modelClass;
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
        return D($this->config)->table($this->modelClass);
    }

    /**
     * 获取db
     * @return mixed|Db|null
     */
    public function getDb()
    {
        return D($this->config);
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
     * @return bool
     * @throws Exception
     */
    public function add($data)
    {
        return $this->getDriver()->resetSql()->insert($data)->execute();
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