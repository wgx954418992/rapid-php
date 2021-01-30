<?php

namespace apps\core\classier\config;

class UserConfig
{
    /**
     * 登录类型 web
     */
    const TOKEN_WEB = 1;

    /**
     * 用户来源类型 注册
     */
    const SOURCE_REGISTER = 1;

    /**
     * 用户来源类型 后台导入
     */
    const SOURCE_ADMIN_IMPORT = 2;
}