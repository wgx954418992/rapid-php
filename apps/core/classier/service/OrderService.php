<?php

namespace apps\core\classier\service;

use apps\core\classier\bean\OrderListCondition;
use apps\core\classier\config\AddressConfig;
use apps\core\classier\config\OrderConfig;
use apps\core\classier\dao\master\AddressDao;
use apps\core\classier\dao\master\OrderDao;
use apps\core\classier\dao\master\ViewOrderDao;
use apps\core\classier\dao\MasterDao;
use apps\core\classier\model\AppOrderModel;
use apps\core\classier\wrapper\ViewOrderWrapper;
use apps\queue\classier\config\QueueConfig;
use apps\queue\classier\service\QueueService;
use Exception;
use rapidPHP\modules\common\classier\Instances;
use function rapidPHP\B;

class OrderService
{
    /**
     * 单列模式
     */
    use Instances;

    /**
     * @return static
     */
    public static function onNotInstance()
    {
        return new static();
    }

    /**
     * 创建订单
     * @param AppOrderModel $orderModel
     * @param $factoryId
     * @param $warehouseId
     * @return AppOrderModel
     * @throws Exception
     */
    public function createOrder(AppOrderModel $orderModel, $factoryId, $warehouseId)
    {
        if (empty($factoryId)) throw new Exception('工厂id错误!');

        $orderModel->validUserId('用户id 错误!');

        $orderModel->validGoodsType('货物类型错误!');

        if ($orderModel->getNumber() < 1) throw new Exception('货物数量错误!');

        /** @var AddressDao $addressDao */
        $addressDao = AddressDao::getInstance();

        $factoryModel = $addressDao->getAddress($factoryId);

        if ($factoryModel == null) throw new Exception('工厂不存在!');

        if ($factoryModel->getType() != AddressConfig::TYPE_CHINESE_FACTORIES)
            throw new Exception('工厂类型错误!');

        $warehouseModel = $warehouseId ? $addressDao->getAddress($warehouseId) : null;

        if ($warehouseModel && $warehouseModel->getType() != AddressConfig::TYPE_CHINESE_WAREHOUSE)
            throw new Exception('仓库类型错误!');

        /** @var OrderDao $orderDao */
        $orderDao = OrderDao::getInstance();

        MasterDao::getSQLDB()->beginTransaction();

        try {
            $orderId = B()->onlyIdToInt();

            $orderModel->setId($orderId);

            $orderDao->addOrder($orderModel);

            $factoryModel->setBindId($orderId);

            $factoryModel->setCreatedId($orderModel->getCreatedId());

            $factoryModel->setOriginalId($factoryModel->getId());

            $addressDao->addAddress($factoryModel);

            if ($warehouseModel != null) {
                $warehouseModel->setBindId($orderId);

                $warehouseModel->setOriginalId($warehouseModel->getId());

                $warehouseModel->setCreatedId($orderModel->getCreatedId());

                $addressDao->addAddress($warehouseModel);
            }

            if (!MasterDao::getSQLDB()->commit())
                throw new Exception('创建订单失败!');

            return $orderModel;
        } catch (Exception $e) {
            MasterDao::getSQLDB()->rollBack();

            throw $e;
        }
    }

    /**
     * 设置订单状态
     * @param AppOrderModel $orderModel
     * @return bool
     * @throws Exception
     */
    public function setOrder(AppOrderModel $orderModel)
    {
        $orderModel->validId('订单id 错误!');

        if ($orderModel->getStatus() == OrderConfig::ORDER_STATUS_WAIT_TAKE) {
            $orderModel->validPickupCode('取货码错误!');
        }

        /** @var OrderDao $orderDao */
        $orderDao = OrderDao::getInstance();

        $currentOrderModel = $orderDao->getOrder($orderModel->getId());

        if ($currentOrderModel == null) throw new Exception('订单不存在！');

        MasterDao::getSQLDB()->beginTransaction();

        try {
            $orderDao->setOrder($orderModel);

            if ($orderModel->getStatus() != $currentOrderModel->getStatus()) {
                QueueService::getInstance()
                    ->addOrderQueue(QueueConfig::TYPE_ORDER_STATUS_CHANGE, $orderModel);
            }

            if (!MasterDao::getSQLDB()->commit()) throw new Exception('修改订单失败!');

            return true;
        } catch (Exception $e) {
            MasterDao::getSQLDB()->rollBack();

            throw $e;
        }
    }


    /**
     * 获取订单信息
     * @param $orderId
     * @return AppOrderModel
     * @throws Exception
     */
    public function getOrder($orderId)
    {
        if (empty($orderId)) throw new Exception('订单id错误!');

        /** @var OrderDao $orderDao */
        $orderDao = OrderDao::getInstance();

        $orderModel = $orderDao->getOrder($orderId);

        if ($orderModel == null) throw new Exception('订单不存在!');

        return $orderModel;
    }

    /**
     * 获取订单详情
     * @param $orderId
     * @return ViewOrderWrapper
     * @throws Exception
     */
    public function getDetail($orderId)
    {
        if (empty($orderId)) throw new Exception('订单id错误!');

        /** @var ViewOrderDao $orderDao */
        $orderDao = ViewOrderDao::getInstance();

        $orderModel = $orderDao->getOrder($orderId);

        if ($orderModel == null) throw new Exception('订单不存在!');

        /** @var AreaService $areaService */
        $areaService = AreaService::getInstance();

        if ($orderModel->getFactoryAid()) {
            $fAreaAddress = $areaService->getAreaAddress($orderModel->getFactoryAid(), true);

            $orderModel->setFactoryAdetail($fAreaAddress);
        }

        if ($orderModel->getWarehouseAid()) {
            $wAreaAddress = $areaService->getAreaAddress($orderModel->getWarehouseAid(), true);

            $orderModel->setWarehouseAdetail($wAreaAddress);
        }

        return $orderModel;
    }

    /**
     * 获取订单列表
     * @param OrderListCondition $condition
     * @return array
     * @throws Exception
     */
    public function getList(OrderListCondition $condition)
    {
        /** @var ViewOrderDao $orderDao */
        $orderDao = ViewOrderDao::getInstance();

        $list = $orderDao->getOrderList($condition);

        /** @var AreaService $areaService */
        $areaService = AreaService::getInstance();

        foreach ($list as $value) {
            if ($value->getFactoryAid()) {
                $fAreaAddress = $areaService->getAreaAddress($value->getFactoryAid(), true);

                $value->setFactoryAdetail($fAreaAddress);
            }

            if ($value->getWarehouseAid()) {
                $wAreaAddress = $areaService->getAreaAddress($value->getWarehouseAid(), true);

                $value->setWarehouseAdetail($wAreaAddress);
            }
        }

        return $list;
    }

    /**
     * 获取订单列表数量
     * @param OrderListCondition $condition
     * @return int
     * @throws Exception
     */
    public function getListCount(OrderListCondition $condition)
    {
        /** @var ViewOrderDao $orderDao */
        $orderDao = ViewOrderDao::getInstance();

        return $orderDao->getOrderListCount($condition);
    }


}