<?php

namespace apps\admin\classier\service\admin\role;

use apps\admin\classier\dao\master\admin\RouteDao;
use apps\core\classier\model\AdminRouteModel;
use Exception;
use rapidPHP\modules\common\classier\Instances;


class RouteService
{



    /**
     * 单例模式
     */
    use Instances;

    /**
     * 初始化当前
     * @return static
     */
    public static function onNotInstance()
    {
        return new static();
    }

    /**
     * 获取route
     * @param $routeId
     * @return AdminRouteModel
     * @throws Exception
     */
    public function getRoute($routeId)
    {
        if (empty($routeId)) throw new Exception('routeId 错误!');

        /** @var RouteDao $routeDao */
        $routeDao = RouteDao::getInstance();

        $routeModel = $routeDao->getRoute($routeId);

        if ($routeModel == null) throw new Exception('route不存在!');

        return $routeModel;
    }

    /**
     * 添加route
     * @param AdminRouteModel $routeModel
     * @return AdminRouteModel
     * @throws Exception
     */
    public function added(AdminRouteModel $routeModel)
    {
        $routeModel->validName('name必填!');

        $routeModel->validType('type 错误!');

        /** @var RouteDao $routeDao */
        $routeDao = RouteDao::getInstance();

        if (!empty($routeModel->getId())) {
            if (!$routeDao->setRoute($routeModel)) throw new Exception('修改route信息失败!');
        } else {
            if (!$routeDao->addRoute($routeModel)) throw new Exception('修改route员失败!');
        }

        return $routeModel;
    }

    /**
     * 删除route
     * @param $routeId
     * @return bool
     * @throws Exception
     */
    public function del($routeId): bool
    {
        if (empty($routeId)) throw new Exception('routeId 错误!');

        /** @var RouteDao $routeDao */
        $routeDao = RouteDao::getInstance();

        $routeModel = $routeDao->getRoute($routeId);

        if ($routeModel == null) throw new Exception('route不存在!');

        if ($routeModel->getIsSystem()) throw new Exception('系统资源不能删除!');

        if (!$routeDao->delRoute($routeId)) throw new Exception('删除失败!');

        return true;
    }

}
