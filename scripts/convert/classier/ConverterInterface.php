<?php

namespace script\convert\classier;


use rapidPHP\modules\common\classier\Instances;
use rapidPHP\modules\reflection\classier\Classify;

abstract class ConverterInterface
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
     * onConvert
     * @param array $properties
     * @param $className
     * @param string $doc
     * @param null $namespace
     * @param array|null $options
     * @return mixed
     */
    abstract public function onConvert(array $properties, $className, string $doc, $namespace = null, ?array $options = []);

}