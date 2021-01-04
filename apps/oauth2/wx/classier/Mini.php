<?php

namespace oauth2\wx\classier;

use Exception;
use oauth2\core\classier\OAuth2;
use oauth2\wx\classier\mini\WXBizDataCrypt;
use oauth2\wx\config\MiniConfig;
use oauth2\wx\model\WXUserModel;
use rapidPHP\modules\common\classier\AB;
use function rapidPHP\AB;
use function rapidPHP\B;


class Mini extends OAuth2
{

    /**
     * 获取unionId
     * @param AB $openInfo
     * @param AB $options
     * @return array|int|mixed|object|string|null
     * @throws Exception
     */
    private function getUnionId(AB $openInfo, AB $options)
    {
        $unionId = $openInfo->toValue('unionid');

        if (!empty($unionId)) return $unionId;

        $encryptedData = $options->toValue('encryptedData');

        $iv = $options->toValue('iv');

        $appId = $options->toValue('appId');

        if (empty($unionId) && $encryptedData && $iv && $appId) {
            $sessionKey = $openInfo->toString('session_key');

            if (WXBizDataCrypt::decryptData($appId, $sessionKey, $encryptedData, $iv, $result) != WXBizDataCrypt::$OK)
                throw new Exception('解密用户数据错误!');

            return B()->getData($result, 'unionId');
        }

        return null;
    }

    /**
     * 获取用户信息 通过js code options 需要小程序上传获取到的用户基本资料
     * @param string $code
     * @param array|null $options
     * @return WXUserModel
     * @throws Exception
     */
    public function getUserInfo(string $code, ?array $options = []): WXUserModel
    {
        if (empty($code)) throw new Exception('code 错误!');

        $url = MiniConfig::JSCodeToSessionUrl($this->getAppId(), $this->getSecret(), $code);

        $openInfo = $this->sendHttpRequest($url);

        if ($openInfo->hasName('errcode')) throw new Exception($openInfo->toString('errmsg'));

        $options = AB($options);

        $oauth2Info = new WXUserModel();

        $oauth2Info->setOpenId($openInfo->toString('openid'));

        $oauth2Info->setUnionId($this->getUnionId($openInfo, $options));

        $oauth2Info->setNickname($options->toString('nickname'));

        $oauth2Info->setHeader($options->toString('avatarUrl'));

        $oauth2Info->setGender($options->toString('gender'));

        $oauth2Info->setLanguage($options->toString('language'));

        $oauth2Info->setCountry($options->toString('country'));

        $oauth2Info->setProvince($options->toString('province'));

        $oauth2Info->setCity($options->toString('city'));

        $oauth2Info->setPrivilege($options->toArray('privilege'));

        return $oauth2Info;
    }
}