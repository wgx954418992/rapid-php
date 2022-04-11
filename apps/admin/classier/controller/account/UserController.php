<?php

namespace apps\admin\classier\controller\account;

use apps\core\classier\bean\UserListCondition;
use apps\core\classier\model\AppUserModel;
use apps\core\classier\options\UserOptions;
use apps\core\classier\service\LoginService;
use apps\admin\classier\service\UserService;
use apps\core\classier\helper\CommonHelper;
use apps\core\classier\wrapper\UserWrapper;
use Exception;
use rapidPHP\modules\common\classier\RESTFulApi;
use ReflectionException;

/**
 * Class UserController
 * @route /account/user
 * @package apps\admin\classier\controller\account
 */
class UserController extends ValidaAccountController
{

    /**
     * 用户列表
     * @route /list
     * @typed auto
     * @access USER:LIST
     * @template account/user/list
     * @param UserListCondition $condition
     * @return array
     * @throws ReflectionException
     * @throws Exception
     */
    public function list(UserListCondition $condition)
    {
        if (is_null($condition->getOptions())) {
            $condition->setOptions(UserOptions::PRIVATE | UserOptions::INTEGRAL | UserOptions::SPECIFIC_MAJOR );
        }

        $list = UserService::getInstance()->getUserList($condition);

        $count = UserService::getInstance()->getUserListCount($condition);

        $pager = CommonHelper::pager($count, $condition->getPage(), $condition->getSize());

        $condition->setOptions(null);

        return [
            'condition' => $condition,
            'count' => $count,
            'pager' => $pager,
            'list' => $list,
        ];
    }

    /**
     * 删除用户
     * @route /{userId}/del
     * @access USER:DEL
     * @method post
     * @param $userId
     * @return RESTFulApi
     * @throws Exception
     */
    public function delUser($userId): RESTFulApi
    {
        $userModel = UserService::getInstance()->getUser($userId);

        $userModel->setUpdatedId($this->getAccountId());

        UserService::getInstance()->delUser($userModel);

        return RESTFulApi::success(null, '删除成功');
    }

    /**
     * 添加编辑用户
     * @route /added
     * @typed auto
     * @access USER:ADDED
     * @template account/user/added
     * @param $submit
     * @param AppUserModel $model
     * @return UserWrapper
     * @throws Exception
     */
    public function addedUser($submit, AppUserModel $model)
    {
        if (!empty($submit)) {

            if ($model->getId()) {
                $model->setUpdatedId(parent::getAccountId());
            } else {
                $model->setCreatedId(parent::getAccountId());
            }

            $userModel = new UserWrapper(UserService::getInstance()->addedUser($model)->toData());

            UserService::getInstance()->setUserOptions($userModel, UserOptions::i(UserOptions::PRIVATE));
        } else {
            if (!empty($model->getId())) {
                $userModel = UserService::getInstance()->getUser($model->getId(), null, UserOptions::i(UserOptions::PRIVATE));
            } else {
                $userModel = new UserWrapper();
            }
        }

        return $userModel;
    }

    /**
     * 登录记录
     * @route /{userId}/logs
     * @access USER:LOGIN:LOGS
     * @template account/user/logs
     * @param $userId
     * @return array
     * @throws Exception
     */
    public function getLoginLogs($userId)
    {
        $list = LoginService::getInstance()->getLogList($userId);

        return ['list' => $list];
    }
}
