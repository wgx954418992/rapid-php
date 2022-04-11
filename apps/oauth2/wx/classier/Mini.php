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
     * 获取用户信息 通过js opcode id
     * @param string $code
     * @return string|null
     * @throws Exception
     */
    public function getOpenId(string $code): ?string
    {
        if (empty($code)) throw new Exception('code 错误!');

        $url = MiniConfig::JSCodeToSessionUrl($this->getAppId(), $this->getSecret(), $code);

        $openInfo = $this->sendHttpRequest($url);

        if ($openInfo->hasName('errcode')) throw new Exception($openInfo->toString('errmsg'));

        return $openInfo->toString('openid');
    }


    /**
     * 获取用户信息 通过js code options 需要小程序上传获取到的用户基本资料
     * @param string $code
     * @param array|null $options
     * @param AB|null $openInfo
     * @param array|null $decryptedData
     * @return WXUserModel
     * @throws Exception
     */
    public function getUserInfo(
        string $code,
        ?array $options = [],
        ?AB    &$openInfo = null,
        ?array &$decryptedData = null)
    {
        if (empty($code)) throw new Exception('code 错误!');

        $url = MiniConfig::JSCodeToSessionUrl($this->getAppId(), $this->getSecret(), $code);

        $openInfo = $this->sendHttpRequest($url);

        if ($openInfo->hasName('errcode')) throw new Exception($openInfo->toString('errmsg'));

        $options = AB($options);

        $oauth2Info = new WXUserModel();

        $oauth2Info->setOpenId($openInfo->toString('openid'));

        if (!empty($openInfo->toValue('unionid'))) {
            $oauth2Info->setUnionId($openInfo->toValue('unionid'));
        } else {
            $iv = $options->toValue('iv');

            $appId = $options->toValue('appId');

            $sessionKey = $openInfo->toString('session_key');

            $encryptedData = $options->toValue('encryptedData');

            if ($encryptedData && $iv && $appId && $sessionKey) {

                if (WXBizDataCrypt::decryptData($appId, $sessionKey, $encryptedData, $iv, $decryptedData) != WXBizDataCrypt::$OK)
                    throw new Exception('解密用户数据错误!');

                $oauth2Info->setUnionId(B()->getData($decryptedData, 'unionId'));
            } else {
                throw new Exception('参数错误!');
            }
        }

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

    /**
     * 获取授权手机号码 通过JsCode+iv+encryptedData+appid
     * @param string $code
     * @param array|null $options
     * @param AB|null $openInfo
     * @param array|null $decryptedData
     * @return string
     * @throws Exception
     */
    public function getPhoneNumber(
        string $code,
        ?array $options = [],
        ?AB    &$openInfo = null,
        ?array &$decryptedData = null): string
    {
        if (empty($code)) throw new Exception('code 错误!');

        $url = MiniConfig::JSCodeToSessionUrl($this->getAppId(), $this->getSecret(), $code);

        $openInfo = $this->sendHttpRequest($url);

        if ($openInfo->hasName('errcode')) throw new Exception($openInfo->toString('errmsg'));

        $options = AB($options);

        $iv = $options->toValue('iv');

        $appId = $options->toValue('appId');

        $sessionKey = $openInfo->toString('session_key');

        $encryptedData = $options->toValue('encryptedData');

        if ($encryptedData && $iv && $appId && $sessionKey) {

            if (WXBizDataCrypt::decryptData($appId, $sessionKey, $encryptedData, $iv, $decryptedData) != WXBizDataCrypt::$OK)
                throw new Exception('解密用户数据错误!');

            return '+' .
                B()->getData($decryptedData, 'countryCode') .
                B()->getData($decryptedData, 'purePhoneNumber');
        } else {
            throw new Exception('参数错误!');
        }
    }
}
