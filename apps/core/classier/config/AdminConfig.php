<?php

namespace apps\core\classier\config;

use function rapidPHP\B;

class AdminConfig
{
    /**
     * 管理员账号类型，web管理系统
     */
    const TYPE_ADMIN = 1;

    /***
     * 流转状态
     * @var array
     */
    public static $types = [
        self::TYPE_ADMIN => 'web管理系统',
    ];

    /**
     * 获取type文本类型
     * @param $type
     * @return mixed|null
     */
    public static function getTypeText($type)
    {
        return B()->getData(self::$types, $type);
    }
}