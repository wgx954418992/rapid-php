<?php

namespace script\model\classier\handler;


use rapidPHP\modules\common\classier\Build;
use rapidPHP\modules\common\classier\Instances;
use script\model\classier\config\IHandlerConfig;
use script\model\classier\model\TableModel;

abstract class IHandler
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
     * handler
     * @param IHandlerConfig $config
     * @param TableModel $table
     * @param $columns
     * @return string
     */
    abstract public function onHandler(IHandlerConfig $config, TableModel $table, $columns): string;
}
