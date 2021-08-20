<?php

namespace script\convert\classier\handler;


use rapidPHP\modules\common\classier\Instances;
use script\convert\classier\config\IHandlerConfig;
use script\convert\classier\model\PropertyModel;

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
     * @param PropertyModel[] $properties
     * @param array $options
     * @return string
     */
    abstract public function onHandler(IHandlerConfig $config, array $properties, array $options = []): string;
}
