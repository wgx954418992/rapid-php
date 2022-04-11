<?php


namespace apps\core\classier\enum\follow;


use enum\classier\Enum;

class Type extends Enum
{

    /**
     * 关注类型 单向关注
     */
    const ONE = 1;

    /**
     * 关注类型 双向关注
     */
    const DOUBLE = 2;
}
