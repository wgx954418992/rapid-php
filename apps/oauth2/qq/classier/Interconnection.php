<?php


namespace oauth2\qq\classier;


use Exception;
use oauth2\core\classier\OAuth2;
use oauth2\qq\config\InterconnectionConfig;
use oauth2\qq\model\QQUserModel;
use rapidPHP\modules\common\classier\AB;
use function rapidPHP\B;

/**
 * qq 互联
 * Class Interconnection
 * @package oauth2\qq\classier
 */
class Interconnection extends OAuth2
{

    /**
     * 获取网页授权access 信息，openId跟access_token
     * @param $code
     * @return AB
     * @throws Exception
     */
    private function getAccessInfo(string $code)
    {
        $accessInfo = $this->sendHttpRequest(InterconnectionConfig::getAccessTokenUrl($this->getAppId(), $this->getSecret(), $code, $this->getCallUrl()));

        if ($accessInfo->hasName('error_description'))
            throw new Exception($accessInfo->toString('error_description'));

        $openData = $this->sendHttpRequest(InterconnectionConfig::getOpenIdUrl($accessInfo->toString('access_token')));

        $accessInfo->value('openId', $openData->toValue('openid'));

        $accessInfo->value('unionId', $openData->toValue('unionid'));

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
        return InterconnectionConfig::getCode2Url($this->getAppId(), $this->getCallUrl(), $scope, $state);
    }

    /**
     * 获取qq用户信息
     * @param string $code
     * @param array|null $options
     * @return QQUserModel
     * @throws Exception
     */
    public function getUserInfo(string $code, ?array $options = [])
    {
        if (empty($code)) throw new Exception('code 错误!');

        $accessInfo = $this->getAccessInfo($code);

        if (empty($accessInfo)) throw new Exception("accessInfo获取失败!");

        $accessToken = $accessInfo->toString('access_token');

        $openId = $accessInfo->toString('openId');

        $url = InterconnectionConfig::getUserInfoUrl($this->getAppId(), $accessToken, $openId);

        $data = $this->sendHttpRequest($url);

        if (!$data->hasValue('ret', 0)) throw new Exception($data->toString('msg'));

        $oauth2Info = new QQUserModel();

        $oauth2Info->setOpenId($openId);

        $oauth2Info->setUnionId($accessInfo->toString('unionId'));

        $oauth2Info->setNickname($data->toString('nickname'));

        $header = B()->contrast($data->toString('figureurl_qq_2'), $data->toString('figureurl_2'));

        $oauth2Info->setHeader($header);

        $oauth2Info->setGender($data->toString('gender'));

        $oauth2Info->setProvince($data->toString('province'));

        $oauth2Info->setCity($data->toString('city'));

        $oauth2Info->setYear($data->toString('year'));

        $oauth2Info->setQQVipInfo($data->toData(['is_yellow_vip', 'vip', 'yellow_vip_level', 'level', 'is_yellow_year_vip']));

        return $oauth2Info;
    }
}