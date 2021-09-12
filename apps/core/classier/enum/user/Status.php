<?php


namespace apps\core\classier\enum\user;


use enum\classier\Enum;

class Status extends Enum
{
    /**
     * 正常
     */
    const NORMAL = 1;

    /**
     * 注销中
     */
    const Destroying = 2;

    /**
     * 已注销
     */
    const Destroyed = 3;
}
