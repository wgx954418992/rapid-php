<?php

namespace apps\file\classier\controller;

use Exception;
use rapidPHP\modules\common\classier\RESTFulApi;
use rapidPHP\modules\core\classier\web\WebController;

/**
 * Class ErrorController
 * @package apps\file\classier\controller
 */
class ErrorController extends WebController
{

    /**
     * 全局错误捕获
     * @route /error
     * @typed api
     * @param Exception|null $exception
     * @return RESTFulApi|null
     * @throws Exception
     */
    public function error(?Exception $exception)
    {
        if (!$exception) return null;

        return RESTFulApi::error($exception->getMessage(), $exception->getCode());
    }
}
