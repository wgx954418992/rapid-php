<?php

namespace apps\core\classier\config;


use Exception;
use rapidPHP\modules\application\classier\Application;
use rapidPHP\modules\common\classier\Instances;

trait Configure
{

    /**
     * 单例模式
     */
    use Instances;

    /**
     * 初始化当前
     * @return static
     * @throws Exception
     */
    public static function onNotInstance()
    {
        $static = new static();

        Application::getInstance()
            ->getConfig()
            ->setProperties($static);

        return $static;
    }
}
