<?php


namespace apps\core\classier\enum\follow;


use enum\classier\Enum;

class Status extends Enum
{

    /**
     * 状态 申请中
     */
    const APPLY = 1;

    /**
     * 状态 已关注
     */
    const RELATION = 2;
}
