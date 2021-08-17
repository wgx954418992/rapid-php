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
     * cache prefix
     */
    public const CACHE_PREFIX = 'route';

    /**
     * RouteDao constructor.
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct(AdminRouteModel::class);
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
            'is_system' => $routeModel->getIsSystem(),
            'is_delete' => false,
            'created_id' => $routeModel->getCreatedId(),
            'created_time' => Cal()->getDate(),
        ];

        if ($routeModel->getParentId()) $data['parent_id'] = $routeModel->getParentId();

        if ($routeModel->getOptions()) $data['options'] = $routeModel->getOptions();

        $result = parent::add($data, $id);

        if ($result) {
            $routeModel->setId($id);

            parent::delCache($this->getCacheId('list'));
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
            'is_system' => $routeModel->getIsSystem(),
            'updated_id' => $routeModel->getUpdatedId(),
            'updated_time' => Cal()->getDate(),
        ];

        if ($routeModel->getParentId()) $data['parent_id'] = $routeModel->getParentId();

        if ($routeModel->getOptions()) $data['options'] = $routeModel->getOptions();

        $result = parent::set($data)
            ->where('id', $routeModel->getId())
            ->execute();

        if ($result) {
            parent::delCache($this->getCacheId('list'));
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
        $result = parent::del()
            ->where('id', $id)
            ->execute();

        if ($result) {
            parent::delCache($this->getCacheId('list'));
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
        return parent::get()
            ->where('is_delete', false)
            ->where('id', $id)
            ->getStatement()
            ->fetch($this->getModelOrClass());
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
        $cacheId = $this->getCacheId('list');

        if ($condition->getIsCache()) {
            $list = parent::getCache($cacheId);

            if (!empty($list)) return $list;
        }

        $select = $this->getRouteListSelect($condition);

        $list = $select->order($condition->getOrderName(), $condition->getOrderType())
            ->getStatement()
            ->fetchAll();

        if (empty($list)) return [];

        if ($condition->getIsCache()) {
            $list = parent::add($cacheId, $list);
        }

        return $list;
    }


}
