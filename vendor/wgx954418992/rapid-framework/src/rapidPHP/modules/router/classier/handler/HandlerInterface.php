<?php

namespace rapidPHP\modules\router\classier\handler;


use rapidPHP\modules\core\classier\Controller;

interface HandlerInterface
{

    /**
     * @return self
     */
    public static function getInstance();

    /**
     * 接收到数据
     * @param Controller $controller
     * @param $result
     * @param array $options
     * @return array|mixed|null
     */
    public function onResult(Controller $controller, $result, $options = []);
}