<?php

namespace apps\admin\classier\controller\admin;


use apps\admin\classier\context\AdminContext;
use Exception;

/**
 * Class AdminController
 * @route /admin
 * @package apps\admin\classier\controller\admin
 */
class AdminController extends ValidaAdminController
{

    /**
     * 主页Frame
     * @route /(index|)
     * @template admin/index
     * @param AdminContext $adminContext
     * @return array
     * @throws Exception
     */
    public function index(AdminContext $adminContext)
    {
        return [
            'admin' => parent::getCurrentAdmin(),
            'routes' => $adminContext->getMergeRoleToRouteList()
        ];
    }

    /**
     * 主页
     * @route /home
     * @template admin/home
     */
    public function home()
    {
    }
}
