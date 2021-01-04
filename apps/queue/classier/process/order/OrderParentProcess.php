<?php


namespace apps\queue\classier\process\order;

use apps\core\classier\model\AppOrderModel;
use apps\core\classier\model\AppQueueModel;
use apps\core\classier\service\BaseService;
use apps\core\classier\service\OrderService;
use Exception;
use apps\queue\classier\config\QueueConfig;
use rapidPHP\modules\process\classier\swoole\PipeProcess;
use function rapidPHP\B;

abstract class OrderParentProcess extends PipeProcess
{

    /**
     * @var OrderService
     */
    private $orderService;

    /**
     * OrderParentProcess constructor.
     * @param $sleep
     * @param null $mainProcess
     * @throws Exception
     */
    public function __construct($sleep, $mainProcess = null)
    {
        parent::__construct($sleep, $mainProcess);

        $this->orderService = new OrderService();
    }

    /**
     * 处理
     * @param $data
     * @return mixed|void
     */
    public function onHandler($data)
    {
        /** @var AppQueueModel $queueModel */
        $queueModel = unserialize($data);

        $param = B()->jsonDecode($queueModel->getParam());

        $orderId = B()->getData($param, QueueConfig::PARAM_KEY_ORDER_ID);

        try {

            $orderModel = $this->getOrderService()->getOrder($orderId);

            $this->onProcess($orderId, $orderModel, $queueModel);
        } catch (Exception $e) {
            BaseService::getInstance()->addLog($e->getMessage(), $e);
        }

        $parentProcess = $this->getParentProcess();

        if ($parentProcess instanceof PipeProcess) $parentProcess->onHandler($data);
    }

    /**
     * 子类重写该方法
     * @param $orderId
     * @param AppOrderModel $orderModel
     * @param AppQueueModel $queueModel
     */
    abstract public function onProcess($orderId, AppOrderModel $orderModel, AppQueueModel $queueModel);

    /**
     * 获取orderService
     * @return OrderService
     */
    protected function getOrderService()
    {
        return $this->orderService;
    }
}