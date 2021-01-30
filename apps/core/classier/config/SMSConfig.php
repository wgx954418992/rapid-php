<?php

namespace apps\core\classier\config;


abstract class SMSConfig
{

    /**
     * 签名
     * @var string|array
     */
    protected $sign = '';

    /**
     * 产品地域
     * @var string
     */
    protected $regionId = '';

    /**
     * 发送短信时间限制
     */
    const LIMIT_TIME = 60;

    /**
     * 短信有效时间
     */
    const VALIDA_TIME = 60 * 5;

    /**
     * 发送短信模板类型,订单状态更改通知
     */
    const TEMPLATE_TYPE_ORDER_STATUS_CHANGE = 'orderStatusChange';

    /**
     * 发送短信模板类型,订单到库等待取货
     */
    const TEMPLATE_TYPE_ORDER_WAITING_TAKE = 'orderWaitingTake';

    /**
     * 获取产品地域
     * @return string
     */
    public function getRegionId(): string
    {
        return $this->regionId;
    }

    /**
     * 获取签名
     * @return string|array
     */
    public function getSign()
    {
        return $this->sign;
    }

    /**
     * 模板类型 国外
     * @return array
     */
    public function getTemplateTypeAbroad(): array
    {
        return [];
    }

    /**
     * 模板类型 国内
     * @return array
     */
    public function getTemplateTypeDomestic(): array
    {
        return [];
    }

    /**
     * 通过type获取smsId
     * @param $type
     * @param string $countryCode
     * @return bool|string|mixed
     */
    public function getTemplateCodeByType($type, $countryCode = '86')
    {
        if ($countryCode == '86') {
            $types = $this->getTemplateTypeDomestic();
        } else {
            $types = $this->getTemplateTypeAbroad();
        }

        if (array_key_exists($type, $types)) return $types[$type];

        return false;
    }
}