<?php


namespace rapid\library\rapid\plugin\oauth2\qq;


use Exception;
use rapidPHP\config\plugin\oauth2\QQOAuth2Config;
use rapidPHP\plugin\model\BaseOAuth2UserModel;
use rapidPHP\plugin\model\QQOAuth2UserModel;
use rapidPHP\plugin\oauth2\OAuth2;

class QQOAuth2 extends OAuth2
{

    /**
     * 获取网页授权access 信息，openId跟access_token
     * @param $code
     * @return array
     * @throws Exception
     */
    public function getAccessInfo(string $code): array
    {
        $accessInfo = $this->sendHttpRequest(QQOAuth2Config::getAccessTokenUrl($this->getAppId(), $this->getSecret(), $code, $this->getCallUrl()));

        if (isset($accessInfo['error_description']))
            throw new Exception(B()->getData($accessInfo, 'error_description'));

        $openData = $this->sendHttpRequest(QQOAuth2Config::getOpenIdUrl($accessInfo['access_token']));

        $accessInfo['openId'] = $openData['openid'];

        $accessInfo['unionId'] = $openData['unionid'];

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
     * @return BaseOAuth2UserModel
     * @throws Exception
     */
    public function getUserInfo(string $code): BaseOAuth2UserModel
    {
        if (empty($code)) throw new Exception('code 错误!');

        $accessInfo = $this->getAccessInfo($code);

        if (empty($accessInfo)) throw new Exception("accessInfo获取失败!");

        $accessToken = $accessInfo['access_token'];

        $openId = $accessInfo['openId'];

        $url = QQOAuth2Config::getUserInfoUrl($this->getAppId(), $accessToken, $openId);

        $data = $this->sendHttpRequest($url);

        if ($data['ret'] != 0) throw new Exception($data['msg']);

        $oauth2Info = new QQOAuth2UserModel();

        $oauth2Info->setOpenId($openId);

        $oauth2Info->setUnionId(B()->getData($accessInfo, 'unionId'));

        $oauth2Info->setNickname($data['nickname']);

        $header = B()->contrast($data['figureurl_qq_2'], $data['figureurl_2']);

        $oauth2Info->setHeader($header);

        $oauth2Info->setSex($data['gender']);

        $oauth2Info->setProvince($data['province']);

        $oauth2Info->setCity($data['city']);

        $oauth2Info->setYear($data['year']);

        $oauth2Info->setQQVipInfo(AR()->getArray($data, ['is_yellow_vip', 'vip', 'yellow_vip_level', 'level', 'is_yellow_year_vip']));

        return $oauth2Info;
    }
}