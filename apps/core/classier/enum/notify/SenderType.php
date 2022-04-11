<?php


namespace apps\core\classier\enum\notify;


use enum\classier\Enum;

class SenderType extends Enum
{

    /**
     * 发送事件者的类型 系统
     */
    const SYSTEM = 1;

    /**
     * 发送事件者的类型 用户
     */
    const USER = 2;
}
