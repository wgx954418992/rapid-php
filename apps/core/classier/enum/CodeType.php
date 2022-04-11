<?php


namespace apps\core\classier\enum;


use enum\classier\Enum;

class CodeType extends Enum
{

    /**
     * 验证码类型,登录
     */
    const LOGIN = 'login';

    /**
     * 验证码类型，绑定手机
     */
    const BIND_TELEPHONE = 'bind_telephone';

    /**
     * 验证码类型,更改手机号码之前验证老手机
     */
    const CHANGE_VERIFY = 'change_verify';

    /**
     * 验证码类型,更改手机号码
     */
    const CHANGE_TELEPHONE = 'change_telephone';
}
