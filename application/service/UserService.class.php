<?php


namespace application\service;


use application\dao\UserDao;
use application\model\AppUserModel;
use Exception;
use ReflectionException;

class UserService extends BaseService
{

    /**
     * 获取用户信息
     * @param $userId
     * @return AppUserModel
     * @throws ReflectionException
     * @throws Exception
     */
    public function getUserInfo($userId)
    {
        if (empty($userId)) throw new Exception("用户Id错误!");

        /** @var UserDao $userDao */
        $userDao = M(UserDao::class);

        return $userDao->getUserInfo($userId);
    }

    /**
     * 添加用户
     * @param AppUserModel $userModel
     * @return AppUserModel
     * @throws ReflectionException
     * @throws Exception
     */
    public function addUser(AppUserModel $userModel)
    {
        if (empty($userModel->getNickname())) throw new Exception("nickname 错误!");

        /** @var UserDao $userDao */
        $userDao = M(UserDao::class);

        $userModel->setId(B()->onlyIdToInt());

        if (!$userDao->addUser($userModel)) throw new Exception("添加失败!");

        return $userModel;
    }

    /**
     * 事务添加用户
     * @param AppUserModel $userModel
     * @return bool
     * @throws ReflectionException
     * @throws Exception
     */
    public function addUserThing(AppUserModel $userModel)
    {
        if (empty($userId)) throw new Exception("用户Id错误!");

        /** @var UserDao $userDao */
        $userDao = M(UserDao::class);

        D()->startThing();

        try {
            $userDao->addUser($userModel);

            $userDao->addUser($userModel);

            $userDao->addUser($userModel);

            if (!D()->commit()) throw new Exception("添加失败!");
        } catch (Exception $e) {
            D()->rollBack();

            throw $e;
        }

        return true;
    }
}