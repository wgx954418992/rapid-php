<?php

namespace apps\app\classier\controller;

use Exception;
use rapidPHP\modules\common\classier\RESTFulApi;
use rapidPHP\modules\exception\classier\ActionException;

/**
 * Class ErrorController
 * @package application\controller
 */
class ErrorController extends BaseController
{

    /**
     * 全局错误捕获
     * @route /error
     * @typed auto
     * @template error/error
     * @param Exception|null $exception
     * @return array|RESTFulApi|null
     */
    public function error(?Exception $exception)
    {
        if (!$exception) return null;

        $accept = $this->getRequest()->header('accept');

        if ($accept === '*/*') {
            return RESTFulApi::error($exception->getMessage(), $exception->getCode());
        } else {
            return [
                'title' => 'Server Error',
                'msg' => $exception->getMessage(),
                'code' => $exception->getCode()
            ];
        }
    }

    /**
     * 404错误
     * @route /error/404
     * @param Exception|null $exception
     * @return string[]
     * @template error/500
     */
    public function notFound(?Exception $exception = null)
    {
        return [
            'title' => '404 Not Found',
            'msg' => $exception ? $exception->getMessage() : '',
        ];
    }

    /**
     * 403错误
     * @route /error/403
     * @param ActionException|null $exception
     */
    public function forbidden(?ActionException $exception = null)
    {
        $this->getResponse()->status(403);
    }
}