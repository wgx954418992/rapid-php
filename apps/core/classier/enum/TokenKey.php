<?php


namespace apps\core\classier\enum;


use enum\classier\Enum;

class TokenKey extends Enum
{

    /**
     * 用户token key
     */
    const USER = 'Token';

    /**
     * 管理员token key
     */
    const ADMIN = 'Tokenadmin';
}
