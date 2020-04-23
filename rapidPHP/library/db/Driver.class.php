<?php

namespace rapidPHP\library\db;

use PDO;
use rapid\library\rapid;
use rapidPHP\library\Db;

abstract class Driver
{


    /**
     * 连接对象
     * @var null|PDO
     */
    private $connect = null;

    /**
     * 对应的model
     * @var $modelClass string
     */
    protected $modelClass = null;

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


    private $defaultSql = array(
        'select' => '', 'update' => '', 'delete' => '', 'insert' => '', 'query' => '',
        'join' => '', 'on' => '', 'where' => '', 'order' => '', 'limit' => '', 'group' => '', 'having' => '',
        'func' => ''
    );

    /**
     * sql语句
     * @var array
     */
    protected $sql;

    /**
     * driver constructor.
     * @param PDO $connect
     * @param string $modelClass
     */
    public function __construct(PDO $connect, $modelClass = null)
    {
        $this->connect = $connect;
        $this->sql = $this->defaultSql;
        $this->modelClass = $modelClass;
        $this->tableName = $this->getTableName($modelClass);
        $this->tableColumn = $this->getTableColumn($modelClass);
    }

    /**
     * 重置sql语句
     * @param null $name
     * @return $this
     */
    public function resetSql($name = null)
    {
        if (is_null($name)) {
            $this->sql = $this->defaultSql;
        } else if (isset($this->sql[$name])) {
            $this->sql[$name] = null;
        }
        return $this;
    }

    /**
     * 获取表name
     * @param $table
     * @return mixed
     */
    public function getTableName($table)
    {
        return Db::getTableName($table);
    }


    /**
     * 获取表字段
     * @param $table
     * @param null $column
     * @param string $columnLeft
     * @param string $columnRight
     * @return mixed|string
     */
    public function getTableColumn($table, $column = null, $columnLeft = '`', $columnRight = '`')
    {
        return Db::getTableColumn($table, $column, $columnLeft, $columnRight);
    }

    /**
     * 创建数据库
     * @param $dataBaseName
     * @return Driver
     */
    abstract public function createDataBase($dataBaseName);


    /**
     * 创建表单
     * @param array $column
     * @return Driver
     */
    abstract function createTable(array $column = []);


    /**
     * 执行存储过程
     * @param array $parameter
     * @param string $value
     * @return Driver
     */
    abstract public function func($parameter = [], $value = '');


    /**
     * 分页
     * @param $page
     * @param null $total
     * @return Driver
     */
    abstract public function limit($page, $total = null);

    /**
     * 写到数据
     * @param $data
     * @return Driver
     */
    abstract public function insert($data);


    /**
     * 修改
     * @param array $data
     * @return Driver
     */
    abstract public function update(array $data);

    /**
     * 删除
     * @return Driver
     */
    abstract public function delete();


    /**
     * 查询
     * @param null $column
     * @return Driver
     */
    abstract public function select($column = null);


    /**
     * 设置查询载体
     * @param $carrier
     * @return Driver
     */
    abstract public function setCarrier($carrier);


    /**
     * alias
     * @param $carrier
     * @return Driver
     */
    abstract public function alias($carrier);

    /**
     * JOIN
     * @param $table
     * @param $carrier
     * @param array $on
     * @param null $location
     * @return Driver
     */
    abstract public function join($table, $carrier, $on = [], $location = null);


    /**
     * LEFT JOIN
     * @param $table
     * @param $carrier
     * @param array $on
     * @return Driver
     */
    abstract public function leftJoin($table, $carrier, $on = []);

    /**
     * LEFT JOIN
     * @param $table
     * @param $carrier
     * @param array $on
     * @return Driver
     */
    abstract public function rightJoin($table, $carrier, $on = []);

    /**
     * INNER JOIN
     * @param $table :表
     * @param $carrier :载体
     * @param array $on :条件
     * @return Driver
     */
    abstract public function innerJoin($table, $carrier, $on = []);


    /**
     * FULL  JOIN
     * @param $table :表
     * @param $carrier :载体
     * @param array $on :条件
     * @return Driver
     */
    abstract public function fullJoin($table, $carrier, $on = []);


    /**
     * IN
     * @param $name :字段名
     * @param $parameter :参数
     * @param null $match :not
     * @return Driver
     */
    abstract public function in($name, $parameter, $match = null);


    /**
     * not in
     * @param $name :字段名
     * @param $parameter :参数
     * @return Driver
     */
    abstract public function notIn($name, $parameter);


    /**
     * union
     * @param $table
     * @param null $column
     * @return Driver
     */
    abstract public function union($table, $column = null);


    /**
     * 给表添加字段
     * @param $fieldName
     * @param $fieldType
     * @return Driver
     */
    abstract public function alterAdd($fieldName, $fieldType);


    /**
     * 删除表字段
     * @param $fieldName
     * @return Driver
     */
    abstract public function alterDropColumn($fieldName);


    /**
     * 修改表字段
     * @param $fieldName
     * @param $fieldType
     * @return Driver
     */
    abstract public function alterModify($fieldName, $fieldType);


    /**
     * on.
     * @param $name
     * @param null $values
     * @param string $expression
     * @return Driver
     */
    abstract public function on($name, $values = null, $expression = '=:');


    /**
     * 条件
     * @param $name
     * @param $values
     * @param string $expression
     * @return Driver
     */
    abstract public function where($name, $values = null, $expression = '=:');


    /**
     * 排序
     * @param $column
     * @param string $mode
     * @return Driver
     */
    abstract public function order($column, $mode = 'ASC');


    /**
     * 分组
     * @param $column
     * @return Driver
     */
    abstract public function group($column);


    /**
     * drop
     * @param string $name
     * @param string $type
     * @return Driver
     */
    abstract public function drop($name = '', $type = 'TABLE');


    /**
     * dropTable
     * @return Driver
     */
    abstract public function dropTable();

    /**
     * dropDatabase
     * @param $database
     * @return Driver
     */
    abstract public function dropDatabase($database);

    /**
     * isNotNull
     * @param $name
     * @return Driver
     */
    abstract public function isNotNull($name);

    /**
     * isNull
     * @param $name
     * @return Driver
     */
    abstract public function isNull($name);


    /**
     * 模糊查询
     * @param $name
     * @param $value
     * @param int $expression
     * @return Driver
     */
    abstract public function like($name, $value, $expression = 3);


    /**
     * having
     * @param $having
     * @return Driver
     */
    abstract public function having($having);


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
     * @return bool
     */
    public function execute(array $options = [])
    {
        $options = $this->getOptions($options);

        $exec = new Exec($this->connect, $this->getSql());

        return $exec->execute($options);
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

        $exec = new Exec($this->connect, $this->getSql());

        return $exec->get($this->modelClass, $options, $mode);
    }

}

