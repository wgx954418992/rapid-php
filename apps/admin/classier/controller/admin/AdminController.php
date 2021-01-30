<?php

namespace apps\admin\classier\controller\admin;


use apps\admin\classier\context\AdminContext;
use apps\admin\classier\context\WebContext;
use apps\admin\classier\service\admin\AdminService;
use Exception;

/**
 * Class AdminController
 * @route /admin
 * @package apps\admin\classier\controller\admin
 */
class AdminController extends ValidaAdminController
{

    /**
     * @var AdminService
     */
    protected $adminService;

    /**
     * AdminController constructor.
     * @param WebContext $context
     * @throws Exception
     */
    public function __construct(WebContext $context)
    {
        parent::__construct($context);

        $this->adminService = new AdminService(parent::getCurrentAdmin());
    }

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