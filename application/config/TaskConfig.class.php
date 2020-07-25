<?php


namespace application\config;


class TaskConfig
{
    /**
     * 任务类型
     */
    const TASK_TYPE = 'TYPE';

    /**
     * 任务参数
     */
    const TASK_PARAM = 'TASK_PARAM';

    /**
     * 任务 子任务
     */
    const TASK_SON = 'TASK_SON';

    /**
     * 任务队列id
     */
    const TASK_QUEUE_ID = 'TASK_QUEUE_ID';

    /**
     * 任务 处理消息队列
     */
    const TASK_SERVICE_HANDLER_MQ = 'TASK_SERVICE_HANDLER_MQ';
}