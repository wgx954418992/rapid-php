<?php

namespace apps\admin\classier\config;

use function rapidPHP\B;

class RouteConfig
{
    /**
     * route 类型  菜单
     */
    const TYPE_MENU = 1;

    /**
     * route 类型  api
     */
    const TYPE_API = 2;

    /**
     * route 类型  其他
     */
    const TYPE_OTHER = 3;

    /**
     * route 类型  页面
     */
    const TYPE_PAGE = 4;

    /***
     * route 类型
     * @var array
     */
    public static $types = [
        self::TYPE_MENU => '菜单',
        self::TYPE_API => 'api',
        self::TYPE_OTHER => '其他',
        self::TYPE_PAGE => '页面',
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