<?php

namespace apps\app\classier\controller;

use apps\app\classier\service\PhoneLoginService;
use apps\app\classier\service\WechatLoginService;
use apps\core\classier\config\wechat\MiniConfig;
use apps\core\classier\enum\CodeType;
use apps\core\classier\enum\LoginType;
use apps\core\classier\helper\CommonHelper;
use apps\core\classier\model\OAuth2WeixinModel;
use apps\core\classier\service\VerifyCodeService;
use Exception;
use oauth2\wx\classier\Mini;
use rapidPHP\modules\common\classier\RESTFulApi;
use ReflectionException;

/**
 * Class LoginController
 * @package apps\app\classier\controller
 */
class LoginController extends BaseController
{

    /**
     * 验证码登录
     * @route /login/code
     * @method post
     * @param $telephone
     * @param $code
     * @param null $recommendUid
     * @return RESTFulApi
     * @throws ReflectionException
     * @throws Exception
     */
    public function loginByCode($telephone, $code, $recommendUid = null)
    {

        if (empty($telephone)) throw new Exception('手机号码不能为空!');

        if (empty($code)) throw new Exception('验证码不能为空!');

        $telephone = CommonHelper::validTelephone($telephone);

        VerifyCodeService::getInstance()
            ->checkCode($telephone, CodeType::i(CodeType::LOGIN), $code);

        $token = PhoneLoginService::getInstance()
            ->loginByPhone(
                $telephone,
                LoginType::i(LoginType::CODE),
                $this->getIp(),
                $this->getRequest()->getUserAgent(),
                $recommendUid
            );

        return RESTFulApi::success($token);
    }

    /**
     * 微信登录后回调，通过code自动注册然后登录并获取token
     * @route /login/wechat
     * @param $code
     * @param array|null $userinfo post json
     * @param null $recommendUid
     * @return RESTFulApi
     * @throws ReflectionException
     * @throws Exception
     * @method get
     * @method post
     * @typed api
     */
    public function loginByWechat($code, ?array $userinfo, $recommendUid = null)
    {
        if (empty($code)) throw new Exception('code 错误');

        if (empty($userinfo)) throw new Exception('userinfo 错误');

        $config = MiniConfig::getInstance();

        $mini = new Mini($config->getAppId(), $config->getSecret());

        $oauth2Model = $mini->getUserInfo($code, array_merge($userinfo, [
            'appId' => $mini->getAppId()
        ]));

        $WXUserModel = new OAuth2WeixinModel();

        $WXUserModel->setOpenId($oauth2Model->getOpenId());

        $WXUserModel->setUnionId($oauth2Model->getUnionId());

        $WXUserModel->setNickname($oauth2Model->getNickname());

        $WXUserModel->setHeadimgurl($oauth2Model->getHeader());

        $WXUserModel->setGender($oauth2Model->getGender());

        $WXUserModel->setCountry($oauth2Model->getCountry());

        $WXUserModel->setLanguage($oauth2Model->getLanguage());

        $WXUserModel->setProvince($oauth2Model->getProvince());

        $WXUserModel->setCity($oauth2Model->getCity());

        $token = WechatLoginService::getInstance()
            ->loginByWechat(
                $WXUserModel,
                new LoginType(LoginType::WX_MINI),
                $this->getIp(),
                $this->getRequest()->getUserAgent(),
                $recommendUid
            );

        return RESTFulApi::success($token);
    }


    /**
     * 微信小程序通过授权手机号码进行登录
     * @route /login/mini/phone
     * @param $code
     * @param $iv
     * @param $encryptedData
     * @param null $recommendUid
     * @return RESTFulApi
     * @throws ReflectionException
     * @throws Exception
     * @method get
     * @method post
     * @typed api
     */
    public function loginByMiniPhone($code, $iv, $encryptedData, $recommendUid = null)
    {
        if (empty($code)) throw new Exception('code 错误');

        if (empty($iv)) throw new Exception('iv 错误');

        if (empty($encryptedData)) throw new Exception('encryptedData 错误');

        $config = MiniConfig::getInstance();

        $mini = new Mini($config->getAppId(), $config->getSecret());

        $telephone = $mini->getPhoneNumber($code, [
            'iv' => rawurldecode($iv),
            'encryptedData' => rawurldecode($encryptedData),
            'appId' => $mini->getAppId(),
        ]);

        $token = PhoneLoginService::getInstance()
            ->loginByPhone(
                $telephone,
                LoginType::i(LoginType::CODE),
                $this->getIp(),
                $this->getRequest()->getUserAgent(),
                $recommendUid
            );

        return RESTFulApi::success($token);
    }


}
