<?php

namespace script\model\classier;


use rapidPHP\modules\common\classier\Instances;

abstract class HandlerInterface
{
    /**
     * 单例模式
     */
    use Instances;

    /**
     * 初始化当前
     * @return static
     */
    public static function onNotInstance()
    {
        return new static();
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