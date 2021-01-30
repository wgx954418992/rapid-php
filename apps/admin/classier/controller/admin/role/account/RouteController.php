<?php

namespace apps\admin\classier\controller\admin\role\account;


use apps\admin\classier\bean\RoleListCondition;
use apps\admin\classier\bean\RouteListCondition;
use apps\admin\classier\context\AdminContext;
use apps\admin\classier\context\WebContext;
use apps\admin\classier\controller\admin\ValidaAdminController;
use apps\admin\classier\service\admin\role\RouteService;
use apps\admin\classier\service\BaseService;
use apps\admin\classier\service\RoleService;
use apps\core\classier\model\AdminRouteModel;
use Exception;
use rapidPHP\modules\common\classier\RESTFulApi;
use rapidPHP\modules\reflection\classier\Utils;

/**
 * Class RouteController
 * @route /admin/role/account
 * @package apps\admin\classier\controller\admin\role\account
 */
class RouteController extends ValidaAdminController
{

    /**
     * @var RouteService
     */
    protected $routeService;

    /**
     * UriController constructor.
     * @param WebContext $context
     * @throws Exception
     */
    public function __construct(WebContext $context)
    {
        parent::__construct($context);

        $this->routeService = new RouteService(parent::getCurrentAdmin());
    }

    /**
     * 展示权限列表
     * @route /{adminId}/route/view
     * @typed auto
     * @template admin/role/account/route
     * @param AdminContext $adminContext
     * @param $adminId
     * @return array
     * @throws Exception
     */
    public function view(AdminContext $adminContext, $adminId)
    {
        $routes = $adminContext->getRoutes();

        $adminModel = BaseService::getInstance()->getAdmin($adminId);

        $condition = new RoleListCondition();

        $condition->setAdminId($adminModel->getId());

        $roles = RoleService::getInstance()->getRoles($condition);

        return [
            'admin' => $adminModel,
            'routes' => RoleService::getInstance()->getMergeRoleToRouteList($routes, $roles)
        ];
    }

    /**
     * 保存权限
     * @route /{adminId}/route/save
     * @typed api
     * @method post
     * @param AdminContext $adminContext
     * @param $adminId
     * @param array|null $ids post json
     * @return RESTFulApi
     * @throws Exception
     */
    public function save(AdminContext $adminContext, $adminId, ?array $ids)
    {
        if(!parent::getCurrentAdmin()->getIsSupreme()){
            if ($adminId == parent::getAdminId()) throw new Exception('您不能修自己的权限！');

            $routeIds = array_column($adminContext->getRoles(), 'route_id');

            foreach ($ids as $id) {
                if (!in_array($id, $routeIds)) throw new Exception('您的选择超出的您的权限范围，请检查后保存!');
            }
        }

        RoleService::getInstance()->save($adminId, $ids, parent::getAdminId());

        return RESTFulApi::success(null, '保存成功');
    }
}