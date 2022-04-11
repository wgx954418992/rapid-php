<?php

namespace apps\app\classier\controller\account;


use apps\core\classier\service\UserService;
use Exception;
use rapidPHP\modules\common\classier\RESTFulApi;
use ReflectionException;

/**
 * Class AccountController
 * @route /account
 * @package apps\app\classier\controller\account
 */
class AccountController extends ValidaAccountController
{

    /**
     * 获取当前用户属性
     * @route /profile/get
     * @method get
     * @return RESTFulApi
     * @throws Exception
     */
    public function getProfile()
    {
        $userModel = $this->getCurrentUser();

        return RESTFulApi::success($userModel);
    }

    /**
     * 设置用户属性
     * @route /profile/set
     * @method post
     * @param array $profile post json
     * @return RESTFulApi
     * @throws Exception
     */
    public function setProfile(array $profile)
    {
        $profile['updated_id'] = $this->getUserId();

        UserService::getInstance()->setProfile($this->getCurrentUser(), $profile);

        return RESTFulApi::success();
    }

    /**
     * 绑定手机
     * @route /profile/telephone/bind
     * @method post
     * @param $telephone
     * @param $code
     * @return RESTFulApi
     * @throws ReflectionException
     * @throws Exception
     */
    public function bindTelephone($telephone, $code)
    {
        if (!empty($this->getCurrentUser()->getTelephone())) {
            throw new Exception('已经绑定手机号码，如需更换，请进行换绑操作');
        }

        UserService::getInstance()->bindTelephone($this->getCurrentUser(), $telephone, $code);

        return RESTFulApi::success();
    }
}
