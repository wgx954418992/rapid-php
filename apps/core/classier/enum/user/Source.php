<?php


namespace apps\core\classier\enum\user;


use enum\classier\Enum;

class Source extends Enum
{

    /**
     * 用户来源类型 注册
     */
    const REGISTER = 1;

    /**
     * 用户来源类型 后台导入
     */
    const ADMIN_IMPORT = 2;
}
