<?php

namespace apps\admin\classier\dao\master;

use apps\admin\classier\bean\AdminListCondition;
use apps\admin\classier\enum\admin\Type;
use apps\core\classier\dao\MasterDao;
use apps\core\classier\helper\CommonHelper;
use apps\core\classier\model\AppAdminModel;
use apps\admin\classier\wrapper\AdminWrapper;
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

        if ($adminModel->getHeadFid()) $data['head_fid'] = $adminModel->getHeadFid();

        if ($adminModel->getParentId()) $data['parent_id'] = $adminModel->getParentId();

        if ($adminModel->getPassword()) $data['password'] = CommonHelper::getSaltPsw($adminModel->getPassword());

        return $this->add($data);
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
            'remark' => $adminModel->getRemark(),
            'type' => $adminModel->getType(),
            'updated_id' => $adminModel->getUpdatedId(),
            'updated_time' => Cal()->getDate()
        ];

        if (!is_null($adminModel->getIsSupreme())){
            $data['is_supreme'] = $adminModel->getIsSupreme();
        }

        if ($adminModel->getHeadFid()) $data['head_fid'] = $adminModel->getHeadFid();

        if ($adminModel->getParentId()) $data['parent_id'] = $adminModel->getParentId();

        if ($adminModel->getPassword()) $data['password'] = CommonHelper::getSaltPsw($adminModel->getPassword());

        return $this->set($data)
            ->where('id', $adminModel->getId())
            ->execute();
    }

    /**
     * 删除admin
     * @param AppAdminModel $adminModel
     * @return bool
     * @throws Exception
     */
    public function delAdmin(AppAdminModel $adminModel): bool
    {
        return $this->set([
            'is_delete' => true,
            'updated_id' => $adminModel->getUpdatedId(),
            'updated_time' => Cal()->getDate()
        ])->where('id', $adminModel->getId())->execute();
    }

    /**
     * 获取admin 信息
     * @param $adminId
     * @return AdminWrapper|null
     * @throws Exception
     */
    public function getAdmin($adminId): ?AdminWrapper
    {
        return $this->get()
            ->where('id', $adminId)
            ->where('is_delete', false)
            ->getStatement()
            ->fetch(AdminWrapper::class);
    }

    /**
     * 通过账号获取admin信息
     * @param $username
     * @return AdminWrapper
     * @throws Exception
     */
    public function getAdminByUsername($username): ?AdminWrapper
    {
        return $this->get()
            ->where('username', $username)
            ->where('is_delete', false)
            ->getStatement()
            ->fetch(AdminWrapper::class);
    }

    /**
     * 通过账号密码获取admin信息
     * @param $username
     * @param $password
     * @param $type
     * @return AdminWrapper|null
     * @throws Exception
     */
    public function getAdminByUP($username, $password, $type): ?AdminWrapper
    {
        return $this->get()
            ->where('username', $username)
            ->where('password', CommonHelper::getSaltPsw($password))
            ->where('type', $type)
            ->where('is_delete', false)
            ->getStatement()
            ->fetch(AdminWrapper::class);
    }

    /**
     * 获取全部管理员
     * @param Type|null $type
     * @return AdminWrapper[]
     * @throws Exception
     */
    public function getAllAdmin(?Type $type = null)
    {
        $select = $this->get();

        if (!is_null($type)) $select->where('type', $type->getRawValue());

        return (array)$select
            ->where('is_delete', false)
            ->getStatement()
            ->fetchAll(AdminWrapper::class);
    }


    /**
     * 获取管理员列表查询对象
     * @param AdminListCondition $condition
     * @return Driver|Mysql
     * @throws Exception
     */
    private function getAdminListSelect(AdminListCondition $condition)
    {
        $select = $this->get();

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

        $select->limit($condition->getPage(), $condition->getSize());

        return (array)$select
            ->order($condition->getOrderName(), $condition->getOrderType())
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
        return (int)$this->get('count(id) as count')
            ->where('is_delete', false)
            ->where('parent_id', $adminId)
            ->getStatement()
            ->fetchValue('count');
    }

    /**
     * 设置是否超级管理员
     * @param AppAdminModel $adminModel
     * @return bool
     * @throws Exception
     */
    public function setIsSupreme(AppAdminModel $adminModel)
    {
        return $this->set([
            'is_supreme' => $adminModel->getIsSupreme(),
            'updated_id' => $adminModel->getUpdatedId(),
            'updated_time' => Cal()->getDate()
        ])->where('id', $adminModel->getId())->execute();
    }

}
