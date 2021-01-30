<?php

namespace apps\app\classier\service;


use apps\core\classier\config\ErrorConfig;
use apps\core\classier\context\PathContextInterface;
use apps\core\classier\dao\master\TokenDao;
use apps\core\classier\dao\master\UserDao;
use apps\core\classier\service\BaseService as CoreBaseService;
use apps\core\classier\wrapper\UserWrapper;
use Exception;

class BaseService extends CoreBaseService
{

    /**
     * 效验用户是否登录
     * @param UserWrapper|null $userModel
     * @throws Exception
     */
    public static function validaUserModel(?UserWrapper $userModel)
    {
        if ($userModel == null)
            throw new Exception('请先登录!', ErrorConfig::USER_LOGIN_NOT);
    }

    /**
     * 通过token获取用户信息
     * @param $token
     * @param PathContextInterface $pathContext
     * @return UserWrapper
     * @throws Exception
     */
    public function getUserByToken($token, PathContextInterface $pathContext): UserWrapper
    {
        if (empty($token)) throw new Exception('请先登录!');

        $tokenDao = TokenDao::getInstance();

        if (!$userId = $tokenDao::getInstance()->getTokenBindId($token))
            throw new Exception('你的帐号已在异地登录,如果不是本人登录，请修改密码后，重新登录!');

        $userDao = UserDao::getInstance();

        $userModel = $userDao->getUser($userId);

        if ($userModel == null) throw new Exception('帐号不存在!');

        return $this->updateUser($userModel, $pathContext);
    }
}