<?php

namespace apps\core\classier\config\sms;


use apps\core\classier\config\SMSConfig;

class TCSMSConfig extends SMSConfig
{

    /**
     * 签名
     * 短信签名内容: 使用 UTF-8 编码，必须填写已审核通过的签名，签名信息可登录 [短信控制台] 查看  如果【深圳市人人共享电商】
     * @var string
     */
    protected $sign = '';

    /**
     * 产品地域
     * @var string
     */
    protected $regionId = 'ap-shanghai';

    /**
     * 实例化一个认证对象，入参需要传入腾讯云账户密钥对secretId，secretKey。
     * CAM密匙查询: https://console.cloud.tencent.com/cam/capi
     * @var string
     */
    private $secretId = '';

    /**
     * 实例化一个认证对象，入参需要传入腾讯云账户密钥对secretId，secretKey。
     * CAM密匙查询: https://console.cloud.tencent.com/cam/capi
     * @var string
     */
    private $secretKey = '';

    /**
     * 短信应用ID: 短信SdkAppid在 [短信控制台] 添加应用后生成的实际SdkAppid，示例如1400006666
     * @var string
     */
    private $appId = '';

    /**
     * @var string {短信码号扩展号: 默认未开通，如需开通请联系 [sms helper]}
     */
    private $extendCode = '0';

    /**
     * @var string {国际/港澳台短信 senderid: 国内短信填空，默认未开通，如需开通请联系 [sms helper]}
     */
    private $senderId = '0';

    /**
     * @var string {用户的 session 内容: 可以携带用户侧 ID 等上下文信息，server 会原样返回}
     */
    private $sessionContext = '';

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
     * 模板类型 国内
     * @return  array
     */
    public function getTemplateTypeDomestic(): array
    {
        return [

        ];
    }
}