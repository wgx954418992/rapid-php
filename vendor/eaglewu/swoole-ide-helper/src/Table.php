<?php

namespace Swoole;

/**
 * 内存表
 */
class Table
{
    const TYPE_INT    = 1;
    const TYPE_STRING = 2;
    const TYPE_FLOAT  = 3;

    /**
     * 创建内存表对象
     *
     * @param int $size $size参数指定表格的最大行数，必须为2的指数，如1024,8192,65536等
     */
    public function __construct($size)
    {
    }

    /**
     * 检查是否存在key
     * @param $key
     * @return bool
     */
    function exist($key)
    {
    }
    
    /**
     * 获取key
     * @param $key
     * @param string $field
     * @return array|bool|string
     */
    function get($key, $field = null)
    {
    }

    /**
     * 设置key
     * @param       $key
     * @param array $array
     * @return bool
     */
    function set($key, array $array)
    {
    }

    /**
     * 删除key
     * @param $key
     * @return bool
     */
    function del($key)
    {
    }

    /**
     * 原子自增操作，可用于整形或浮点型列
     * @param $key
     * @param $column
     * @param $incrby
     * @return bool
     */
    function incr($key, $column, $incrby = 1)
    {
    }

    /**
     * 原子自减操作，可用于整形或浮点型列
     * @param $key
     * @param $column
     * @param $decrby
     */
    function decr($key, $column, $decrby = 1)
    {
    }

    /**
     * 增加字段定义
     * @param     $name
     * @param     $type
     * @param int $len
     */
    function column($name, $type, $len = 4)
    {
    }

    /**
     * 创建表，这里会申请操作系统内存
     * @return bool
     */
    function create()
    {
    }

    /**
     * 锁定整个表
     * @return bool
     */
    function lock()
    {
    }

    /**
     * 释放表锁
     * @return bool
     */
    function unlock()
    {
    }

    /**
     * table中存在的条目数
     * @return int
     */
    function count(){}
}
