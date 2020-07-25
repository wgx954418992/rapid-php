<?php

namespace rapidPHP\plugin\wxsdk;

use Exception;
use rapidPHP\config\plugin\wxsdk\MiniConfig;
use rapidPHP\config\plugin\wxsdk\PubliclyConfig;
use rapidPHP\library\cache\CacheInterface;
use rapidPHP\plugin\model\WXOAuth2UserInfoModel;

class Publicly extends WXSdk
{

    /**
     * @var string
     */
    private $appId, $secret;

    /**
     * @var string
     */
    private $jsApiTicketCacheName = 'jsapi_ticket';

    /**
     * 实例化设置appid
     * Publicly constructor.
     * @param string $appId
     * @param string $appSecret
     * @param CacheInterface $cacheService
     */
    public function __construct($appId = '', $appSecret = '', CacheInterface $cacheService = null)
    {
        parent::__construct($cacheService);

        $this->setAppId($appId)->setSecret($appSecret);
    }

    /**
     * 设置appid
     * @param string $appId
     * @return $this
     */
    public function setAppId(string $appId)
    {
        $this->appId = $appId;

        return $this;
    }

    /**
     * 设置appSecret
     * @param string $secret
     * @return $this
     */
    public function setSecret(string $secret)
    {
        $this->secret = $secret;

        return $this;
    }

    /**
     * 获取appId
     * @return string
     */
    public function getAppId(): string
    {
        return $this->appId;
    }

    /**
     * 获取secret
     * @return string
     */
    public function getSecret(): string
    {
        return $this->secret;
    }


    /**
     * 获取Ticket
     * @return array|bool|null|string
     * @throws Exception
     */
    public function getJsApiTicket()
    {
        $jsApiTicket = parent::getCacheService()->get($this->jsApiTicketCacheName);

        if ($jsApiTicket) return $jsApiTicket;

        $accessToken = $this->getAccessToken($this->getAppId(), $this->getSecret());

        $data = parent::getHRToAB(PubliclyConfig::getJSApiTicketUrl($accessToken));

        $jsApiTicket = B()->getData($data, 'ticket');

        if (empty($jsApiTicket)) throw new Exception(Cal()->getDate($data, 'errmsg'));

        parent::getCacheService()->add($this->jsApiTicketCacheName, $jsApiTicket, $data['expires_in']);

        return $jsApiTicket;
    }


    /**
     * 获取sing包
     * @return array
     * @throws Exception
     */
    public function getSignPackage()
    {
        $timestamp = time();

        $nonceStr = B()->randoms(16);

        $jsApiTicket = $this->getJsApiTicket();

        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? 'https://' : 'http://';

        $url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        $string = "jsapi_ticket={$jsApiTicket}&noncestr={$nonceStr}&timestamp={$timestamp}&url={$url}";

        return ['appId' => $this->appId, 'nonceStr' => $nonceStr, 'timestamp' => $timestamp,
            'url' => $url, 'signature' => sha1($string), 'rawString' => $string];
    }


    /**
     * 通过serverId获取文件
     * @param $serverId
     * @return string
     * @throws Exception
     */
    public function getServerFile($serverId)
    {
        if (empty($serverId)) throw new Exception('serverId错误!');

        $accessToken = $this->getAccessToken($this->getAppId(), $this->getSecret());

        return parent::getHRToAB(PubliclyConfig::getLoadServerUrl($accessToken, $serverId));
    }

    /**
     * 获取用户信息(用于获取关注的用户信息)
     * @param $openId
     * @return WXOAuth2UserInfoModel
     * @throws Exception
     */
    public function getUserInfo($openId): WXOAuth2UserInfoModel
    {
        if (empty($openId)) throw new Exception('openId错误!');

        $accessToken = $this->getAccessToken($this->getAppId(), $this->getSecret());

        $data = parent::getHRToAB(PubliclyConfig::getUserInfoUrl($accessToken, $openId));

        if (isset($data['errmsg'])) throw new Exception($data['errmsg']);

        if (!array_key_exists('nickname', $data)) throw new Exception('data Error!');

        $userModel = new WXOAuth2UserInfoModel();

        $userModel->setOpenId($data['openid']);

        $userModel->setUnionId(B()->getData($data, 'unionid'));

        $userModel->setNickname($data['nickname']);

        $userModel->setHeader($data['headimgurl']);

        $userModel->setSex($data['sex']);

        $userModel->setLanguage($data['language']);

        $userModel->setCountry($data['country']);

        $userModel->setProvince($data['province']);

        $userModel->setCity($data['city']);

        $userModel->setRemark(B()->getData($data, 'remark'));

        $userModel->setIsSubscribe((bool)B()->getData($data, 'subscribe'));

        $userModel->setGroupId(B()->getData($data, 'groupid'));

        $userModel->setTagIdList(B()->getData($data, 'tagid_list'));

        $userModel->setSubscribeScene(B()->getData($data, 'subscribe_scene'));

        $userModel->setQrScene(B()->getData($data, 'qr_scene'));

        $userModel->setQrSceneStr(B()->getData($data, 'qr_scene_str'));

        return $userModel;
    }

    /**
     * 发送模板消息
     * @param $templateId
     * @param $openId
     * @param $data
     * @param $miniAppId
     * @param null $miniPage
     * @return bool
     * @throws Exception
     */
    public function sendSubTemplate($templateId, $openId, $data, $miniAppId = null, $miniPage = null)
    {
        if (empty($templateId)) throw new Exception('模板id错误');

        if (empty($openId)) throw new Exception('openId错误');

        if (empty($miniAppId)) throw new Exception('page 错误');

        $accessToken = $this->getAccessToken($this->getAppId(), $this->getSecret());

        $url = PubliclyConfig::getSendTemplateMsgUrl($accessToken);

        $data = ['touser' => $openId, 'template_id' => $templateId, 'data' => $data];

        if ($miniAppId && $miniPage) $data['miniprogram'] = ['appid' => $miniAppId, 'pagepath' => $miniPage];

        $res = B()->getHttpResponse($url, json_encode($data), 60, [],
            [CURLOPT_HTTPHEADER => ['Content-type' => 'application/json']]);

        $data = B()->jsonDecode($res);

        if (empty($data)) throw new Exception('解析数据失败!');

        $errCode = (int)B()->getData($data, 'errcode');

        if ($errCode != 0)
            throw new Exception(B()->getData($data, 'errmsg'));

        return true;
    }


    /**
     * 获取用户列表
     * @param null $nextOpenId
     * @return bool
     * @throws Exception
     */
    public function getUserList($nextOpenId = null)
    {
        $accessToken = $this->getAccessToken($this->getAppId(), $this->getSecret());

        $url = PubliclyConfig::getUserListUrl($accessToken, $nextOpenId);

        $res = B()->getHttpResponse($url);

        $data = B()->jsonDecode($res);

        if (empty($data)) throw new Exception('解析数据失败!');

        $errCode = (int)B()->getData($data, 'errcode');

        if ($errCode != 0)
            throw new Exception(B()->getData($data, 'errmsg'));

        return $data;
    }
}