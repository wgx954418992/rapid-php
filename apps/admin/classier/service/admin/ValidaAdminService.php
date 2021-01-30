<?php

namespace apps\admin\classier\service\admin;

use apps\admin\classier\service\BaseService;
use apps\core\classier\wrapper\AdminWrapper;
use Exception;

class ValidaAdminService
{
    /**
     * @var AdminWrapper
     */
    protected $adminModel;

    /**
     * 效验管理员登录状态
     * @param AdminWrapper|null $adminModel
     * @throws Exception
     */
    public function __construct(?AdminWrapper $adminModel)
    {
        BaseService::validaAdmin($adminModel);

        $this->adminModel = $adminModel;
    }


    /**
     * 获取管理员信息
     * @return AdminWrapper
     */
    public function getCurrentAdmin()
    {
        return $this->adminModel;
    }

    /**
     * 获取管理员id
     * @return int
     */
    public function getAdminId()
    {
        return $this->getCurrentAdmin()->getId();
    }

}