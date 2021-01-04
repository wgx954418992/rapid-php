<?php

namespace apps\core\classier\config;

use function rapidPHP\B;

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

    /**
     * 用户类型，用户
     */
    const TYPE_PERSON = 1;

    /**
     * 用户类型，企业用户
     */
    const TYPE_COMPANY = 2;

    /**
     * 用户类型，企业用户
     */
    const STATUS_NORMAL = 0;

    /**
     * 用户状态，等待激活
     */
    const STATUS_WAITING = 1;

    /**
     * 用户状态，已删除
     */
    const STATUS_DELETED = 2;

    /**
     * 人员类型，法人
     */
    const PERSON_LEGAL = 1;

    /**
     * 人员类型，操作人员
     */
    const PERSON_ACTION = 2;

    /**
     * 人员类型，财务
     */
    const PERSON_FINANCE = 3;

    /***
     * 人员类型
     * @var array
     */
    public static $person_types = [
        self::PERSON_LEGAL => '法人',
        self::PERSON_ACTION => '操作人员',
        self::PERSON_FINANCE => '财务',
    ];

    /**
     * 获取人员类型文本类型
     * @param $type
     * @return mixed|null
     */
    public static function getPersonTypeText($type)
    {
        return B()->getData(self::$person_types, $type);
    }

    /**
     * 区域类型，注册地址
     */
    const REGION_REGISTER = 1;

    /**
     * 区域类型，办公操作地址
     */
    const REGION_ACTION = 2;

    /**
     * 区域类型，仓库地址
     */
    const REGION_WAREHOUSE = 3;

    /***
     * 区域类型
     * @var array
     */
    public static $region_types = [
        self::REGION_REGISTER => '注册地址',
        self::REGION_ACTION => '办公操作地址',
        self::REGION_WAREHOUSE => '仓库地址',
    ];

    /**
     * 获取区域类型文本类型
     * @param $type
     * @return mixed|null
     */
    public static function getRegionTypeText($type)
    {
        return B()->getData(self::$person_types, $type);
    }
}