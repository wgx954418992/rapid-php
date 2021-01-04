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
     * 给商户推送提醒
     * 如果选择了配送员就给配送员推送提醒
     * @param $orderId
     * @param AppOrderModel $orderModel
     * @param AppQueueModel $queueModel
     * @throws Exception
     */
    public function onProcess($orderId, AppOrderModel $orderModel, AppQueueModel $queueModel)
    {

    }
}