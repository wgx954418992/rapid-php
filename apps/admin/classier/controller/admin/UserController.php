<?php

namespace apps\admin\classier\controller\admin;

use apps\admin\classier\context\WebContext;
use apps\admin\classier\service\admin\UserService;
use apps\core\classier\config\BaseConfig;
use Exception;
use rapidPHP\modules\common\classier\RESTFulApi;
use function rapidPHP\B;

/**
 * Class UserController
 * @route /admin/user
 * @package apps\admin\classier\controller\admin
 */
class UserController extends ValidaAdminController
{

    /**
     * @var UserService
     */
    protected $userService;

    /**
     * UserController constructor.
     * @param WebContext $context
     * @throws Exception
     */
    public function __construct(WebContext $context)
    {
        parent::__construct($context);

        $this->userService = new UserService(parent::getCurrentAdmin());
    }

    /**
     * 删除用户
     * @route /{userId}/del
     * @method post
     * @typed api
     * @param $userId
     * @return RESTFulApi
     * @throws Exception
     */
    public function del($userId)
    {
        $this->userService->del($userId);

        return RESTFulApi::success(null, '删除成功');
    }

    /**
     * 恢复用户
     * @route /{userId}/recover
     * @method post
     * @typed api
     * @param $userId
     * @return RESTFulApi
     * @throws Exception
     */
    public function recover($userId)
    {
        $this->userService->recover($userId);

        return RESTFulApi::success(null, '恢复成功');
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
        $list = $this->userService->getLogList($userId);

        $loginTypes = [
            BaseConfig::LOGIN_MODE_ACCOUNT => '账号登录',
            BaseConfig::LOGIN_MODE_CODE => '验证码登录',
            BaseConfig::LOGIN_MODE_MINI => '验证码登录',
        ];

        foreach ($list as $index => $value) {
            $mode = $value->getMode();

            $loginType = B()->getData($loginTypes, $mode);

            $value->setMode($loginType);
        }

        return ['list' => $list];
    }
}