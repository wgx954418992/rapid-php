<?php

namespace apps\core\classier\config;


use function rapidPHP\B;

class AddressConfig
{

    /**
     * 地址类型=>欧洲店铺
     */
    const TYPE_EUROPEAN_STORES = 1;

    /**
     * 地址类型=>中国工厂
     */
    const TYPE_CHINESE_FACTORIES = 2;

    /**
     * 地址类型=>仓库
     */
    const TYPE_CHINESE_WAREHOUSE = 3;

    /***
     * 地址类型
     * @var array
     */
    const TYPES = [
        self::TYPE_EUROPEAN_STORES => '欧洲店铺',
        self::TYPE_CHINESE_FACTORIES => '中国工厂',
        self::TYPE_CHINESE_WAREHOUSE => '仓库',
    ];

    /**
     * 获取类型文本
     * @param $type
     * @return bool
     */
    public static function getTypeText($type)
    {
        $t = B()->getData(self::TYPES, $type);

        return B()->contrast($t, '状态错误');
    }

    /**
     * 效验类型
     * @param $type
     * @return bool
     */
    public static function validType($type): bool
    {
        return isset(self::TYPES[$type]);
    }
}