<?php

namespace rapidPHP\plugin\pay\weixin;

use Alipay\EasySDK\Kernel\Factory;
use rapid\library\rapid;

class Config
{
    /**
     * appid
     */
    private $appId;

    /**
     * APPSECRET
     */
    private $secret;

    /**
     * 签名类型
     */
    private $signType = 'MD5';

    /**
     * 微信商户id
     */
    private $mchId;

    /**
     * 微信商户key
     */
    private $key;

    /**
     * 微信Sslert证书
     */
    private $sslCertPath;

    /**
     * 微信商户key证书
     */
    private $sslKeyPath;

    /**
     * 代理ip
     */
    private $curlProxyHost = '0.0.0.0';

    /**
     * 代理端口
     * @var int
     */
    private $curlProxyPort = 0;

    /**
     * 微信回调url
     * @var string
     */
    private $notifyUrl = '';

    /**
     * 微信错误上报等级
     * @var int
     */
    private $reportLevel = 0;

    /**
     * @return mixed
     */
    public function getAppId()
    {
        return $this->appId;
    }

    /**
     * @param mixed $appId
     */
    public function setAppId($appId): void
    {
        $this->appId = $appId;
    }

    /**
     * @return mixed
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * @param mixed $secret
     */
    public function setSecret($secret): void
    {
        $this->secret = $secret;
    }

    /**
     * @return mixed
     */
    public function getMchId()
    {
        return $this->mchId;
    }

    /**
     * @param mixed $mchId
     */
    public function setMchId($mchId): void
    {
        $this->mchId = $mchId;
    }


    /**
     * @return string
     */
    public function getSignType(): string
    {
        return $this->signType;
    }

    /**
     * @param string $signType
     */
    public function setSignType(string $signType): void
    {
        $this->signType = $signType;
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param mixed $key
     */
    public function setKey($key): void
    {
        $this->key = $key;
    }

    /**
     * @return mixed
     */
    public function getSslCertPath()
    {
        return $this->sslCertPath;
    }

    /**
     * @param mixed $sslCertPath
     */
    public function setSslCertPath($sslCertPath): void
    {
        $this->sslCertPath = $sslCertPath;
    }

    /**
     * @return mixed
     */
    public function getSslKeyPath()
    {
        return $this->sslKeyPath;
    }

    /**
     * @param mixed $sslKeyPath
     */
    public function setSslKeyPath($sslKeyPath): void
    {
        $this->sslKeyPath = $sslKeyPath;
    }

    /**
     * @return string
     */
    public function getCurlProxyHost(): string
    {
        return $this->curlProxyHost;
    }

    /**
     * @param string $curlProxyHost
     */
    public function setCurlProxyHost(string $curlProxyHost): void
    {
        $this->curlProxyHost = $curlProxyHost;
    }

    /**
     * @return int
     */
    public function getCurlProxyPort(): int
    {
        return $this->curlProxyPort;
    }

    /**
     * @param int $curlProxyPort
     */
    public function setCurlProxyPort(int $curlProxyPort): void
    {
        $this->curlProxyPort = $curlProxyPort;
    }

    /**
     * @return string
     */
    public function getNotifyUrl(): string
    {
        return $this->notifyUrl;
    }

    /**
     * @param string $notifyUrl
     */
    public function setNotifyUrl(string $notifyUrl): void
    {
        $this->notifyUrl = $notifyUrl;
    }

    /**
     * @return int
     */
    public function getReportLevel(): int
    {
        return $this->reportLevel;
    }

    /**
     * @param int $reportLevel
     */
    public function setReportLevel(int $reportLevel): void
    {
        $this->reportLevel = $reportLevel;
    }
}