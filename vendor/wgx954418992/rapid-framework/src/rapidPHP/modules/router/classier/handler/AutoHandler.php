<?php

namespace rapidPHP\modules\router\classier\handler;


use rapidPHP\modules\common\classier\Build;
use rapidPHP\modules\common\classier\RESTFulApi;
use rapidPHP\modules\core\classier\Controller;

;

use rapidPHP\modules\router\classier\Handler;

class AutoHandler extends HandlerInterface
{

    /**
     * @param Controller $controller
     * @param $result
     * @param array $options
     * @return null
     */
    public function onResult(Controller $controller, $result, array $options = [])
    {
        $accept = Build::getInstance()->getData($options, 'accept');

        if ($result instanceof RESTFulApi) {
            $service = Handler::getInstance()->getService(null, Handler::SERVER_API);
        } else if ($accept === '*/*') {
            $service = Handler::getInstance()->getService(null, Handler::SERVER_API);
        } else {
            $service = Handler::getInstance()->getService(null, Handler::SERVER_VIEW);
        }

        return Handler::getInstance()->handler($controller, $service, $result, $options);
    }

}
