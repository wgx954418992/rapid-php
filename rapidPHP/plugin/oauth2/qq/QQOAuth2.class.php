<?php


namespace rapid\library\rapid\plugin\oauth2\qq;


use Exception;
use rapidPHP\config\plugin\oauth2\QQOAuth2Config;
use rapidPHP\library\AB;
use rapidPHP\plugin\oauth2\OAuth2;
use rapidPHP\plugin\oauth2\OAuth2UserModel;

class QQOAuth2 extends OAuth2
{

    /**
     * 获取网页授权access 信息，openId跟access_token
     * @param $code
     * @return AB
     * @throws Exception
     */
    public function getAccessInfo(string $code): AB
    {
        $accessInfo = $this->sendHttpRequest(QQOAuth2Config::getAccessTokenUrl($this->getAppId(), $this->getSecret(), $code, $this->getCallUrl()));

        if ($accessInfo->hasName('error_description')) throw new Exception($accessInfo->getString('error_description'));

        $openData = $this->sendHttpRequest(QQOAuth2Config::getOpenIdUrl($accessInfo->getString('access_token')));

        $accessInfo->setValue('openId', $openData->getString('openid'));

        $accessInfo->setValue('unionId', $openData->getString('unionid'));

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
        return QQOAuth2Config::getCode2Url($this->getAppId(), $this->getCallUrl(), $scope, $state);
    }

    /**
     * 获取qq用户信息
     * @param string $code
     * @return OAuth2UserModel
     * @throws Exception
     */
    public function getUserInfo( string $code): OAuth2UserModel
    {
        if (empty($code)) throw new Exception('code 错误!');

        $accessInfo = $this->getAccessInfo($code);

        if ($accessInfo->isEmpty()) throw new Exception("accessInfo获取失败!");

        $accessToken = $accessInfo->getString('access_token');

        $openId = $accessInfo->getString('openId');

        $url = QQOAuth2Config::getUserInfoUrl($this->getAppId(), $accessToken, $openId);

        $data = $this->sendHttpRequest($url);

        if ($data->getInt('ret') != 0) throw new Exception($data->getString('msg'));

        $oauth2Info = new OAuth2UserModel($openId);

        $oauth2Info->setUnionId($accessInfo->getString('unionId'));

        $oauth2Info->setNickname($data->getString('nickname'));

        $header = B()->contrast($data->getString('figureurl_qq_2'), $data->getString('figureurl_2'));

        $oauth2Info->setHeader($header);

        $oauth2Info->setSex($data->getString('gender'));

        $oauth2Info->setProvince($data->getString('province'));

        $oauth2Info->setCity($data->getString('city'));

        $oauth2Info->setYear($data->getInt('year'));

        $oauth2Info->setQQVipInfo($data->getData(['is_yellow_vip', 'vip', 'yellow_vip_level', 'level', 'is_yellow_year_vip']));

        return $oauth2Info;
    }
}