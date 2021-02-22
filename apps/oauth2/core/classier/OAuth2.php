<?php

namespace oauth2\core\classier;


use Exception;
use oauth2\core\model\BaseUserModel;
use oauth2\qq\model\QQUserModel;
use oauth2\wx\model\WXUserModel;
use rapidPHP\modules\common\classier\AB;
use rapidPHP\modules\common\classier\Http;
use rapidPHP\modules\common\classier\Uri;
use function rapidPHP\AB;
use function rapidPHP\B;

abstract class OAuth2
{

    /**
     * @var string|null
     */
    private $appId;

    /**
     * @var string|null
     */
    private $secret;

    /**
     * @var string|null
     */
    private $callUrl;

    /**
     * OAuth2 constructor.
     * @param string|null $appId
     * @param string|null $secret
     * @param string|null $callUrl
     */
    public function __construct(?string $appId = null, ?string $secret = null, ?string $callUrl = null)
    {
        $this->appId = $appId;

        $this->secret = $secret;

        $this->callUrl = $callUrl;
    }

    /**
     * @return string|null
     */
    public function getAppId(): ?string
    {
        return $this->appId;
    }

    /**
     * @param string|null $appId
     */
    public function setAppId(?string $appId): void
    {
        $this->appId = $appId;
    }

    /**
     * @return string|null
     */
    public function getSecret(): ?string
    {
        return $this->secret;
    }

    /**
     * @param string|null $secret
     */
    public function setSecret(?string $secret): void
    {
        $this->secret = $secret;
    }

    /**
     * @return string|null
     */
    public function getCallUrl(): ?string
    {
        return $this->callUrl;
    }

    /**
     * @param string|null $callUrl
     */
    public function setCallUrl(?string $callUrl): void
    {
        $this->callUrl = $callUrl;
    }

    /**
     * 发送http请求
     * @param $url
     * @return AB
     * @throws Exception
     */
    protected function sendHttpRequest(string $url): AB
    {
        $httpResponse = Http::getInstance()->getHttpResponse($url);

        if (empty($httpResponse)) throw new Exception('请求失败!');

        if (substr($httpResponse, 0, 1) == '{') {
            $data = B()->jsonDecode($httpResponse);
        } else {
            $httpResponse = preg_replace("#callback\( (.*) \);#", '$1', trim($httpResponse));

            $data = B()->jsonDecode($httpResponse);

            if (!is_array($data)) {
                if (substr($httpResponse, 0, 1) != '?') $httpResponse = '?' . $httpResponse;

                $data = Uri::getInstance()->toArray($httpResponse);
            }
        }

        return AB($data);
    }

    /**
     * 获取授权地址
     * @param string $scope
     * @param string $state
     * @return string
     */
    public function getCodeUrl(string $scope = 'snsapi_userinfo', string $state = ''): string
    {
        return '';
    }

    /**
     * 获取 openid
     * @param string $code
     * @return BaseUserModel|QQUserModel|WXUserModel
     */
    abstract public function getOpenId(string $code): ?string;

    /**
     * 子类实现获取用户信息方法
     * @param string $code
     * @param array|null $options
     * @return BaseUserModel|QQUserModel|WXUserModel
     */
    abstract public function getUserInfo(string $code, ?array $options = []);
}