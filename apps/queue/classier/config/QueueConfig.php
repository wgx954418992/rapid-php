<?php

namespace apps\queue\classier\config;


class QueueConfig
{

    /**
     * 队列状态 0  已取消
     */
    const STATUS_CANCEL = 0;

    /**
     * 队列状态 1 等待中
     */
    const STATUS_WAITING = 1;

    /**
     * 队列状态 2 执行中
     */
    const STATUS_IN_EXECUTION = 2;

    /**
     * 队列状态 3 执行完毕
     */
    const STATUS_COMPLETE = 3;

    /**
     * 执行超时时间 （毫秒） 10分钟
     */
    const EXECUTION_TIMEOUT = 60 * 10 * 1000;

    /**
     * 队列类型 订单创建成功
     */
    const TYPE_ORDER_CREATED = 'ORDER_CREATED';

    /**
     * 队列类型 短信通知
     */
    const TYPE_NOTIFY_SMS = 'NOTIFY_SMS';

    /**
     * 队列类型 小程序通知
     */
    const TYPE_NOTIFY_MINI = 'NOTIFY_MINI';

    /**
     * 参数key 订单 orderId
     */
    const PARAM_KEY_ORDER_ID = 'OID';

    /**
     * 参数key 短信 telephone
     */
    const PARAM_KEY_SMS_TELEPHONE = 'T';

    /**
     * 参数key 短信 telephoneCode
     */
    const PARAM_KEY_SMS_TEMPLATE_CODE = 'TC';

    /**
     * 参数key 小程序 openId
     */
    const PARAM_KEY_MINI_OPEN_ID = 'OID';

    /**
     * 参数key 小程序 模板id
     */
    const PARAM_KEY_MINI_TEMPLATE_ID = 'TID';

    /**
     * 参数key 小程序 page
     */
    const PARAM_KEY_MINI_PAGE = 'P';

    /**
     * 参数key 小程序 data
     */
    const PARAM_KEY_MINI_DATA = 'D';
}