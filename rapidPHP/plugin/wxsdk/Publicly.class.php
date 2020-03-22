<?php

namespace rapidPHP\plugin\wxsdk;

use Exception;
use rapidPHP\config\plugin\wxsdk\PubliclyConfig;

class Publicly extends WXSdk
{

    /**
     * @var string
     */
    private $appId, $secret;

    /**
     * @var string
     */
    private $jsApiTicketFileName = 'jsapi_ticket';

    /**
     * 实例化设置appid
     * Publicly constructor.
     * @param string $appId
     * @param string $appSecret
     */
    public function __construct($appId = '', $appSecret = '')
    {
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
        $jsApiTicket = parent::getCache($this->jsApiTicketFileName);

        if ($jsApiTicket) return $jsApiTicket;

        $accessToken = $this->getAccessToken($this->getAppId(), $this->getSecret());

        $data = parent::getHRToAB(PubliclyConfig::getJSApiTicketUrl($accessToken));

        $jsApiTicket = $data->getString('ticket');

        if (empty($jsApiTicket)) throw new Exception($data->getString('errmsg'));

        parent::addCache($this->jsApiTicketFileName, $jsApiTicket, $data->getInt('expires_in'));

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
}