<?php

namespace apps\admin\classier\service;

use apps\core\classier\bean\UserListCondition;
use apps\core\classier\dao\master\user\LogDao;
use apps\core\classier\service\UserService as CoreUserService;
use apps\admin\classier\wrapper\UserWrapper;
use Exception;
use rapidPHP\modules\common\classier\Instances;
use ReflectionException;

class UserService extends CoreUserService
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
     * @return UserWrapper[]
     * @throws ReflectionException
     * @throws Exception
     */
    public function getUserList(UserListCondition $condition)
    {
        $list = CoreUserService::getInstance()->getUserList($condition);

        /** @var LogDao $logDao */
        $logDao = LogDao::getInstance();

        foreach ($list as $index => $value) {

            $userModel = new UserWrapper($value->toData());

            $loginCount = $logDao->getLoginCount($userModel->getId());

            $userModel->setLoginCount($loginCount);

            $list[$index] = $userModel;
        }

        return $list;
    }
}
