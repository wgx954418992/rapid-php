<?php

namespace apps\core\classier\dao\master;

use apps\core\classier\bean\UserListCondition;
use apps\core\classier\config\BaseConfig;
use apps\core\classier\config\SaltConfig;
use apps\core\classier\config\UserConfig;
use apps\core\classier\dao\MasterDao;
use apps\core\classier\model\AppUserModel;
use apps\core\classier\wrapper\UserWrapper;
use Exception;
use rapidPHP\modules\database\sql\classier\Driver;
use rapidPHP\modules\database\sql\classier\driver\Mysql;
use function rapidPHP\Cal;

class UserDao extends MasterDao
{

    /**
     * UserDao constructor.
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct(AppUserModel::class);
    }

    /**
     * 添加用户
     * @param AppUserModel $userModel
     * @return bool
     * @throws Exception
     */
    public function addUser(AppUserModel $userModel): bool
    {
        $data = [
            'id' => $userModel->getId(),
            'nickname' => $userModel->getNickname(),
            'source' => UserConfig::SOURCE_REGISTER,
            'register_ip' => $userModel->getRegisterIp(),
            'is_delete' => false,
            'created_id' => $userModel->getCreatedId(),
            'created_time' => Cal()->getDate(),
        ];

        if (!empty($userModel->getTelephone())) {
            $data['telephone'] = $userModel->getTelephone();
        }

        if (!empty($userModel->getPassword())) {
            $data['password'] = SaltConfig::getSaltPsw($userModel->getPassword());
        }

        if (!empty($userModel->getHeadFid())) {
            $data['head_fid'] = $userModel->getHeadFid();
        }

        if (!empty($userModel->getBirthday())) {
            $data['birthday'] = $userModel->getBirthday();
        }

        return parent::add($data);
    }

    /**
     * 添加用户
     * @param AppUserModel $userModel
     * @return bool
     * @throws Exception
     */
    public function setUser(AppUserModel $userModel): bool
    {
        $data = [
            'updated_id' => $userModel->getUpdatedId(),
            'updated_time' => Cal()->getDate(),
        ];

        if (!empty($userModel->getTelephone())) {
            $data['telephone'] = $userModel->getTelephone();
        }

        if (!empty($userModel->getPassword())) {
            $data['password'] = SaltConfig::getSaltPsw($userModel->getPassword());
        }

        if (!empty($userModel->getNickname())) {
            $data['nickname'] = $userModel->getNickname();
        }

        if (!empty($userModel->getHeadFid())) {
            $data['head_fid'] = $userModel->getHeadFid();
        }

        if (!empty($userModel->getBirthday())) {
            $data['birthday'] = $userModel->getBirthday();
        }

        return parent::set($data)->where('id', $userModel->getId())->execute();
    }


    /**
     * 通过手机号码获取会员信息
     * @param $telephone
     * @return AppUserModel|null
     * @throws Exception
     */
    public function getUserByTel($telephone): ?AppUserModel
    {
        /** @var AppUserModel $model */
        $model = parent::get()
            ->where('is_delete', false)
            ->where('telephone', $telephone)
            ->getStatement()
            ->fetch($this->getModelOrClass());

        return $model;
    }

    /**
     * 通过手机号+密码获取用户信息
     * @param $telephone
     * @param $password
     * @return AppUserModel|null
     * @throws Exception
     */
    public function getUserByTP($telephone, $password): ?AppUserModel
    {
        $select = parent::get()
            ->where('is_delete', false)
            ->where('telephone', $telephone)
            ->where('password', SaltConfig::getSaltPsw($password));

        /** @var AppUserModel $model */
        $model = $select
            ->getStatement()
            ->fetch($this->getModelOrClass());

        return $model;
    }

    /**
     * 获取用户信息
     * @param $id
     * @return UserWrapper|null
     * @throws Exception
     */
    public function getUser($id): ?UserWrapper
    {
        /** @var UserWrapper $model */
        $model = parent::get()
            ->where('is_delete', false)
            ->where('id', $id)
            ->getStatement()
            ->fetch(UserWrapper::class);

        return $model;
    }

    /**
     * 更改密码
     * @param $id
     * @param $password
     * @param $updatedId
     * @return bool
     * @throws Exception
     */
    public function setPassword($id, $password, $updatedId): bool
    {
        return parent::set([
            'password' => SaltConfig::getSaltPsw($password),
            'updated_id' => $updatedId,
            'updated_time' => Cal()->getDate(),
        ])->where('id', $id)
            ->execute();
    }

    /**
     * 删除用户
     * @param $id
     * @param $updatedId
     * @return bool
     * @throws Exception
     */
    public function delUser($id, $updatedId): bool
    {
        return parent::set([
            'is_delete' => 1,
            'updated_id' => $updatedId,
            'updated_time' => Cal()->getDate(),
        ])->where('id', $id)->execute();
    }


    /**
     * 获取用户列表查询对象
     * @param UserListCondition $condition
     * @return Driver|Mysql
     * @throws Exception
     */
    private function getUserListSelect(UserListCondition $condition)
    {
        $select = parent::get();

        if (!empty($condition->getKeyword())) {

            $keyName = $select->getOptionsKey('keyword');

            $select->addOptions("%{$condition->getKeyword()}%", $keyName);

            $select->where("(concat(id,nickname,telephone,register_ip)) LIKE :{$keyName} ");
        }

        if ($condition->getIds()) $select->in('id', $condition->getIds());

        if ($condition->getType()) $select->where('type', $condition->getType());

        if ($condition->getSource()) $select->where('source', $condition->getSource());

        if (!empty($condition->getStartTime())) $select->where("created_time", $condition->getStartTime(), '>=:');

        if (!empty($condition->getEndTime())) $select->where("created_time", $condition->getEndTime(), '<:');

        return $select->where('is_delete', false);
    }


    /**
     * 获取用户列表
     * @param UserListCondition $condition
     * @return array
     * @throws Exception
     */
    public function getUserList(UserListCondition $condition): array
    {
        $select = $this->getUserListSelect($condition);

        $select->limit($condition->getPage(), BaseConfig::PAGE_SIZE_DEFAULT);

        return $select->order($condition->getOrderName(), $condition->getOrderType())
            ->getStatement()
            ->fetchAll($this->getModelOrClass());
    }

    /**
     * 获取用户列表查询总数量
     * @param UserListCondition $condition
     * @return int
     * @throws Exception
     */
    public function getUserListCount(UserListCondition $condition): int
    {
        $select = $this->getUserListSelect($condition);

        return (int)$select->resetSql('select')
            ->select('count(id) as count')
            ->getStatement()
            ->fetchValue('count');
    }

}