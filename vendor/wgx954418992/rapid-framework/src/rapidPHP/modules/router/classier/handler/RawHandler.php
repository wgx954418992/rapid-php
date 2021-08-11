<?php

namespace rapidPHP\modules\router\classier\handler;


use rapidPHP\modules\core\classier\Controller;

class RawHandler extends HandlerInterface
{

    /**
     * 对于原生数据直接返回即可
     * @param Controller $controller
     * @param $result
     * @param array $options
     * @return array|string
     */
    public function onResult(Controller $controller, $result, array $options = [])
    {
        return $result;
    }
}
