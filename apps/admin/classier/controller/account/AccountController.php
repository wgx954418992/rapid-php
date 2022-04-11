<?php

namespace apps\admin\classier\controller\account;


use apps\admin\classier\context\AdminContext;
use Exception;
use rapidPHP\modules\application\classier\Application;
use rapidPHP\modules\common\classier\RESTFulApi;

/**
 * Class AccountController
 * @route /account
 * @package apps\admin\classier\controller\account
 */
class AccountController extends ValidaAccountController
{

    /**
     * 获取当前用户信息
     * @route /profile/get
     * @method get
     * @typed api
     * @return RESTFulApi
     * @throws Exception
     */
    public function getProfile()
    {
        return RESTFulApi::success($this->getAccount());
    }

    /**
     * 主页Frame
     * @route /(index|)
     * @typed view
     * @template account/index
     * @param AdminContext $adminContext
     * @return array
     * @throws Exception
     */
    public function index(AdminContext $adminContext)
    {
        return [
            'admin' => parent::getAccount(),
            'config' => [
                'host' => Application::getInstance()
                    ->getConfig()
                    ->getValue('host')
            ],
        ];
    }

    /**
     * 主页
     * @route /home
     * @typed view
     * @template account/home
     */
    public function home()
    {
    }
}
