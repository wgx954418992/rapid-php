<?php

namespace rapidPHP\modules\router\classier\handler;


use rapidPHP\modules\core\classier\Controller;

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
     * 接收到数据
     * @param Controller $controller
     * @param $result
     * @param array $options
     * @return array|mixed|null|string
     */
    abstract public function onResult(Controller $controller, $result, array $options = []);
}
