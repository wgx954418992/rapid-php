<?php

namespace rapidPHP\modules\router\classier\handler;


use rapidPHP\modules\core\classier\Controller;

class RawHandler implements HandlerInterface
{
    /**
     * @var self
     */
    private static $instance;

    /**
     * @return self
     */
    public static function getInstance()
    {
        return self::$instance instanceof self ? self::$instance : self::$instance = new self();
    }

    /**
     * 对于原生数据直接返回即可
     * @param Controller $controller
     * @param $result
     * @param array $options
     * @return array|string
     */
    public function onResult(Controller $controller, $result, $options = [])
    {
        return $result;
    }
}