<?php


namespace apps\core\classier\config\sms;


use apps\core\classier\config\SMSConfig;

class ALSMSConfig extends SMSConfig
{

    /**
     * 签名
     * @var string
     */
    protected $sign = [''];

    /**
     * 产品地域
     * @var string
     */
    protected $regionId = 'cn-hangzhou';

    /**
     * @var string 阿里云发送短信api accessKeyId
     */
    private $accessKeyId = '';

    /**
     * @var string 阿里云发送短信api accessKeySecret
     */
    private $accessKeySecret = '';

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
     * 模板类型 国内
     * @return  array
     */
    public function getTemplateTypeDomestic(): array
    {
        return [
            self::TEMPLATE_TYPE_ORDER_STATUS_CHANGE => 'SMS_209160683',
            self::TEMPLATE_TYPE_ORDER_WAITING_TAKE => 'SMS_210061691',
        ];
    }

    /**
     * 模板类型 国外
     * @return  array
     */
    public function getTemplateTypeAbroad(): array
    {
        return [
            self::TEMPLATE_TYPE_ORDER_STATUS_CHANGE => 'SMS_210064637',
            self::TEMPLATE_TYPE_ORDER_WAITING_TAKE => 'SMS_210076489',
        ];
    }
}