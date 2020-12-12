<?php

namespace apps\app\classier\dao\master;

use apps\app\classier\dao\MasterDao;
use apps\app\classier\model\AppUserModel;
use Exception;
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
        return parent::add([
            'id' => $userModel->getId(),
            'telephone' => $userModel->getTelephone(),
            'password' => $userModel->getPassword(),
            'nickname' => $userModel->getNickname(),
            'birthday' => $userModel->getBirthday(),
            'register_ip' => $userModel->getRegisterIp(),
            'is_delete' => 0,
            'created_id' => $userModel->getId(),
            'created_time' => Cal()->getDate(),
        ]);
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
            ->where('is_delete', 0)
            ->where('telephone', $telephone)
            ->getStatement()
            ->fetch($this->getModelOrClass());

        return $model;
    }
}