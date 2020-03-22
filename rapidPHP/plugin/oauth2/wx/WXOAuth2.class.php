<?php

namespace rapidPHP\plugin\oauth2\wx;

use Exception;
use rapidPHP\config\plugin\oauth2\WXOAuth2Config;
use rapidPHP\library\AB;
use rapidPHP\plugin\oauth2\OAuth2;
use rapidPHP\plugin\oauth2\OAuth2UserModel;

class WXOAuth2 extends OAuth2
{

    /**
     * 获取微信扫码登录uuid  (仅支持开放平台)
     * 应用授权作用域，拥有多个作用域用逗号（,）分隔，网页应用目前仅填写snsapi_login即
     * @param string $scope
     * 用于保持请求和回调的状态，授权请求后原样带回给第三方。该参数可用于防止csrf攻击（跨站请求伪造攻击），建议第三方带上该参数，可设置为简单的随机数加session进行校验
     * @param string $state
     * @return string
     * @throws Exception
     */
    public function getQRConnectUuid(string $scope = 'snsapi_login', string $state = ''): string
    {
        $url = WXOAuth2Config::getQRConnectCodeUrl($this->getAppId(), $this->getCallUrl(), $scope, $state);

        $httpResponse = B()->getHttpResponse($url);

        if (empty($httpResponse)) throw new Exception('请求失败!');

        $uuid = B()->getRegular('#\/connect\/qrcode\/(.*?)"#i', $httpResponse);

        if (empty($uuid)) throw new Exception('uuid获取失败!');

        return $uuid;
    }

    /**
     * 通过code获取小程序的open信息（仅支持小程序）
     * @param $code
     * @return AB
     * @throws Exception
     */
    public function getMiniOpenInfoByCode($code)
    {
        if (empty($code)) throw new Exception('code 错误!');

        $url = WXOAuth2Config::getMiniOpenInfoByCode($this->getAppId(), $this->getSecret(), $code);

        $openInfo = $this->sendHttpRequest($url);

        if ($openInfo->hasName('errcode')) throw new Exception($openInfo->getString('errmsg'));

        return $openInfo;
    }


    /**
     * 获取网页授权access 信息，openId跟access_token
     * @param $code
     * @return AB
     * @throws Exception
     */
    public function getAccessInfo(string $code): AB
    {
        $accessInfo = $this->sendHttpRequest(WXOAuth2Config::getAccessTokenUrl($this->getAppId(), $this->getSecret(), $code));

        if ($accessInfo->hasName('errmsg')) throw new Exception($accessInfo->getString('errmsg'));

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
        return WXOAuth2Config::getCodeUrl($this->getAppId(), $this->getCallUrl(), $scope, $state);
    }

    /**
     * 获取用户信息
     * @param string $code
     * @return OAuth2UserModel
     * @throws Exception
     */
    public function getUserInfo(string $code): OAuth2UserModel
    {
        if (empty($code)) throw new Exception('code 错误!');

        $accessInfo = $this->getAccessInfo($code);

        if ($accessInfo->isEmpty()) throw new Exception("accessInfo 获取失败!");

        $openId = $accessInfo->getString('openid');

        $accessToken = $accessInfo->getString('access_token');

        $userInfo = $this->sendHttpRequest(WXOAuth2Config::getUserInfoUrl($accessToken, $openId));

        if ($userInfo->isEmpty()) throw new Exception("用户信息获取失败!");

        if ($userInfo->hasName('errmsg')) throw new Exception($userInfo->getString('errmsg'));

        $oauth2Info = new OAuth2UserModel($openId);

        $oauth2Info->setUnionId($userInfo->getString('unionId'));

        $oauth2Info->setNickname($userInfo->getString('nickname'));

        $oauth2Info->setHeader($userInfo->getString('headimgurl'));

        $oauth2Info->setSex($userInfo->getInt('sex'));

        $oauth2Info->setLanguage($userInfo->getString('language'));

        $oauth2Info->setCountry($userInfo->getString('country'));

        $oauth2Info->setProvince($userInfo->getString('province'));

        $oauth2Info->setCity($userInfo->getString('city'));

        $oauth2Info->setYear(intval(B()->getDate(time(), 'Y')));

        return $oauth2Info;
    }
}