<?php

namespace apps\core\classier\dao\master;

use apps\core\classier\bean\AdminListCondition;
use apps\core\classier\config\BaseConfig;
use apps\core\classier\config\SaltConfig;
use apps\core\classier\dao\MasterDao;
use apps\core\classier\model\AppAdminModel;
use apps\core\classier\wrapper\AdminWrapper;
use Exception;
use rapidPHP\modules\database\sql\classier\Driver;
use rapidPHP\modules\database\sql\classier\driver\Mysql;
use function rapidPHP\Cal;

class AdminDao extends MasterDao
{

    /**
     * AdminDao constructor.
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct(AppAdminModel::class);
    }

    /**
     * 添加admin
     * @param AppAdminModel $adminModel
     * @return bool
     * @throws Exception
     */
    public function addAdmin(AppAdminModel $adminModel): bool
    {
        $data = [
            'id' => $adminModel->getId(),
            'nickname' => $adminModel->getNickname(),
            'username' => $adminModel->getUsername(),
            'is_supreme' => $adminModel->getIsSupreme(),
            'remark' => $adminModel->getRemark(),
            'type' => $adminModel->getType(),
            'is_delete' => false,
            'created_id' => $adminModel->getCreatedId(),
            'created_time' => Cal()->getDate(),
        ];

        if ($adminModel->getParentId()) $data['parent_id'] = $adminModel->getParentId();

        if ($adminModel->getPassword()) $data['password'] = SaltConfig::getSaltPsw($adminModel->getPassword());

        return parent::add($data);
    }

    /**
     * 获取admin 信息
     * @param $adminId
     * @return AdminWrapper|null
     * @throws Exception
     */
    public function getAdmin($adminId): ?AdminWrapper
    {
        /** @var AdminWrapper $model */
        $model = parent::get()
            ->where('id', $adminId)
            ->where('is_delete', false)
            ->getStatement()
            ->fetch(AdminWrapper::class);

        return $model;
    }

    /**
     * 设置是否超级管理员
     * @param $adminId
     * @param $id
     * @param $is
     * @return bool
     * @throws Exception
     */
    public function setIsSupreme($adminId, $id, $is)
    {
        return parent::set([
            'is_supreme' => $is,
            'updated_id' => $adminId,
            'updated_time' => Cal()->getDate(),
        ])->where('id', $id)->execute();
    }


    /**
     * 通过账号获取admin信息
     * @param $username
     * @return AdminWrapper
     * @throws Exception
     */
    public function getAdminByUsername($username): ?AdminWrapper
    {
        /** @var AdminWrapper $model */
        $model = parent::get()
            ->where('username', $username)
            ->where('is_delete', false)
            ->getStatement()
            ->fetch(AdminWrapper::class);

        return $model;
    }

    /**
     * 通过账号密码获取admin信息
     * @param $username
     * @param $password
     * @param $type
     * @return AdminWrapper|null
     * @throws Exception
     */
    public function getUPAdmin($username, $password, $type): ?AdminWrapper
    {
        /** @var AdminWrapper $model */
        $model = parent::get()
            ->where('username', $username)
            ->where('password', SaltConfig::getSaltPsw($password))
            ->where('type', $type)
            ->where('is_delete', false)
            ->getStatement()
            ->fetch(AdminWrapper::class);

        return $model;
    }

    /**
     * 删除admin
     * @param $adminId
     * @param $id
     * @return bool
     * @throws Exception
     */
    public function delAdmin($adminId, $id): bool
    {
        return parent::set([
            'is_delete' => true,
            'updated_id' => $adminId,
            'updated_time' => Cal()->getDate()
        ])->where('id', $id)
            ->execute();
    }


    /**
     * 修改admin
     * @param AppAdminModel $adminModel
     * @return bool
     * @throws Exception
     */
    public function setAdmin(AppAdminModel $adminModel): bool
    {
        $data = [
            'nickname' => $adminModel->getNickname(),
            'username' => $adminModel->getUsername(),
            'is_supreme' => $adminModel->getIsSupreme(),
            'remark' => $adminModel->getRemark(),
            'type' => $adminModel->getType(),
            'updated_id' => $adminModel->getUpdatedId(),
            'updated_time' => Cal()->getDate()
        ];

        if ($adminModel->getParentId()) $data['parent_id'] = $adminModel->getParentId();

        if ($adminModel->getPassword()) $data['password'] = SaltConfig::getSaltPsw($adminModel->getPassword());

        return parent::set($data)
            ->where('id', $adminModel->getId())
            ->execute();
    }

    /**
     * 获取管理员列表查询对象
     * @param AdminListCondition $condition
     * @return Driver|Mysql
     * @throws Exception
     */
    private function getAdminListSelect(AdminListCondition $condition)
    {
        $select = parent::get();

        if (!empty($condition->getKeyword())) {

            $keyName = $select->getOptionsKey('keyword');

            $select->addOptions("%{$condition->getKeyword()}%", $keyName);

            $select->where("(concat(id,nickname,username,ifnull(remark,''))) LIKE :{$keyName} ");
        }

        if (!empty($condition->getType())) $select->where("type", $condition->getType());

        if (!empty($condition->getStartTime())) $select->where("created_time", $condition->getStartTime(), '>=:');

        if (!empty($condition->getEndTime())) $select->where("created_time", $condition->getEndTime(), '<:');

        $parentName = $select->getOptionsKey('parent_id');

        $select->addOptions($condition->getAdminId(), $parentName);

        return $select->where('is_delete', false)
            ->where("(parent_id=:{$parentName} or id=:{$parentName})");
    }

    /**
     * 获取管理员列表
     * @param AdminListCondition $condition
     * @return AdminWrapper[]
     * @throws Exception
     */
    public function getAdminList(AdminListCondition $condition): array
    {
        $select = $this->getAdminListSelect($condition);

        $select->limit($condition->getPage(), BaseConfig::PAGE_SIZE_DEFAULT);

        return (array)$select->order($condition->getOrderName(), $condition->getOrderType())
            ->getStatement()
            ->fetchAll(AdminWrapper::class);
    }

    /**
     * 获取管理员列表查询总数量
     * @param AdminListCondition $condition
     * @return int
     * @throws Exception
     */
    public function getAdminListCount(AdminListCondition $condition): int
    {
        $select = $this->getAdminListSelect($condition);

        return (int)$select->resetSql('select')
            ->select('count(id) as count')
            ->getStatement()
            ->fetchValue('count');
    }

    /**
     * 获取子账号数量
     * @param $adminId
     * @return int
     * @throws Exception
     */
    public function getChildCount($adminId): int
    {
        return (int)parent::get('count(id) as count')->where('is_delete', false)
            ->where('parent_id', $adminId)
            ->getStatement()
            ->fetchValue('count');
    }
}