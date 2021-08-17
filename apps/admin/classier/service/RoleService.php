<?php

namespace apps\admin\classier\service;

use apps\admin\classier\bean\RoleListCondition;
use apps\admin\classier\bean\RouteListCondition;
use apps\admin\classier\dao\master\admin\RoleDao;
use apps\admin\classier\dao\master\admin\RouteDao;
use apps\admin\classier\wrapper\RouteWrapper;
use apps\core\classier\dao\MasterDao;
use apps\core\classier\model\AdminRoleModel;
use Exception;
use rapidPHP\modules\common\classier\AR;
use rapidPHP\modules\common\classier\Instances;
use rapidPHP\modules\common\classier\Verify;
use rapidPHP\modules\reflection\classier\Utils;
use rapidPHP\modules\router\classier\Router;
use function rapidPHP\AR;
use function rapidPHP\B;


class RoleService
{

    /**
     * 单例模式
     */
    use Instances;

    /**
     * @return static
     */
    public static function onNotInstance()
    {
        return new static();
    }

    /**
     * 获取 route list
     * @param RouteListCondition|null $condition
     * @return array|null
     * @throws Exception
     */
    public function getRoutes(RouteListCondition $condition = null)
    {
        if (!$condition) $condition = new RouteListCondition();

        return RouteDao::getInstance()->getRouteList($condition);
    }

    /**
     * 获取管理员权限role
     * @param RoleListCondition $condition
     * @return array|null
     * @throws Exception
     */
    public function getRoles(RoleListCondition $condition)
    {
        if (empty($condition->getAdminId())) throw new Exception('adminId error!');

        return RoleDao::getInstance()->getRoleList($condition);
    }

    /**
     * 获取合并 role 到 route 的list
     * @param $routes
     * @param $roles
     * @return RouteWrapper[]|null
     * @throws Exception
     */
    public function getMergeRoleToRouteList($routes, $roles)
    {
        if (empty($routes)) return null;

        if (empty($roles)) $roles = [];

        $roles = AR()->arrayColumn($roles, 'route_id', null, true);

        foreach ($routes as $index => $route) {
            $routeId = B()->getData($route, 'id');

            if (isset($roles[$routeId]) && $roles[$routeId]) {
                $routes[$index]['role'] = $roles[$routeId];
            }
        }

        $routes = AR::getInstance()->getTree($routes, 'parent_id', 'id');

        Utils::getInstance()->toObjects(RouteWrapper::class, $routes);

        return $routes;
    }


    /**
     * 检查权限
     * @param $checkValue
     * @param $routes RouteWrapper[]|null
     * @return bool
     */
    public function checkRoute($checkValue, ?array $routes): bool
    {
        if (empty($routes)) return false;

        foreach ($routes as $route) {
            if (!$route->getRole()) continue;

            $value = preg_replace('#\{.*\}#i', '(\w+)', $route->getRoute());

            if (!empty($value)) {

                if ($value == $checkValue) return true;

                $pattern = Router::getPatternByString($value);

                $preg = Verify::getInstance()->preg($pattern) ? preg_match($pattern, $checkValue) : (int)($pattern == $checkValue);

                if (is_int($preg) && $preg == 1) {
                    return true;
                }
            }

            if (!empty($route->getChild())) {
                $result = $this->checkRoute($checkValue, $route->getChild());

                if ($result) return true;
            }
        }

        return false;
    }

    /**
     * 保存修改权限
     * @param $adminId
     * @param $ids
     * @param null $createdId
     * @throws Exception
     */
    public function save($adminId, $ids, $createdId = null)
    {
        MasterDao::getSQLDB()->beginTransaction();

        try {
            RoleDao::getInstance()->delRoleByAdmin($adminId);

            $adminRoleModel = new AdminRoleModel();

            $adminRoleModel->setAdminId($adminId);

            $adminRoleModel->setCreatedId($createdId);

            foreach ($ids as $id) {

                $adminRoleModel->setRouteId($id);

                RoleDao::getInstance()->addRole($adminRoleModel);
            }

            if (!MasterDao::getSQLDB()->commit()) throw new Exception('保存权限失败!');
        } catch (Exception $e) {
            MasterDao::getSQLDB()->rollBack();

            throw $e;
        }
    }
}
