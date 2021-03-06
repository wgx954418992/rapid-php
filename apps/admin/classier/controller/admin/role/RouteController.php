<?php

namespace apps\admin\classier\controller\admin\role;


use apps\admin\classier\bean\RouteListCondition;
use apps\admin\classier\context\WebContext;
use apps\admin\classier\controller\admin\ValidaAdminController;
use apps\admin\classier\service\admin\role\RouteService;
use apps\admin\classier\service\RoleService;
use apps\core\classier\model\AdminRouteModel;
use Exception;
use rapidPHP\modules\common\classier\RESTFulApi;
use rapidPHP\modules\reflection\classier\Utils;

/**
 * Class RouteController
 * @route /admin/role/route
 * @package apps\admin\classier\controller\admin
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
     * 资源列表
     * @route /list
     * @typed auto
     * @template admin/role/route/list
     * @param RouteListCondition $condition
     * @return array
     * @throws Exception
     */
    public function list(RouteListCondition $condition)
    {
        $condition->setIsCache(false);

        $list = RoleService::getInstance()->getRoutes($condition);

        Utils::getInstance()->toObjects(AdminRouteModel::class, $list);

        return [
            'condition' => $condition,
            'list' => $list,
        ];
    }

    /**
     * 添加或者编辑uri
     * @route /added
     * @typed auto
     * @template admin/role/route/added
     * @param $submit
     * @param AdminRouteModel $model
     * @return AdminRouteModel
     * @throws Exception
     */
    public function added($submit, AdminRouteModel $model)
    {
        if (!empty($submit)) {
            $routeModel = $this->routeService->added($model);
        } else {
            if (!empty($model->getId())) {
                $routeModel = $this->routeService->getRoute($model->getId());
            } else {
                $routeModel = new AdminRouteModel();
            }
        }

        return $routeModel;
    }

    /**
     * 删除资源
     * @route /{routeId}/del
     * @typed api
     * @method post
     * @param $routeId
     * @return RESTFulApi
     * @throws Exception
     */
    public function del($routeId)
    {
        $this->routeService->del($routeId);

        return RESTFulApi::success(null, '删除成功');
    }

}