<?php

namespace apps\core\classier\dao\master;

use apps\core\classier\config\OrderConfig;
use apps\core\classier\dao\MasterDao;
use apps\core\classier\model\AppOrderModel;
use Exception;
use function rapidPHP\Cal;

class OrderDao extends MasterDao
{

    public function __construct()
    {
        parent::__construct(AppOrderModel::class);
    }

    /**
     * 添加订单
     * @param AppOrderModel $orderModel
     * @return bool
     * @throws Exception
     */
    public function addOrder(AppOrderModel $orderModel): bool
    {
        return parent::add([
            'id' => $orderModel->getId(),
            'user_id' => $orderModel->getUserId(),
            'goods_type' => $orderModel->getGoodsType(),
            'number' => $orderModel->getNumber(),
            'status' => OrderConfig::ORDER_STATUS_CONFIRMING,
            'pay_status' => OrderConfig::PAY_STATUS_WAITING,
            'is_delete' => false,
            'created_id' => $orderModel->getCreatedId(),
            'created_time' => Cal()->getDate(),
        ]);
    }

    /**
     * 修改订单
     * @param AppOrderModel $orderModel
     * @return bool
     * @throws Exception
     */
    public function setOrder(AppOrderModel $orderModel): bool
    {
        $data = [
            'updated_id' => $orderModel->getCreatedId(),
            'updated_time' => Cal()->getDate(),
        ];

        if($orderModel->getGoodsType()){
            $data['goods_type'] = $orderModel->getGoodsType();
        }

        if($orderModel->getNumber()){
            $data['number'] = $orderModel->getNumber();
        }

        if($orderModel->getStatus()){
            $data['status'] = $orderModel->getStatus();
        }

        if($orderModel->getPayStatus()){
            $data['pay_status'] = $orderModel->getPayStatus();
        }

        if($orderModel->getInWtime()){
            $data['in_wtime'] = $orderModel->getInWtime();
        }

        if($orderModel->getReachWtime()){
            $data['reach_wtime'] = $orderModel->getReachWtime();
        }

        if($orderModel->getPickupCode()){
            $data['pickup_code'] = $orderModel->getPickupCode();
        }

        return parent::set($data)->where('id', $orderModel->getId())->execute();
    }

    /**
     * 设置订单状态
     * @param AppOrderModel $orderModel
     * @return bool
     * @throws Exception
     */
    public function setOrderStatus(AppOrderModel $orderModel): bool
    {
        return parent::set([
            'status' => $orderModel->getStatus(),
            'updated_id' => $orderModel->getUpdatedId(),
            'updated_time' => Cal()->getDate(),
        ])->where('id', $orderModel->getId())->execute();
    }

    /**
     * 设置订单支付状态
     * @param AppOrderModel $orderModel
     * @return bool
     * @throws Exception
     */
    public function setOrderPayStatus(AppOrderModel $orderModel): bool
    {
        return parent::set([
            'pay_status' => $orderModel->getPayStatus(),
            'updated_id' => $orderModel->getUpdatedId(),
            'updated_time' => Cal()->getDate(),
        ])->where('id', $orderModel->getId())->execute();
    }

    /**
     * 获取订单信息
     * @param $orderId
     * @return AppOrderModel|null
     * @throws Exception
     */
    public function getOrder($orderId): ?AppOrderModel
    {
        /** @var AppOrderModel $model */
        $model = parent::get()
            ->where('id', $orderId)
            ->where('is_delete', false)
            ->getStatement()
            ->fetch($this->getModelOrClass());

        return $model;
    }


    /**
     * 删除订单
     * @param $userId
     * @param $orderId
     * @return bool
     * @throws Exception
     */
    public function delOrder($userId, $orderId): bool
    {
        return parent::set([
            'is_delete' => true,
            'updated_id' => $userId,
            'updated_time' => Cal()->getDate(),
        ])->where('id', $orderId)->execute();
    }
}