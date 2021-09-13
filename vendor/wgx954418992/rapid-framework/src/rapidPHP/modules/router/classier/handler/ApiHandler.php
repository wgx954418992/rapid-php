<?php

namespace rapidPHP\modules\router\classier\handler;


use Exception;
use rapidPHP\modules\common\classier\Build;
use rapidPHP\modules\common\classier\RESTFulApi;
use rapidPHP\modules\core\classier\Controller;

class ApiHandler extends HandlerInterface
{

    /**
     * 处理typed api
     * @param Controller $controller
     * @param $result
     * @param array $options
     * @return array|string
     * @throws Exception
     */
    public function onResult(Controller $controller, $result, array $options = [])
    {
        if ($result instanceof Exception) {
            $result = RESTFulApi::error($result->getMessage(), $result->getCode());
        } else if (!($result instanceof RESTFulApi)) {
            $result = RESTFulApi::success($result);
        }

        $result = $result->getResult();

        $append = Build::getInstance()->getData($options, 'append');

        if (!empty($append)) {
            if (is_array($append)) {
                $result = array_merge($result, $append);
            } else {
                $result[] = $append;
            }
        }

        return $result;
    }
}
