<?php

namespace script\convert\classier;


use rapidPHP\modules\common\classier\Instances;

abstract class AnalysisInterface
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
     * 获取字段
     * @param string $filename
     * @return Property[]
     */
    abstract public function getProperties(string $filename);
}