<?php

namespace apps\app\classier\controller;

use apps\app\classier\service\UserService;
use apps\core\classier\config\MiniConfig;
use apps\core\classier\model\UserWeixinModel;
use Exception;
use oauth2\wx\classier\Mini;
use rapidPHP\modules\common\classier\RESTFulApi;

/**
 * Class UserController
 * @package apps\app\classier\controller
 */
class UserController extends BaseController
{

    /**
     * 微信登录后回调，通过code自动注册然后登录并获取token
     * @route /wx/mini/login
     * @param $code
     * @param array|null $userinfo post json
     * @method get
     * @method post
     * @typed api
     * @return RESTFulApi
     * @throws Exception
     */
    public function loginByMini($code, ?array $userinfo)
    {
        if (empty($code)) throw new Exception('code 错误');

        if (empty($userinfo)) throw new Exception('userinfo 错误');

        $oauth2 = new Mini(MiniConfig::APPID, MiniConfig::SECRET);

        $oauth2Model = $oauth2->getUserInfo($code, array_merge($userinfo, [
            'appId' => $oauth2->getAppId()
        ]));

        $WXUserModel = new UserWeixinModel();

        $WXUserModel->setOpenId($oauth2Model->getOpenId());

        $WXUserModel->setUnionId($oauth2Model->getUnionId());

        $WXUserModel->setNickname($oauth2Model->getNickname());

        $WXUserModel->setHeadimgurl($oauth2Model->getHeader());

        $WXUserModel->setGender($oauth2Model->getGender());

        $WXUserModel->setCountry($oauth2Model->getCountry());

        $WXUserModel->setLanguage($oauth2Model->getLanguage());

        $WXUserModel->setProvince($oauth2Model->getProvince());

        $WXUserModel->setCity($oauth2Model->getCity());

        /** @var UserService $userService */
        $userService = UserService::getInstance();

        $token = $userService->loginByMini($WXUserModel, $this->getIp(), $this->getRequest()->getUserAgent());

        return RESTFulApi::success($token);
    }

}