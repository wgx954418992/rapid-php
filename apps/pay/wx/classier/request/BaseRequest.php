<?php

namespace pay\wx\classier\request;

use Exception;
use rapidPHP\modules\reflection\classier\Utils;
use rapidPHP\modules\server\config\HttpConfig;
use function rapidPHP\X;

class BaseRequest
{

    /**
     * son extends
     */
    const URL = '';

    /**
     * method son extends
     */
    const METHOD = HttpConfig::METHOD_POST;

    /**
     * 设置微信分配的公众账号ID
     * @var string|null
     */
    private $appid;

    /**
     * 设置微信支付分配的商户号
     * @var string|null
     */
    private $mch_id;

    /**
     * 设置随机字符串
     * @var string|null
     */
    private $nonce_str;

    /**
     * 签名
     * @var string|null
     */
    private $sign;

    /**
     * 签名类型，目前支持HMAC-SHA256和MD5，默认为MD5
     * @var string|null
     */
    private $sign_type;

    /**
     * @return string|null
     */
    public function getAppid(): ?string
    {
        return $this->appid;
    }

    /**
     * @param string|null $appid
     */
    public function setAppid(?string $appid): void
    {
        $this->appid = $appid;
    }

    /**
     * @return string|null
     */
    public function getMchId(): ?string
    {
        return $this->mch_id;
    }

    /**
     * @param string|null $mch_id
     */
    public function setMchId(?string $mch_id): void
    {
        $this->mch_id = $mch_id;
    }

    /**
     * @return string|null
     */
    public function getNonceStr(): ?string
    {
        return $this->nonce_str;
    }

    /**
     * @param string|null $nonce_str
     */
    public function setNonceStr(?string $nonce_str): void
    {
        $this->nonce_str = $nonce_str;
    }

    /**
     * @return string|null
     */
    public function getSign(): ?string
    {
        return $this->sign;
    }

    /**
     * @param string|null $sign
     */
    public function setSign(?string $sign): void
    {
        $this->sign = $sign;
    }

    /**
     * @return string|null
     */
    public function getSignType(): ?string
    {
        return $this->sign_type;
    }

    /**
     * @param string|null $sign_type
     */
    public function setSignType(?string $sign_type): void
    {
        $this->sign_type = $sign_type;
    }

    /**
     * 转data 数组
     * @return array|null
     * @throws Exception
     */
    public function toData(): ?array
    {
        return Utils::getInstance()->toArray($this);
    }

    /**
     * 转xml
     * @return array|null
     * @throws Exception
     */
    public function toXml(): ?string
    {
        return X()->encode($this->toData());
    }

    /**
     * 转json
     * @return array|null
     * @throws Exception
     */
    public function toJson(): ?string
    {
        return json_encode($this->toData());
    }
}