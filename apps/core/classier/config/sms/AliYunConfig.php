<?php


namespace apps\core\classier\config\sms;

use apps\core\classier\config\Configure;
use apps\core\classier\sender\sms\IAliYunConfig;

class AliYunConfig implements IAliYunConfig
{
    /**
     * Configure
     */
    use Configure;

    /**
     * 签名
     * @var string|string[]
     * @config sms.aliyun.sign
     */
    protected $sign = [];

    /**
     * 产品地域
     * @var string
     * @config sms.aliyun.region
     */
    protected $regionId = '';

    /**
     * 阿里云发送短信api accessKeyId
     * @var string
     * @config sms.aliyun.access_key_id
     */
    protected $accessKeyId = '';

    /**
     * 阿里云发送短信api accessKeySecret
     * @var string
     * @config sms.aliyun.access_key_secret
     */
    protected $accessKeySecret = '';

    /**
     * 模板国内
     * @var array
     * @config sms.aliyun.template.domestic
     */
    protected $templateDomestic = [];

    /**
     * 模板国外
     * @var array
     * @config sms.aliyun.template.abroad
     */
    protected $templateAbroad = [];

    /**
     * @return string|string[]
     */
    public function getSign()
    {
        return $this->sign;
    }

    /**
     * @return string
     */
    public function getRegion(): string
    {
        return $this->regionId;
    }

    /**
     * @return string
     */
    public function getAccessKeyId(): string
    {
        return $this->accessKeyId;
    }

    /**
     * @return string
     */
    public function getAccessKeySecret(): string
    {
        return $this->accessKeySecret;
    }

    /**
     * @return array|null
     */
    public function getTemplateCodeDomestic(): ?array
    {
        return $this->templateDomestic;
    }

    /**
     * @return array|null
     */
    public function getTemplateCodeAbroad(): ?array
    {
        return $this->templateAbroad;
    }
}
