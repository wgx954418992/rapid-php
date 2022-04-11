<?php


namespace apps\core\classier\enum\feedback;


use enum\classier\Enum;

class Status extends Enum
{
    /**
     * 反馈状态，待处理
     */
    const WAITING = 1;

    /**
     * 反馈状态，已处理
     */
    const PROCESSED = 2;
}
