<?php

namespace apps\app\classier\controller\account;


use apps\app\classier\context\WebContext;
use apps\app\classier\controller\BaseController;
use apps\app\classier\service\BaseService;
use apps\core\classier\wrapper\UserWrapper;
use Exception;

class ValidaAccountController extends BaseController
{

    /**
     * @var UserWrapper
     */
    protected $userModel;

    /**
     * 效验登录状态
     * @param WebContext $context
     * @throws Exception
     */
    public function __construct(WebContext $context)
    {
        $this->userModel = $context->getUserContext()->getCurrentUser();

        BaseService::validaUserModel($this->userModel);

        parent::__construct($context);
    }

    /**
     * 获取用户信息
     * @return UserWrapper
     */
    public function getCurrentUser()
    {
        return $this->userModel;
    }

    /**
     * 获取用户id
     * @return int
     */
    public function getUserId()
    {
        return $this->getCurrentUser()->getId();
    }
}