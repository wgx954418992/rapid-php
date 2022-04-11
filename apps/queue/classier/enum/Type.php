<?php


namespace apps\queue\classier\enum;


use enum\classier\Enum;

class Type extends Enum
{

    /**
     * 队列类型 短信通知
     */
    const NOTIFY_SMS = 'NOTIFY_SMS';

    /**
     * 队列类型 关注
     */
    const FOLLOW = 'FOLLOW';

    /**
     * 队列类型 积分更改
     */
    const INTEGRAL_CHANGE = 'INTEGRAL_CHANGE';

    /**
     * 队列类型 积分每天扣除
     */
    const INTEGRAL_EVERY_DEDUCT = 'INTEGRAL_EVERY_DEDUCT';
}
