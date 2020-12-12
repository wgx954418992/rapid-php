<?php

namespace script\model\classier;


abstract class HandlerInterface
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
     * 获取文件后缀
     * @return string
     */
    abstract public function getExt(): string;

    /**
     * onReceive
     * @param Table $table
     * @param $columns
     * @param null $namespace
     * @param array|null $options
     * @return mixed
     */
    abstract public function onReceive(Table $table, $columns, $namespace = null, ?array $options = []);

}