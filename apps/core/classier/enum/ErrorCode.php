<?php


namespace apps\core\classier\enum;


use enum\classier\Enum;

class ErrorCode extends Enum
{

    /**
     * 用户登录状态，未登录
     */
    const USER_LOGIN_NOT = 1001;

    /**
     * 用户信息，用户资质审核失败
     */
    const USER_CERTIFICATES_FAILED = 1101;

    /**
     * 文件不存在
     */
    const FILE_NOT = 2001;

    /**
     * 无权限访问文件
     */
    const FILE_NOT_POWER = 2002;
}
