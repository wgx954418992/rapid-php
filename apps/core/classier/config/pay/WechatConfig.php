<?php


namespace apps\core\classier\config\pay;


use apps\core\classier\config\Configure;
use pay\wx\classier\IConfig;

class WechatConfig implements IConfig
{

    /**
     * Configure
     */
    use Configure;

    /**
     * @var string
     * @config pay.wechat.appid
     */
    protected $appId;

    /**
     * @var string
     * @config pay.wechat.secret
     */
    protected $secret;

    /**
     * @var string
     * @config pay.wechat.key
     */
    protected $key;

    /**
     * @var string
     * @config pay.wechat.mch_id
     */
    protected $mchId;

    /**
     * @var string
     * @config pay.wechat.notify_url
     */
    protected $notifyUrl;

    /**
     * @var string
     * @config pay.wechat.sign_type
     */
    protected $signType;

    /**
     * @var string|null
     * @config pay.wechat.ssl_cert_path
     */
    protected $sslCertPath;

    /**
     * @var string|null
     * @config pay.wechat.ssl_key_path
     */
    protected $sslKeyPath;

    /**
     * @var string|null
     * @config pay.wechat.curl_proxy_host
     */
    protected $curlProxyHost;

    /**
     * @var int|null
     * @config pay.wechat.curl_proxy_port
     */
    protected $curlProxyPort;

    /**
     * @return string
     */
    public function getAppId(): string
    {
        return $this->appId;
    }

    /**
     * @return string
     */
    public function getSecret(): string
    {
        return $this->secret;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @return string
     */
    public function getMchId(): string
    {
        return $this->mchId;
    }

    /**
     * @return string
     */
    public function getNotifyUrl(): string
    {
        return $this->notifyUrl;
    }

    /**
     * @return string
     */
    public function getSignType(): string
    {
        return $this->signType;
    }

    /**
     * @return string|null
     */
    public function getSslCertPath(): ?string
    {
        return $this->sslCertPath;
    }

    /**
     * @return string|null
     */
    public function getSslKeyPath(): ?string
    {
        return $this->sslKeyPath;
    }

    /**
     * @return string|null
     */
    public function getCurlProxyHost(): ?string
    {
        return $this->curlProxyHost;
    }

    /**
     * @return int|null
     */
    public function getCurlProxyPort(): ?int
    {
        return $this->curlProxyPort;
    }
}
