<?php

namespace apps\admin\classier\controller\admin;

use apps\admin\classier\bean\UserListCondition;
use apps\admin\classier\service\admin\UserService;
use apps\core\classier\helper\CommonHelper;
use Exception;
use ReflectionException;

/**
 * Class UserController
 * @route /admin/user
 * @package apps\admin\classier\controller\admin
 */
class UserController extends ValidaAdminController
{

    /**
     * 用户列表
     * @route /list
     * @typed auto
     * @template admin/user/list
     * @param UserListCondition $condition
     * @return array
     * @throws ReflectionException
     * @throws Exception
     */
    public function list(UserListCondition $condition)
    {
        $list = UserService::getInstance()->getList($condition);

        $count = UserService::getInstance()->getListCount($condition);

        $pager = CommonHelper::pager($count, $condition->getPage(), $condition->getSize());

        return [
            'condition' => $condition,
            'count' => $count,
            'pager' => $pager,
            'list' => $list,
        ];
    }

    /**
     * 登录记录
     * @route /{userId}/logs
     * @template admin/user/logs
     * @param $userId
     * @return array
     * @throws Exception
     */
    public function logs($userId)
    {
        $list = UserService::getInstance()->getLogList($userId);

        return ['list' => $list];
    }

    /**
     * 书信列表
     * @route /{userId}/letter
     * @template admin/user/letter
     * @param $userId
     * @return array
     * @throws Exception
     */
    public function letter($userId)
    {
        $list = UserService::getInstance()->getLetterList($userId);

        return ['list' => $list];
    }
}
