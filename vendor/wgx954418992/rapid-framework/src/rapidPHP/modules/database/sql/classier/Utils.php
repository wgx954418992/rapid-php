<?php

namespace rapidPHP\modules\database\sql\classier;

class Utils
{

    /**
     * @var Utils
     */
    private static $instance;

    /**
     * 单例模式
     * @return self
     */
    public static function getInstance()
    {
        return self::$instance instanceof self ? self::$instance : self::$instance = new self();
    }

    /**
     * 格式化字段
     * @param $column
     * @param string $joinString
     * @return mixed
     */
    public function formatColumn($column, $joinString = '`')
    {
        return preg_replace('/(.*?)(\w+)/i', "$1{$joinString}$2{$joinString}", $column);
    }
}

