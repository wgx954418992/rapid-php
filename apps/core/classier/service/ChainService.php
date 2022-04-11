<?php

namespace apps\core\classier\service;

use apps\core\classier\bean\RelationshipListCondition;
use apps\core\classier\dao\master\UserDao;
use apps\core\classier\wrapper\UserWrapper;
use Exception;
use rapidPHP\modules\common\classier\Instances;
use function rapidPHP\AR;

class ChainService
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
     * 获取关系列表
     * @param RelationshipListCondition $condition
     * @return UserWrapper[]
     * @throws Exception
     */
    public function getRelationshipList(RelationshipListCondition $condition)
    {
        if (empty($condition->getUserId())) throw new Exception('userId 错误！');

        if (empty($condition->getMode())) throw new Exception('mode 错误！');

        /** @var UserDao $userDao */
        $userDao = UserDao::getInstance();

        /** @var UserService $userService */
        $userService = UserService::getInstance();

        $list = $userDao->getRelationshipList($condition);

        foreach ($list as $value) {
            $userService->setUserOptions(
                $value,
                $condition->getSelfUid(),
                $condition->getSelfUid() != $value->getId() ? $condition->getUserOptions() : null
            );
        }

        return $list;
    }
}
