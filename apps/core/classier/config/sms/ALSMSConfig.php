<?php


namespace apps\core\classier\config\sms;


use apps\core\classier\config\SMSConfig;

class ALSMSConfig extends SMSConfig
{

    /**
     * 签名
     * @var string
     */
    protected $sign = ['西欧贸易'];

    /**
     * 产品地域
     * @var string
     */
    protected $regionId = 'cn-hangzhou';

    /**
     * @var string 阿里云发送短信api accessKeyId
     */
    private $accessKeyId = 'LTAI4GBdfgzgfNiN8iN3CbSy';

    /**
     * @var string 阿里云发送短信api accessKeySecret
     */
    private $accessKeySecret = 'pmUWu1GLxKvZRzQSAtoZmIFXFiwn8A';

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
            self::TEMPLATE_TYPE_ORDER_NOTIFY => 'SMS_194050536',
        ];
    }

    /**
     * 模板类型 国外
     * @return  array
     */
    public function getTemplateTypeAbroad(): array
    {
        return [
            self::TEMPLATE_TYPE_ORDER_NOTIFY => 'SMS_193230065',
        ];
    }
}