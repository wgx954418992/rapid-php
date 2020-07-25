<?php


namespace application\config;


class QueueConfig
{
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
     * 执行超时时间 （秒） 10分钟
     */
    const EXECUTION_TIMEOUT = 60 * 10;

    /**
     * 队列类型 发送短信通知
     */
    const TYPE_SEND_MSG = 'TASK_SERVICE_SEND_MSG';

    /**
     * 队列类型 发送邮件
     */
    const TYPE_SEND_EMAIL = 'TASK_SERVICE_SEND_EMAIL';
}