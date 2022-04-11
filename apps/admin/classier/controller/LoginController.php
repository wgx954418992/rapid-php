<?php

namespace apps\admin\classier\controller;


use apps\admin\classier\context\AdminContext;
use apps\admin\classier\service\PswordLoginService;
use apps\core\classier\enum\TokenKey;
use Exception;
use rapidPHP\modules\common\classier\RESTFulApi;

class LoginController extends BaseController
{

    /**
     * 登录页面
     * @route /login
     * @template /login
     * @param AdminContext $context
     * @param $submit
     * @param $username
     * @param $password
     * @throws Exception
     */
    public function login(AdminContext $context, $submit, $username, $password)
    {
        if ($context->getCurrentAdmin() != null) {
            BaseController::location("account/index");
        } else if ($submit != null) {

            $token = PswordLoginService::getInstance()
                ->loginByAdmin(
                    $username,
                    $password,
                    $this->getRequest()->getIp(),
                    $this->getRequest()->getUserAgent()
                );

            $this->getResponse()->cookie(TokenKey::ADMIN, $token, time() + (3600 * 24 * 365));

            BaseController::location("account/index");
        }
    }

    /**
     * 通过账号密码登录
     * @route /login/passwd
     * @method post
     * @typed api
     * @param $username
     * @param $password
     * @return RESTFulApi
     * @throws Exception
     */
    public function loginByPasswd($username, $password)
    {
        $token = PswordLoginService::getInstance()
            ->loginByAdmin($username, $password,
                $this->getRequest()->getIp(),
                $this->getRequest()->getUserAgent()
            );

        $this->getResponse()->cookie(TokenKey::ADMIN, $token, time() + (3600 * 24 * 1), '/', $this->getDomain());

        return RESTFulApi::success($token);
    }
}
