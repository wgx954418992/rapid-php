<?php


namespace apps\admin\classier\interceptor;


use apps\admin\classier\context\WebContext;
use apps\admin\classier\service\BaseService;
use apps\admin\classier\service\RoleService;
use Exception;
use rapidPHP\modules\router\classier\Action;
use rapidPHP\modules\router\classier\Interceptor;
use rapidPHP\modules\router\classier\Route;
use rapidPHP\modules\router\classier\Router;

class AuthorityInterceptor extends Interceptor
{

    /**
     * 拦截规则
     * @var string[]
     */
    protected $roles = [
        'admin/.*',
    ];

    /**
     * 排除规则
     * @var string[]
     */
    protected $excludes = [];

    /**
     * @var WebContext
     */
    private $webContext;

    /**
     * AuthorityInterceptor constructor.
     * @param WebContext $webContext
     */
    public function __construct(WebContext $webContext)
    {
        $this->webContext = $webContext;
    }

    /**
     * 处理拦截
     * @param Router $router
     * @param Action $action
     * @param Route $route
     * @param $pathVariable
     * @param $realPath
     * @param $role
     * @throws Exception
     */
    public function onHandler(Router $router, Action $action, Route $route, $pathVariable, $realPath, $role)
    {
        $adminContext = $this->webContext->getAdminContext();

        BaseService::validaAdmin($adminContext->getCurrentAdmin());

        if (strlen($realPath) > 1) $realPath = ltrim($realPath, '/*');

        $isCheck = RoleService::getInstance()->checkRoute($realPath, $adminContext->getMergeRoleToRouteList());

        if (!$isCheck) throw new Exception('您没有权限访问!');
    }
}