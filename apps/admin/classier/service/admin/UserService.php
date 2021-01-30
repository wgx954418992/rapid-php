<?php

namespace apps\admin\classier\service\admin;

use apps\core\classier\dao\master\user\LogDao;
use apps\core\classier\dao\master\UserDao;
use apps\core\classier\model\UserLogModel;
use Exception;

class UserService extends ValidaAdminService
{

    /**
     * 删除用户
     * @param $userId
     * @return bool
     * @throws Exception
     */
    public function del($userId): bool
    {
        if (empty($userId)) throw new Exception('userid 错误!');

        /** @var UserDao $userDao */
        $userDao = UserDao::getInstance();

        if (!$userDao->delUser($userId, parent::getAdminId()))
            throw new Exception('删除失败!');

        return true;
    }

    /**
     * 恢复用户
     * @param $userId
     * @return bool
     * @throws Exception
     */
    public function recover($userId): bool
    {
        if (empty($userId)) throw new Exception('userid 错误!');

        /** @var UserDao $userDao */
        $userDao = UserDao::getInstance();

        if (!$userDao->recover($userId, parent::getAdminId()))
            throw new Exception('恢复失败!');

        return true;
    }

    /**
     * 获取登录记录
     * @param $userId
     * @return UserLogModel[]
     * @throws Exception
     */
    public function getLogList($userId): array
    {
        if (empty($userId)) throw new Exception('userid 错误!');

        /** @var LogDao $logDao */
        $logDao = LogDao::getInstance();

        return $logDao->getLogList($userId);
    }
}