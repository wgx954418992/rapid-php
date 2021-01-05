<?php

namespace apps\queue\classier\process\order;

use apps\core\classier\model\AppOrderModel;
use apps\core\classier\model\AppQueueModel;
use Exception;
use ReflectionException;

class CreatedProcess extends OrderParentProcess
{

    /**
     * 处理订单创建成功
     * @param $orderId
     * @param AppOrderModel $orderModel
     * @param AppQueueModel $queueModel
     * @throws Exception
     */
    public function onProcess($orderId, AppOrderModel $orderModel, AppQueueModel $queueModel)
    {

    }
}