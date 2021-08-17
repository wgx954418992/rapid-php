<?php


namespace apps\core\classier\enum;


use enum\classier\Enum;

class SendType extends Enum
{

    /**
     * 发送验证码方式,短信
     */
    const SMS = 1;

    /**
     * 发送验证码方式,邮件
     */
    const EMAIL = 2;
}
