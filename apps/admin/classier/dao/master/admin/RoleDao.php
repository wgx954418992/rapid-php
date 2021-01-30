<?php

namespace apps\admin\classier\dao\master\admin;

use apps\admin\classier\bean\RoleListCondition;
use apps\core\classier\dao\MasterDao;
use apps\core\classier\model\AdminRoleModel;
use apps\core\classier\service\RedisCacheService;
use Exception;
use rapidPHP\modules\database\sql\classier\Driver;
use rapidPHP\modules\database\sql\classier\driver\Mysql;
use function rapidPHP\Cal;

class RoleDao extends MasterDao
{
    /**
     * RoleDao constructor.
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct(AdminRoleModel::class);
    }

    /**
     * @param $adminId
     * @return string
     */
    private function getCacheId($adminId): string
    {
        return $this->getRId('admin.role.' . $adminId);
    }

    /**
     * 添加Role
     * @param AdminRoleModel $roleModel
     * @return bool
     * @throws Exception
     */
    public function addRole(AdminRoleModel $roleModel): bool
    {
        $result = parent::add([
            'admin_id' => $roleModel->getAdminId(),
            'route_id' => $roleModel->getRouteId(),
            'is_delete' => false,
            'created_id' => $roleModel->getCreatedId(),
            'created_time' => Cal()->getDate(),
        ], $id);

        if ($result) {
            $roleModel->setId($id);

            RedisCacheService::getInstance()->remove($this->getCacheId($roleModel->getAdminId()));
        }

        return $result;
    }

    /**
     * set Role
     * @param AdminRoleModel $roleModel
     * @return bool
     * @throws Exception
     */
    public function setRole(AdminRoleModel $roleModel): bool
    {
        $result = parent::set([
            'admin_id' => $roleModel->getAdminId(),
            'route_id' => $roleModel->getRouteId(),
            'updated_id' => $roleModel->getUpdatedId(),
            'updated_time' => Cal()->getDate(),
        ])->where('id', $roleModel->getId())->execute();

        if ($result) {
            RedisCacheService::getInstance()->remove($this->getCacheId($roleModel->getAdminId()));
        }

        return $result;
    }

    /**
     * 删除role 通过管理员
     * @param $adminId
     * @return bool
     * @throws Exception
     */
    public function delRoleByAdmin($adminId): bool
    {
        $result = parent::del()->where('admin_id', $adminId)->execute();

        if ($result) {
            RedisCacheService::getInstance()->remove($this->getCacheId($adminId));
        }

        return $result;
    }

    /**
     * 获取Role信息
     * @param $id
     * @return AdminRoleModel|null
     * @throws Exception
     */
    public function getRole($id): ?AdminRoleModel
    {
        /** @var AdminRoleModel $model */
        $model = parent::get()
            ->where('is_delete', false)
            ->where('id', $id)
            ->getStatement()
            ->fetch($this->getModelOrClass());

        return $model;
    }

    /**
     * 获取列表查询对象
     * @param RoleListCondition $condition
     * @return Driver|Mysql
     * @throws Exception
     */
    private function getRoleListSelect(RoleListCondition $condition)
    {
        $select = parent::get();

        if (!empty($condition->getKeyword())) {

            $keyName = $select->getOptionsKey('keyword');

            $select->addOptions("%{$condition->getKeyword()}%", $keyName);

            $select->where("(concat(id,route_id)) LIKE :{$keyName} ");
        }

        if (!empty($condition->getStartTime())) $select->where("created_time", $condition->getStartTime(), '>=:');

        if (!empty($condition->getEndTime())) $select->where("created_time", $condition->getEndTime(), '<:');

        return $select->where('is_delete', false)
            ->where('admin_id', $condition->getAdminId());
    }

    /**
     * @param RoleListCondition $condition
     * @return array
     * @throws Exception
     */
    public function getRoleList(RoleListCondition $condition): array
    {
        $rid = $this->getCacheId($condition->getAdminId());

        $list = RedisCacheService::getInstance()->get($rid);

        if (!empty($list)) return $list;

        $select = $this->getRoleListSelect($condition);

        $list = $select->order($condition->getOrderName(), $condition->getOrderType())
            ->getStatement()
            ->fetchAll();

        if (empty($list)) return [];

        RedisCacheService::getInstance()->add($rid, $list);

        return $list;
    }
}