<?php

namespace wxsdk\publicly\classier;

use Exception;
use rapidPHP\modules\common\classier\AB;
use wxsdk\core\classier\WXSdk;
use wxsdk\core\model\WXUserInfoModel;
use wxsdk\publicly\config\PubliclyConfig;
use function rapidPHP\B;

class Publicly extends WXSdk
{
    /**
     * @var string
     */
    private $jsApiTicketCacheName = 'jsapi_ticket';

    /**
     * 获取Ticket
     * @return array|bool|null|string
     * @throws Exception
     */
    public function getJsApiTicket()
    {
        $jsApiTicket = parent::getCacheValue($this->jsApiTicketCacheName);

        if ($jsApiTicket) return $jsApiTicket;

        $accessToken = $this->getAccessToken();

        $data = parent::sendHttpResponse(PubliclyConfig::getJSApiTicketUrl($accessToken));

        $jsApiTicket = $data->toString('ticket');

        if (empty($jsApiTicket)) throw new Exception($data->toString('errmsg'));

        parent::addCacheValue($this->jsApiTicketCacheName, $jsApiTicket, $data->toInt('expires_in'));

        return $jsApiTicket;
    }


    /**
     * 获取sing包
     * @param $url
     * @return array
     * @throws Exception
     */
    public function getSignPackage($url): array
    {
        $timestamp = time();

        $nonceStr = B()->randoms(16);

        $jsApiTicket = $this->getJsApiTicket();

        $string = "jsapi_ticket={$jsApiTicket}&noncestr={$nonceStr}&timestamp={$timestamp}&url={$url}";

        return [
            'appId' => parent::getAppId(),
            'nonceStr' => $nonceStr,
            'timestamp' => $timestamp,
            'url' => $url,
            'signature' => sha1($string),
            'rawString' => $string
        ];
    }


    /**
     * 通过serverId获取文件
     * @param $serverId
     * @return AB|string
     * @throws Exception
     */
    public function getServerFile($serverId)
    {
        if (empty($serverId)) throw new Exception('serverId错误!');

        $accessToken = $this->getAccessToken();

        $data = parent::sendHttpResponse(PubliclyConfig::getLoadServerUrl($accessToken, $serverId));

        if (($data instanceof AB) && $data->toString('errmsg'))
            throw new Exception($data->toString('errmsg'));

        return $data;
    }

    /**
     * 获取用户信息(用于获取关注的用户信息)
     * @param $openId
     * @return WXUserInfoModel
     * @throws Exception
     */
    public function getUserInfo($openId)
    {
        if (empty($openId)) throw new Exception('openId错误!');

        $accessToken = $this->getAccessToken();

        $data = parent::sendHttpResponse(PubliclyConfig::getUserInfoUrl($accessToken, $openId));

        if ($data->toString('errmsg')) throw new Exception($data->toString('errmsg'));

        if (!$data->hasName('nickname')) throw new Exception('data Error!');

        $userModel = new WXUserInfoModel();

        $userModel->setOpenId($data->toString('openid'));

        $userModel->setUnionId($data->toString('unionid'));

        $userModel->setNickname($data->toString('nickname'));

        $userModel->setHeader($data->toString('headimgurl'));

        $userModel->setGender($data->toString('sex'));

        $userModel->setLanguage($data->toString('language'));

        $userModel->setCountry($data->toString('country'));

        $userModel->setProvince($data->toString('province'));

        $userModel->setCity($data->toString('city'));

        $userModel->setRemark($data->toString('remark'));

        $userModel->setIsSubscribe($data->toBool('subscribe'));

        $userModel->setGroupId($data->toValue('groupid'));

        $userModel->setTagIdList($data->toValue('tagid_list'));

        $userModel->setSubscribeScene($data->toValue('subscribe_scene'));

        $userModel->setQrScene($data->toValue('qr_scene'));

        $userModel->setQrSceneStr($data->toValue('qr_scene_str'));

        return $userModel;
    }

    /**
     * 发送模板消息
     * @param $templateId
     * @param $openId
     * @param $data
     * @param null $url
     * @param null $miniAppId
     * @param null $miniPage
     * @return bool
     * @throws Exception
     */
    public function sendSubTemplate($templateId, $openId, $data, $openUrl = null, $miniAppId = null, $miniPage = null): bool
    {
        if (empty($templateId)) throw new Exception('模板id错误');

        if (empty($openId)) throw new Exception('openId错误');

        $accessToken = $this->getAccessToken();

        $url = PubliclyConfig::getSendTemplateMsgUrl($accessToken);

        $data = ['touser' => $openId, 'template_id' => $templateId, 'data' => $data];

        if ($openUrl) $data['url'] = $openUrl;

        if ($miniAppId && $miniPage) {
            $data['miniprogram'] = ['appid' => $miniAppId, 'pagepath' => $miniPage];
        }

        $data = parent::sendHttpResponse($url, $data, [CURLOPT_HTTPHEADER => ['Content-type' => 'application/json']]);

        if (!$data->hasValue('errcode', 0)) throw new Exception($data->toString('errmsg'));

        return true;
    }


    /**
     * 获取用户列表
     * @param null $nextOpenId
     * @return array|null
     * @throws Exception
     */
    public function getUserList($nextOpenId = null): ?array
    {
        $accessToken = $this->getAccessToken();

        $url = PubliclyConfig::getUserListUrl($accessToken, $nextOpenId);

        $data = $this->sendHttpResponse($url);

        if (!$data->hasValue('errcode', 0)) throw new Exception($data->toString('errmsg'));

        return $data->toData();
    }

    /**
     * 创建二维码ticket
     * 每次创建二维码ticket需要提供一个开发者自行设定的参数（scene_id）
     * 分别介绍临时二维码和永久二维码的创建二维码ticket过程
     * @param int $expire 该二维码有效时间，以秒为单位。 最大不超过2592000（即30天），此字段如果不填，则默认有效期为60秒。
     * @param string|null $actionName 二维码类型，QR_SCENE为临时的整型参数值，QR_STR_SCENE为临时的字符串参数值，QR_LIMIT_SCENE为永久的整型参数值，QR_LIMIT_STR_SCENE为永久的字符串参数值
     * @param string|null $sceneId 场景值ID，临时二维码时为32位非0整型，永久二维码时最大值为100000（目前参数只支持1--100000）
     * @param string|null $sceneStr 场景值ID（字符串形式的ID），字符串类型，长度限制为1到64
     * @return array|null
     * @throws Exception
     */
    public function createQrcode(int $expire = 3600 * 24 * 30, ?string $actionName = null, ?string $sceneId = null, ?string $sceneStr = null): ?array
    {
        $accessToken = $this->getAccessToken();

        $url = 'https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=' . $accessToken;

        $data = $this->sendHttpResponse($url, [
            'expire_seconds' => $expire,
            'action_name' => $actionName,
            'action_info' => [
                'scene' => [
                    'scene_id' => $sceneId,
                    'scene_str' => $sceneStr,
                ]
            ],
        ]);

        if (!$data->hasValue('errcode', 0)) throw new Exception($data->toString('errmsg'));

        return $data->toData();
    }
}
