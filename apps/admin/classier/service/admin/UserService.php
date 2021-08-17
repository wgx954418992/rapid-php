<?php

namespace apps\admin\classier\service\admin;

use apps\admin\classier\bean\UserListCondition;
use apps\admin\classier\wrapper\UserWrapper;
use apps\core\classier\dao\master\user\LogDao;
use apps\core\classier\dao\master\UserDao;
use apps\core\classier\service\UserService as CoreUserService;
use Exception;
use rapidPHP\modules\common\classier\Instances;
use ReflectionException;
use function rapidPHP\M;

class UserService
{

    /**
     * 单例模式
     */
    use Instances;

    /**
     * 初始化当前
     * @return static
     */
    public static function onNotInstance()
    {
        return new static();
    }

    /**
     * 获取用户列表
     * @param UserListCondition $condition
     * @return array
     * @throws ReflectionException
     * @throws Exception
     */
    public function getList(UserListCondition $condition)
    {
        /** @var UserDao $userDao */
        $userDao = UserDao::getInstance();

        $list = $userDao->getUserList($condition);

        /** @var LogDao $logDao */
        $logDao = LogDao::getInstance();

        foreach ($list as $index => $value) {

            $value = CoreUserService::getInstance()->updateUser($value);

            $userModel = new UserWrapper($value->toData());

            $loginCount = $logDao->getLoginCount($userModel->getId());

            $userModel->setLoginCount($loginCount);

            $list[$index] = $userModel;
        }

        return $list;
    }

    /**
     * 获取用户列表查询总数量
     * @param UserListCondition $condition
     * @return int
     * @throws ReflectionException
     * @throws Exception
     */
    public function getListCount(UserListCondition $condition)
    {
        /** @var UserDao $userDao */
        $userDao = UserDao::getInstance();

        return $userDao->getUserListCount($condition);
    }


    /**
     * 获取登录记录
     * @param $userId
     * @return array
     * @throws ReflectionException
     * @throws Exception
     */
    public function getLogList($userId)
    {
        if (empty($userId)) throw new Exception('userid 错误!');

        /** @var LogDao $logDao */
        $logDao = LogDao::getInstance();

        return $logDao->getLogList($userId);
    }
}
