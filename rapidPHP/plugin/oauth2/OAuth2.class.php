<?php

namespace rapidPHP\plugin\oauth2;


use Exception;
use rapidPHP\plugin\model\BaseOAuth2UserModel;

abstract class OAuth2
{

    /**
     * @var string
     */
    private $appId, $secret, $callUrl = '';

    /**
     * 实例化设置appid
     * OAuth2 constructor.
     * @param string $appId
     * @param string $secret
     * @param string $callUrl
     */
    public function __construct($appId = '', $secret = '', $callUrl = '')
    {
        $this->setAppId($appId)
            ->setSecret($secret)
            ->setCallUrl($callUrl);
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
     * 设置appSecret
     * @param string $callUrl
     * @return $this
     */
    public function setCallUrl(string $callUrl)
    {
        $this->callUrl = $callUrl;

        return $this;
    }

    /**
     * 获取callUrl
     * @return string
     */
    public function getCallUrl(): string
    {
        return $this->callUrl;
    }

    /**
     * 发送http请求
     * @param $url
     * @return array
     * @throws Exception
     */
    protected function sendHttpRequest(string $url): array
    {
        $httpResponse = B()->getHttpResponse($url);

        if (empty($httpResponse)) throw new Exception('请求失败!');

        $httpResponse = preg_replace("#callback\( (.*) \);#", '$1', trim($httpResponse));

        $data = B()->jsonDecode($httpResponse);

        return is_array($data) ? $data : B()->getUrlQueryStringToArray($httpResponse);
    }


    /**
     * 获取授权地址
     * @param string $scope
     * @param string $state
     * @return string
     */
    abstract public function getCodeUrl(string $scope = 'snsapi_userinfo', string $state = ''): string;

    /**
     * 子类实现获取用户信息方法
     * @param string $code
     * @return BaseOAuth2UserModel
     */
    abstract public function getUserInfo(string $code): BaseOAuth2UserModel;
}