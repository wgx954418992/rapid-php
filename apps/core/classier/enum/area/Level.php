<?php


namespace apps\core\classier\enum\area;


use enum\classier\Enum;

class Level extends Enum
{

    /**
     * 地区等级=》国家
     */
    const COUNTRY = 0;

    /**
     * 地区等级=》省
     */
    const PROVINCE = 1;

    /**
     * 地区等级=》市
     */
    const CITY = 2;

    /**
     * 地区等级=》区
     */
    const AREA = 3;
}
