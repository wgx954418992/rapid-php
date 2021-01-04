<?php

namespace apps\core\classier\service;

use apps\core\classier\bean\OrderListCondition;
use apps\core\classier\dao\master\OrderDao;
use apps\core\classier\model\AppOrderModel;
use Exception;
use ReflectionException;

class OrderService
{

    /**
     * 创建订单
     * @param $factoryId
     * @param $goodsType
     * @param $count
     * @return int
     * @throws Exception
     */
    public function createOrder($factoryId, $goodsType, $count)
    {
        if (empty($factoryId)) throw new Exception('工厂id错误!');

        if (empty($goodsType)) throw new Exception('货物类型错误!');

        if ($count<1) throw new Exception('货物数量错误!');

        //....下单
    }
}