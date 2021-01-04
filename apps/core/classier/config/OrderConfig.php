<?php

namespace apps\core\classier\config;

use function rapidPHP\B;

class OrderConfig
{
    /**
     * 订单状态 1.等待确认
     */
    const ORDER_STATUS_CONFIRMING = 1;

    /**
     * 用户订单状态文本配置
     * @var array
     */
    private static $status = [
        self::ORDER_STATUS_CONFIRMING => '等待确认',
    ];

    /**
     * 获取订单状态
     * @param $status
     * @return mixed
     */
    public static function getOrderStatusText($status)
    {
        $t = B()->getData(self::$status, $status);

        return B()->contrast($t, '状态错误');
    }

    /**
     * 订单支付状态 1.待支付
     */
    const PAY_STATUS_WAITING = 1;

    /**
     * 订单支付状态 2.已支付
     */
    const PAY_STATUS_PAYED = 2;

    /**
     * 订单支付状态 3.支付取消
     */
    const PAY_STATUS_CANCEL = 3;

    /**
     * 用户订单状态文本配置
     * @var array
     */
    private static $payStatus = [
        self::PAY_STATUS_WAITING => '待支付',
        self::PAY_STATUS_PAYED => '已支付',
        self::PAY_STATUS_CANCEL => '支付取消',
    ];

    /**
     * 获取订单状态
     * @param $status
     * @return mixed
     */
    public static function getOrderPayStatusText($status)
    {
        $t = B()->getData(self::$payStatus, $status);

        return B()->contrast($t, '状态错误');
    }
}