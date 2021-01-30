<?php

namespace apps\core\classier\config;

use function rapidPHP\B;

class CompanyConfig
{

    /**
     * 用户状态，1 正常
     */
    const STATUS_NORMAL = 1;

    /**
     * 用户状态，2 待审核
     */
    const STATUS_WAITING = 2;

    /**
     * 用户状态文本
     * @var array
     */
    const STATUS = [
        self::STATUS_NORMAL => '正常',
        self::STATUS_WAITING => '待审核',
    ];

    /**
     * 获取订单状态
     * @param $status
     * @return mixed
     */
    public static function getStatusText($status)
    {
        $t = B()->getData(self::STATUS, $status);

        return B()->contrast($t, '状态错误');
    }

}