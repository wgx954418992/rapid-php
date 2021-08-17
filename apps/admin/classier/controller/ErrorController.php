<?php

namespace apps\admin\classier\controller;

use apps\core\classier\enum\ErrorCode;
use Exception;
use rapidPHP\modules\common\classier\RESTFulApi;
use rapidPHP\modules\exception\classier\ActionException;
use rapidPHP\modules\server\classier\websocket\swoole\Response;

/**
 * Class ErrorController
 * @package apps\admin\classier\controller
 */
class ErrorController extends BaseController
{
    /**
     * 访问受保护的文件或者目录
     *  - /runtime/**
     *  - .conf .yaml .gitignore .sql .git
     * 详情请看app 跟目录的 .htaccess 或者自己配置的nginx.conf
     * @route /error/protected
     * @header status:403
     * @typed raw
     * @param $path
     */
    public function protected($path)
    {

    }

    /**
     * 全局错误捕获
     * @route /error
     * @typed auto
     * @template error/error
     * @param Exception|null $exception
     * @return array|RESTFulApi|null|void
     * @throws Exception
     */
    public function error(?Exception $exception)
    {
        if (!$exception) return null;

        $accept = $this->getRequest()->header('Accept');

        $typed = null;

        if ($exception instanceof ActionException && $exception->getAction()) {
            $typed = $exception->getAction()->getTyped();
        }

        if (($typed === 'api') || ($accept === '*/*') || ($this->getResponse() instanceof Response)) {
            return RESTFulApi::error($exception->getMessage(), $exception->getCode());
        } else {
            switch ($exception->getCode()) {
                case ErrorCode::USER_LOGIN_NOT:
                    $this->getResponse()->redirect($this->getRequest()->getHostUrl());
                    $this->getResponse()->end();
                    break;
                default:
                    return [
                        'title' => 'Server Error',
                        'msg' => $exception->getMessage(),
                        'code' => $exception->getCode()
                    ];
            }
        }
        return;
    }
}
