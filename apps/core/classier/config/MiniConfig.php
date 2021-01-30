<?php

namespace apps\core\classier\config;

class MiniConfig
{
    /**
     * 微信小程序 app id
     */
    const APPID = '';

    /**
     * 微信小程序 secret
     */
    const SECRET = '';

    /**
     * 模板id 订单状态更改通知
     */
    const TEMPLATE_ID_ORDER_STATUS_CHANGE = '';

    /**
     * 模板id 订单到库等待取货
     */
    const TEMPLATE_ID_ORDER_WAITING_TAKE = '';

    /**
     * 生成订单状态更改通知数据
     * @param $orderId
     * @param $statusText
     * @return array[]
     */
    public static function getOrderStatusChangeTemplateData($orderId, $statusText)
    {
        return [
            "character_string1" => ["value" => $orderId],
            "phrase2" => ["value" => $statusText],
        ];
    }

    /**
     * 生成等待取货通知数据
     * @param $orderId
     * @param $pickupCode
     * @return array
     */
    public static function getWaitingTakeTemplateData($orderId, $pickupCode)
    {
        return [
            "character_string1" => ["value" => $orderId],
            "character_string2" => ["value" => $pickupCode],
        ];
    }
}