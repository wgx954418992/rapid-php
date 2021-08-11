<?php

namespace rapidPHP\modules\database\sql\classier;

use rapidPHP\modules\common\classier\Instances;

class Utils
{

    /**
     * 采用单例模式
     */
    use Instances;

    /**
     * 实例不存在
     * @return static
     */
    public static function onNotInstance()
    {
        return new static();
    }

    /**
     * 格式化字段
     * @param $column
     * @param string $joinString
     * @return array|string|string[]|null
     */
    public function formatColumn($column, string $joinString = '`')
    {
        return preg_replace('/(.*?)(\w+)/i', "$1{$joinString}$2{$joinString}", $column);
    }
}

