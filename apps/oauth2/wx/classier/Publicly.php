<?php

namespace oauth2\wx\classier;

use Exception;
use oauth2\core\classier\OAuth2;
use oauth2\wx\config\PubliclyConfig;
use oauth2\wx\model\WXUserModel;
use rapidPHP\modules\common\classier\AB;
use function rapidPHP\B;


class Publicly extends OAuth2
{

    /**
     * 获取网页授权access 信息，openId跟access_token
     * @param string $code
     * @return AB
     * @throws Exception
     */
    private function getAccessInfo(string $code)
    {
        $accessInfo = $this->sendHttpRequest(PubliclyConfig::getAccessTokenUrl($this->getAppId(), $this->getSecret(), $code));

        if ($accessInfo->toString('errmsg')) throw new Exception($accessInfo->toString('errmsg'));

        return $accessInfo;
    }

    /**
     * 获取微信授权页面url
     * 应用授权作用域，snsapi_base （不弹出授权页面，直接跳转，只能获取用户openid）
     * snsapi_userinfo （弹出授权页面，可通过openid拿到昵称、性别、所在地。并且， 即使在未关注的情况下，只要用户授权，也能获取其信息 ）
     * @param string $scope
     * 重定向后会带上state参数，开发者可以填写a-zA-Z0-9的参数值，最多128字节
     * @param string $state
     * @return string
     */
    public function getCodeUrl(string $scope = 'snsapi_userinfo', string $state = ''): string
    {
        return PubliclyConfig::getCodeUrl($this->getAppId(), $this->getCallUrl(), $scope, $state);
    }

    /**
     * 获取wx openid信息
     * @param string $code
     * @return string|null
     * @throws Exception
     */
    public function getOpenId(string $code): ?string
    {
        if (empty($code)) throw new Exception('code 错误!');

        $accessInfo = $this->getAccessInfo($code);

        if (empty($accessInfo)) throw new Exception("accessInfo 获取失败!");

        return $accessInfo->toString('openid');
    }

    /**
     * 获取用户信息
     * @param string $code
     * @param array|null $options
     * @return WXUserModel
     * @throws Exception
     */
    public function getUserInfo(string $code, ?array $options = [])
    {
        if (empty($code)) throw new Exception('code 错误!');

        $accessInfo = $this->getAccessInfo($code);

        if (empty($accessInfo)) throw new Exception("accessInfo 获取失败!");

        $openId = $accessInfo->toString('openid');

        $accessToken = $accessInfo->toString('access_token');

        $userInfo = $this->sendHttpRequest(PubliclyConfig::getUserInfoUrl($accessToken, $openId));

        if ($userInfo->toString('errmsg')) throw new Exception($userInfo->toString('errmsg'));

        $oauth2Info = new WXUserModel();

        $oauth2Info->setOpenId($openId);

        $oauth2Info->setUnionId($userInfo->toValue('unionId'));

        $oauth2Info->setNickname($userInfo->toString('nickname'));

        $oauth2Info->setHeader($userInfo->toString('headimgurl'));

        $oauth2Info->setGender($userInfo->toString('sex'));

        $oauth2Info->setLanguage($userInfo->toString('language'));

        $oauth2Info->setCountry($userInfo->toString('country'));

        $oauth2Info->setProvince($userInfo->toString('province'));

        $oauth2Info->setCity($userInfo->toString('city'));

        $oauth2Info->setPrivilege(B()->jsonDecode($userInfo->toString('privilege')));

        return $oauth2Info;
    }
}
