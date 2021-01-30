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
     * 订单状态 2.确认订单
     */
    const ORDER_STATUS_CONFIRMED = 2;

    /**
     * 订单状态 3.货物确认⼊库
     */
    const ORDER_STATUS_INLIBRARY = 3;

    /**
     * 订单状态 4.离港
     */
    const ORDER_STATUS_DEPARTURE = 4;

    /**
     * 订单状态 5.到港
     */
    const ORDER_STATUS_ARRIVAL = 5;

    /**
     * 订单状态 6.清关完成
     */
    const ORDER_STATUS_CLEARANCE = 6;

    /**
     * 订单状态 7.到达⽬的地仓库，等待取货
     */
    const ORDER_STATUS_WAIT_TAKE = 7;

    /**
     * 订单状态 8.已签收
     */
    const ORDER_STATUS_COMPLETE = 8;

    /**
     * 订单状态 9.订单取消
     */
    const ORDER_STATUS_CANCEL = 9;

    /**
     * 用户订单状态文本配置
     * @var array
     */
    const STATUS = [
        self::ORDER_STATUS_CONFIRMING => '等待确认',
        self::ORDER_STATUS_CONFIRMED => '确认订单',
        self::ORDER_STATUS_INLIBRARY => '确认⼊库',
        self::ORDER_STATUS_DEPARTURE => '离港',
        self::ORDER_STATUS_ARRIVAL => '到港',
        self::ORDER_STATUS_CLEARANCE => '清关完成',
        self::ORDER_STATUS_WAIT_TAKE => '等待取货',
        self::ORDER_STATUS_COMPLETE => '已签收',
        self::ORDER_STATUS_CANCEL => '订单取消',
    ];

    /**
     * 获取订单状态
     * @param $status
     * @return mixed
     */
    public static function getOrderStatusText($status)
    {
        $t = B()->getData(self::STATUS, $status);

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
     * 支付状态文本配置
     * @var array
     */
    const PAY_STATUS = [
        self::PAY_STATUS_WAITING => '待支付',
        self::PAY_STATUS_PAYED => '已支付',
        self::PAY_STATUS_CANCEL => '支付取消',
    ];

    /**
     * 获取支付状态
     * @param $status
     * @return mixed
     */
    public static function getOrderPayStatusText($status)
    {
        $t = B()->getData(self::PAY_STATUS, $status);

        return B()->contrast($t, '状态错误');
    }


    /**
     * 货物类型 散货/拼箱
     */
    const GOODS_TYPE_BOX = 1;

    /**
     * 货物类型 整柜
     */
    const GOODS_TYPE_STRIP = 2;

    /**
     * 货物类型
     * @var array
     */
    const GOODS_TYPES = [
        self::GOODS_TYPE_BOX => '散货/拼箱',
        self::GOODS_TYPE_STRIP => '整柜',
    ];

    /**
     * 获取货物类型
     * @param $status
     * @return mixed
     */
    public static function getGoodsTypeText($status)
    {
        $t = B()->getData(self::GOODS_TYPES, $status);

        return B()->contrast($t, '类型错误');
    }
}