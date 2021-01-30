<?php

namespace apps\admin\classier\controller;


use apps\admin\classier\context\AdminContext;
use apps\admin\classier\service\UserService;
use apps\core\classier\config\BaseConfig;
use Exception;

class HomeController extends BaseController
{
    /**
     * 后台主页
     * @route (/|index)
     * @param int $exit get
     */
    public function index($exit = null)
    {
        if ($exit) $this->getResponse()->cookie(BaseConfig::TOKEN_NAME_ADMIN, null);

        parent::location('login');
    }

    /**
     * 登录页面
     * @route /login
     * @param AdminContext $context
     * @param $submit
     * @param $username
     * @param $password
     * @throws Exception
     * @template /login
     */
    public function login(AdminContext $context, $submit, $username, $password)
    {
        if ($context->getCurrentAdmin() != null) {
            BaseController::location("admin/index");
        } else if ($submit != null) {

            $token = UserService::getInstance()->loginByAdmin($username, $password,
                $this->getRequest()->getIp(),
                $this->getRequest()->getUserAgent()
            );

            $this->getResponse()->cookie(BaseConfig::TOKEN_NAME_ADMIN, $token, time() + (3600 * 24 * 365));

            BaseController::location("admin/index");
        }
    }
}