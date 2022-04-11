<?php

namespace apps\core\classier\config\sms;


use apps\core\classier\config\Configure;
use apps\core\classier\sender\sms\ITCloudConfig;

class TCloudConfig implements ITCloudConfig
{
    /**
     * Configure
     */
    use Configure;

    /**
     * 签名
     * 短信签名内容: 使用 UTF-8 编码，必须填写已审核通过的签名，签名信息可登录 [短信控制台] 查看  如果【深圳市人人共享电商】
     * @var string
     * @config sms.tcloud.sign
     */
    protected $sign = '';

    /**
     * 产品地域
     * @var string
     * @config sms.tcloud.region
     */
    protected $region = 'ap-shanghai';

    /**
     * 实例化一个认证对象，入参需要传入腾讯云账户密钥对secretId，secretKey。
     * CAM密匙查询: https://console.cloud.tencent.com/cam/capi
     * @var string
     * @config sms.tcloud.secret.id
     */
    protected $secretId = '';

    /**
     * 实例化一个认证对象，入参需要传入腾讯云账户密钥对secretId，secretKey。
     * CAM密匙查询: https://console.cloud.tencent.com/cam/capi
     * @var string
     * @config sms.tcloud.secret.key
     */
    protected $secretKey = '';

    /**
     * 短信应用ID: 短信SdkAppid在 [短信控制台] 添加应用后生成的实际SdkAppid，示例如1400006666
     * @var string
     * @config sms.tcloud.appid
     */
    protected $appId = '';

    /**
     * @var string {短信码号扩展号: 默认未开通，如需开通请联系 [sms helper]}
     * @config sms.tcloud.extend_code
     */
    protected $extendCode = '0';

    /**
     * @var string {国际/港澳台短信 senderid: 国内短信填空，默认未开通，如需开通请联系 [sms helper]}
     * @config sms.tcloud.sender_id
     */
    protected $senderId = '0';

    /**
     * @var string {用户的 session 内容: 可以携带用户侧 ID 等上下文信息，server 会原样返回}
     * @config sms.tcloud.session_context
     */
    protected $sessionContext = '';

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
     * @return string
     */
    public function getSign(): string
    {
        return $this->sign;
    }

    /**
     * @return string
     */
    public function getRegion(): string
    {
        return $this->region;
    }

    /**
     * @return string
     */
    public function getSecretId(): string
    {
        return $this->secretId;
    }

    /**
     * @return string
     */
    public function getSecretKey(): string
    {
        return $this->secretKey;
    }

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
    public function getExtendCode(): string
    {
        return $this->extendCode;
    }

    /**
     * @return string
     */
    public function getSenderId(): string
    {
        return $this->senderId;
    }

    /**
     * @return string
     */
    public function getSessionContext(): string
    {
        return $this->sessionContext;
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
