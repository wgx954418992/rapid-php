<?php


namespace apps\core\classier\enum\report;


use enum\classier\Enum;

class Status extends Enum
{
    /**
     * 举报状态，待处理
     */
    const WAITING = 1;

    /**
     * 举报状态，已处理
     */
    const PROCESSED = 2;
}
