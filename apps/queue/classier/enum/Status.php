<?php


namespace apps\queue\classier\enum;


use enum\classier\Enum;

class Status extends Enum
{

    /**
     * 队列状态 0  已取消
     */
    const CANCEL = 0;

    /**
     * 队列状态 1 等待中
     */
    const WAITING = 1;

    /**
     * 队列状态 2 执行中
     */
    const IN_EXECUTION = 2;

    /**
     * 队列状态 3 执行完毕
     */
    const COMPLETE = 3;

    /**
     * 队列状态 4 执行异常
     */
    const EXCEPTION = 4;
}
