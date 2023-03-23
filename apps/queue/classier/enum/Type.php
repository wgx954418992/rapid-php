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
     * 队列类型 邮件通知
     */
    const NOTIFY_EMAIL = 'NOTIFY_EMAIL';

    /**
     * 队列类型 小程序通知
     */
    const NOTIFY_MINI = 'NOTIFY_MINI';
}
