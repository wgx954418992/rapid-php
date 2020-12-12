<?php

namespace rapidPHP\modules\database\sql\classier;

class Utils
{

    /**
     * @var static[]
     */
    private static $instances;

    /**
     * @return static
     */
    public static function getInstance()
    {
        if (isset(self::$instances[static::class])) {
            return self::$instances[static::class];
        } else {
            return self::$instances[static::class] = new static();
        }
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

