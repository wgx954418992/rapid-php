<?php


namespace apps\core\classier\enum;


use enum\classier\Enum;

class LoginType extends Enum
{

    /**
     * 账号登录
     */
    const ACCOUNT = 'ACCOUNT';

    /**
     * 验证码登录
     */
    const CODE = 'CODE';

    /**
     * 微信小程序登录
     */
    const WX_MINI = 'WX_MINI';

    /**
     * 微信 公众号h5登录
     */
    const WX_PUBLICLY = 'WX_PUBLICLY';

    /**
     * 微信 管理员账号密码登录
     */
    const ADMIN_ACCOUNT = 'ADMIN_ACCOUNT';
}
