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
use function rapidPHP\B;
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
     * @param $adminId
     * @param AppAdminModel $adminModel
     * @return bool
     * @throws Exception
     */
    public function addAdmin($adminId, AppAdminModel $adminModel): bool
    {
        return parent::add([
            'id' => B()->onlyIdToInt(),
            'username' => $adminModel->getUsername(),
            'password' => SaltConfig::getSaltPsw($adminModel->getPassword()),
            'is_supreme' => $adminModel->getIsSupreme(),
            'remark' => $adminModel->getRemark(),
            'type' => $adminModel->getType(),
            'is_delete' => false,
            'created_id' => $adminId,
            'created_time' => Cal()->getDate(),
        ]);
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
     * 修改密码
     * @param $adminId
     * @param $password
     * @return bool
     * @throws Exception
     */
    public function setPassword($adminId, $password): bool
    {
        return parent::set([
            'password' => SaltConfig::getSaltPsw($password),
            'updated_id' => $adminId,
            'updated_time' => Cal()->getDate()
        ])->where('id', $adminId)
            ->execute();
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
     * @param $adminId
     * @param AppAdminModel $adminModel
     * @return bool
     * @throws Exception
     */
    public function setAdmin($adminId, AppAdminModel $adminModel): bool
    {
        return parent::set([
            'id' => B()->onlyIdToInt(),
            'username' => $adminModel->getUsername(),
            'password' => md5($adminModel->getPassword()),
            'is_supreme' => $adminModel->getIsSupreme(),
            'remark' => $adminModel->getRemark(),
            'type' => $adminModel->getType(),
            'updated_id' => $adminId,
            'updated_time' => Cal()->getDate()
        ])->where('id', $adminModel->getId())
            ->execute();
    }

    /**
     * 获取管理员列表查询对象
     * @param $adminId
     * @param AdminListCondition $condition
     * @return Driver|Mysql
     * @throws Exception
     */
    private function getAdminListSelect($adminId, AdminListCondition $condition)
    {
        $select = parent::get();

        if (!empty($condition->getKeyword())) {

            $keyName = $select->getOptionsKey('keyword');

            $select->addOptions("%{$condition->getKeyword()}%", $keyName);

            $select->where("(concat(id,nickname,username)) LIKE :{$keyName} ");
        }

        if (!empty($condition->getType())) $select->where("type", $condition->getType());

        if (!empty($condition->getStartTime())) $select->where("created_time", $condition->getStartTime(), '>=:');

        if (!empty($condition->getEndTime())) $select->where("created_time", $condition->getEndTime(), '<:');

        return $select->where('is_delete', false)
            ->where('parent_id', $adminId);
    }


    /**
     * 获取管理员列表
     * @param $adminId
     * @param AdminListCondition $condition
     * @return array
     * @throws Exception
     */
    public function getAdminList($adminId, AdminListCondition $condition): array
    {
        $select = $this->getAdminListSelect($adminId, $condition);

        $select->limit($condition->getPage(), BaseConfig::PAGE_SIZE_DEFAULT);

        return $select->order($condition->getOrderName(), $condition->getOrderType())
            ->getStatement()
            ->fetchAll($this->getModelOrClass());
    }

    /**
     * 获取管理员列表查询总数量
     * @param $adminId
     * @param AdminListCondition $condition
     * @return int
     * @throws Exception
     */
    public function getAdminListCount($adminId, AdminListCondition $condition): int
    {
        $select = $this->getAdminListSelect($adminId, $condition);

        return (int)$select->resetSql('select')
            ->select('count(id) as count')
            ->getStatement()
            ->fetchValue('count');
    }
}