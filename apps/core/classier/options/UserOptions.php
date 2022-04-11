<?php


namespace apps\core\classier\options;


use rapidPHP\modules\options\classier\Options;

class UserOptions extends Options
{

    /**
     * 用户信息 可选条件
     */
    const OPTIONS = 1;

    /**
     * 用户信息 可选条件 获取关注信息
     */
    const FOLLOW = self::OPTIONS << 1;

    /**
     * 用户信息 可选条件 隐私信息，用于系统内部
     */
    const PRIVATE = self::OPTIONS << 2;

    /**
     * 用户信息 可选条件 积分
     */
    const INTEGRAL = self::OPTIONS << 3;

    /**
     * 用户信息 可选条件 余额
     */
    const WALLET = self::OPTIONS << 4;

    /**
     * 用户信息 可选条件 专业
     */
    const MAJOR = self::OPTIONS << 5;

    /**
     * 用户信息 可选条件 顶级专业
     */
    const TOP_MAJOR = self::OPTIONS << 6;

    /**
     * 用户信息 可选条件 具体专业
     */
    const SPECIFIC_MAJOR = self::OPTIONS << 7;

    /**
     * 用户信息 可选条件 当前专业会员
     */
    const MEMBER = self::OPTIONS << 8;
}
