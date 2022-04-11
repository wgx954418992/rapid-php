<?php

namespace apps\admin\classier\controller\account;


use apps\admin\classier\context\WebContext;
use apps\admin\classier\controller\BaseController;
use apps\admin\classier\service\BaseService;
use apps\admin\classier\wrapper\AdminWrapper;
use Exception;

class ValidaAccountController extends BaseController
{

    /**
     * @var AdminWrapper
     */
    protected $adminModel;

    /**
     * 效验管理员登录状态
     * @param WebContext $context
     * @throws Exception
     */
    public function __construct(WebContext $context)
    {
        $this->adminModel = $context->getAdminContext()->getCurrentAdmin();

        BaseService::validaAdmin($this->adminModel);

        parent::__construct($context);
    }

    /**
     * 获取管理员信息
     * @return AdminWrapper
     */
    public function getAccount()
    {
        return $this->adminModel;
    }

    /**
     * 获取管理员id
     * @return int
     */
    public function getAccountId()
    {
        return $this->getAccount()->getId();
    }
}
