<?php

namespace rapidPHP\modules\router\classier\handler;


use rapidPHP\modules\common\classier\Build;
use rapidPHP\modules\core\classier\Controller;

;

use rapidPHP\modules\router\classier\Handler;

class AutoHandler implements HandlerInterface
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
     * @param Controller $controller
     * @param $result
     * @param array $options
     * @return null
     */
    public function onResult(Controller $controller, $result, $options = [])
    {
        $accept = Build::getInstance()->getData($options, 'accept');

        if ($accept === '*/*') {
            $service = Handler::getInstance()->getService(null, Handler::SERVER_API);
        } else {
            $service = Handler::getInstance()->getService(null, Handler::SERVER_VIEW);
        }

        return Handler::getInstance()->handler($controller, $service, $result, $options);
    }

}