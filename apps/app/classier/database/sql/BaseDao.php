<?php


namespace apps\app\classier\database\sql;


use Exception;
use rapidPHP\modules\core\classier\Model;
use rapidPHP\modules\database\sql\classier\Driver;
use rapidPHP\modules\database\sql\classier\SqlDB;
use rapidPHP\modules\reflection\classier\Classify;

abstract class BaseDao extends DBSource
{

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
     * BaseDao constructor.
     * @param $modelOrClass
     */
    public function __construct($modelOrClass)
    {
        if (is_subclass_of($modelOrClass, Model::class)) {
            $this->tableName = $modelOrClass::NAME;

            $this->tableField = $this->getModelField($modelOrClass);
        }else{
            $this->tableField = '*';
        }
    }

    /**
     * 获取model字段
     * @param $modelOrClass
     * @return array|string|null
     */
    private function getModelField($modelOrClass){
        try {
            $classify = Classify::getInstance($modelOrClass);

            $tableField = $classify->getPropertiesNames();

            if (empty( $this->tableField)) return'*';

            return  $tableField;
        } catch (Exception $e) {
            return '*';
        }
    }

    /**
     * 单例模式
     * @return static
     */
    abstract public static function getInstance();

    /**
     * 获取驱动
     * @param SqlDB|null $db
     * @return Driver
     * @throws Exception
     */
    public function getDriver(?SqlDB $db = null)
    {
        if (!$db) $db = $this->getDb();

        return $db->table($this->tableName);
    }

    /**
     * @param $id
     * @return string
     */
    public function getRId($id)
    {
        return (static::class . $id);
    }

    /**
     * 查询
     * @param null $column
     * @return Driver
     * @throws Exception
     */
    public function get($column = null)
    {
        return $this->getDriver()->resetSql()->select(!$column ? $this->tableField : $column);
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
        return $this->getDriver()->resetSql()->insert($data)->execute($insertId);
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