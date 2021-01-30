<?php

namespace apps\admin\classier\dao\master\admin;

use apps\admin\classier\bean\RouteListCondition;
use apps\core\classier\dao\MasterDao;
use apps\core\classier\model\AdminRouteModel;
use apps\core\classier\service\RedisCacheService;
use Exception;
use rapidPHP\modules\database\sql\classier\Driver;
use rapidPHP\modules\database\sql\classier\driver\Mysql;
use function rapidPHP\Cal;

class RouteDao extends MasterDao
{

    /**
     * RouteDao constructor.
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct(AdminRouteModel::class);
    }

    /**
     * @return string
     */
    private function getCacheId(): string
    {
        return $this->getRId('admin.route.list');
    }

    /**
     * 添加route
     * @param AdminRouteModel $routeModel
     * @return bool
     * @throws Exception
     */
    public function addRoute(AdminRouteModel $routeModel): bool
    {
        $data = [
            'name' => $routeModel->getName(),
            'route' => $routeModel->getRoute(),
            'type' => $routeModel->getType(),
            'rank' => $routeModel->getRank(),
            'remark' => $routeModel->getRemark(),
            'is_system' => (bool)$routeModel->getIsSystem(),
            'is_delete' => false,
            'created_id' => $routeModel->getCreatedId(),
            'created_time' => Cal()->getDate(),
        ];

        if ($routeModel->getParentId()) $data['parent_id'] = $routeModel->getParentId();

        if ($routeModel->getOptions()) $data['options'] = $routeModel->getOptions();

        $result = parent::add($data, $id);

        if ($result) {
            $routeModel->setId($id);

            RedisCacheService::getInstance()->remove($this->getCacheId());
        }

        return $result;
    }

    /**
     * set route
     * @param AdminRouteModel $routeModel
     * @return bool
     * @throws Exception
     */
    public function setRoute(AdminRouteModel $routeModel): bool
    {
        $data = [
            'name' => $routeModel->getName(),
            'route' => $routeModel->getRoute(),
            'type' => $routeModel->getType(),
            'rank' => $routeModel->getRank(),
            'remark' => $routeModel->getRemark(),
            'is_system' => (bool)$routeModel->getIsSystem(),
            'updated_id' => $routeModel->getUpdatedId(),
            'updated_time' => Cal()->getDate(),
        ];

        if ($routeModel->getParentId()) $data['parent_id'] = $routeModel->getParentId();

        if ($routeModel->getOptions()) $data['options'] = $routeModel->getOptions();

        $result = parent::set($data)->where('id', $routeModel->getId())->execute();

        if ($result) {
            RedisCacheService::getInstance()->remove($this->getCacheId());
        }

        return $result;
    }


    /**
     * 删除route
     * @param $id
     * @return bool
     * @throws Exception
     */
    public function delRoute($id): bool
    {
        $result = parent::del()->where('id', $id)->execute();

        if ($result) {
            RedisCacheService::getInstance()->remove($this->getCacheId());
        }

        return $result;
    }

    /**
     * 获取route信息
     * @param $id
     * @return AdminRouteModel|null
     * @throws Exception
     */
    public function getRoute($id): ?AdminRouteModel
    {
        /** @var AdminRouteModel $model */
        $model = parent::get()
            ->where('is_delete', false)
            ->where('id', $id)
            ->getStatement()
            ->fetch($this->getModelOrClass());

        return $model;
    }

    /**
     * 获取列表查询对象
     * @param RouteListCondition $condition
     * @return Driver|Mysql
     * @throws Exception
     */
    private function getRouteListSelect(RouteListCondition $condition)
    {
        $select = parent::get();

        if (!empty($condition->getKeyword())) {

            $keyName = $select->getOptionsKey('keyword');

            $select->addOptions("%{$condition->getKeyword()}%", $keyName);

            $select->where("(concat(id,ifnull(route,''),ifnull(remark,''))) LIKE :{$keyName} ");
        }

        if (!empty($condition->getType())) $select->where("type", $condition->getType());

        if (!empty($condition->getStartTime())) $select->where("created_time", $condition->getStartTime(), '>=:');

        if (!empty($condition->getEndTime())) $select->where("created_time", $condition->getEndTime(), '<:');

        return $select->where('is_delete', false);
    }


    /**
     * 获取Route list
     * @param RouteListCondition $condition
     * @return array
     * @throws Exception
     */
    public function getRouteList(RouteListCondition $condition): array
    {
        $rid = $this->getCacheId();

        if ($condition->getIsCache()) {
            $list = RedisCacheService::getInstance()->get($rid);

            if (!empty($list)) return $list;
        }

        $select = $this->getRouteListSelect($condition);

        $list = $select->order($condition->getOrderName(), $condition->getOrderType())
            ->getStatement()
            ->fetchAll();

        if (empty($list)) return [];

        if ($condition->getIsCache()) {
            RedisCacheService::getInstance()->add($rid, $list);
        }

        return $list;
    }


}