<?php
namespace application\model;

use rapidPHP\library\AB;

/**
 * 订单表
 */
class AppOrderModel extends AB
{
    /**
     * 数据库表结构
     * @var array
     */
    public static $table = [
        'name' => 'app_order',
        'comment' => '订单表',
        'column' => [
            'orderId' => ['type' => 'bigint', 'length' => 0, 'comment' => '订单表'],
            'userId' => ['type' => 'bigint', 'length' => 0, 'comment' => '用户id'],
            'sellerId' => ['type' => 'bigint', 'length' => 0, 'comment' => '商户id'],
            'deliveryId' => ['type' => 'bigint', 'length' => 0, 'comment' => '配送人员Id'],
            'goodsTotalFee' => ['type' => 'decimal', 'length' => 0, 'comment' => '订单货物总价格'],
            'deliveryTotalFee' => ['type' => 'decimal', 'length' => 0, 'comment' => '订单配送费用'],
            'deliveryStatus' => ['type' => 'int', 'length' => 0, 'comment' => '配送状态 1 待确认，2 待取货，3 配送中，4配送完成（等待给商户结算）, 5 已结算'],
            'orderStatus' => ['type' => 'int', 'length' => 0, 'comment' => '订单状态 1 待发货，2配送中 ，3 待评价'],
            'goodsDateTime' => ['type' => 'datetime', 'length' => 0, 'comment' => '发货时间'],
            'receiptAddress' => ['type' => 'varchar', 'length' => 100, 'comment' => '收货地址'],
            'receiptName' => ['type' => 'varchar', 'length' => 32, 'comment' => '收货人姓名'],
            'receiptTel' => ['type' => 'varchar', 'length' => 11, 'comment' => '收货人电话'],
            'isDelete' => ['type' => 'int', 'length' => 0, 'comment' => '是否删除'],
            'createdUserId' => ['type' => 'bigint', 'length' => 0, 'comment' => '创建人Id'],
            'createdTime' => ['type' => 'datetime', 'length' => 0, 'comment' => '创建时间'],
            'updatedUserId' => ['type' => 'bigint', 'length' => 0, 'comment' => '修改人Id'],
            'updatedTime' => ['type' => 'datetime', 'length' => 0, 'comment' => '修改时间'],
        ]
    ];

    /**
     * AppOrderModel constructor.
     * @param array|null $data
     */
    public function __construct(array $data = null)
    {
        parent::__construct($data);
    }
    
    /**
     * 获取 订单表
     * @return mixed
     */
    public function getOrderId()
    {
        return $this->getValue('orderId');
    }
    
    /**
     * 设置 订单表
     * @param $orderId
     * @return AppOrderModel
     */
    public function setOrderId($orderId)
    {
        return $this->setValue('orderId', $orderId);
    }
    
    /**
     * 获取 用户id
     * @return mixed
     */
    public function getUserId()
    {
        return $this->getValue('userId');
    }
    
    /**
     * 设置 用户id
     * @param $userId
     * @return AppOrderModel
     */
    public function setUserId($userId)
    {
        return $this->setValue('userId', $userId);
    }
    
    /**
     * 获取 商户id
     * @return mixed
     */
    public function getSellerId()
    {
        return $this->getValue('sellerId');
    }
    
    /**
     * 设置 商户id
     * @param $sellerId
     * @return AppOrderModel
     */
    public function setSellerId($sellerId)
    {
        return $this->setValue('sellerId', $sellerId);
    }
    
    /**
     * 获取 配送人员Id
     * @return mixed
     */
    public function getDeliveryId()
    {
        return $this->getValue('deliveryId');
    }
    
    /**
     * 设置 配送人员Id
     * @param $deliveryId
     * @return AppOrderModel
     */
    public function setDeliveryId($deliveryId)
    {
        return $this->setValue('deliveryId', $deliveryId);
    }
    
    /**
     * 获取 订单货物总价格
     * @return mixed
     */
    public function getGoodsTotalFee()
    {
        return $this->getValue('goodsTotalFee');
    }
    
    /**
     * 设置 订单货物总价格
     * @param $goodsTotalFee
     * @return AppOrderModel
     */
    public function setGoodsTotalFee($goodsTotalFee)
    {
        return $this->setValue('goodsTotalFee', $goodsTotalFee);
    }
    
    /**
     * 获取 订单配送费用
     * @return mixed
     */
    public function getDeliveryTotalFee()
    {
        return $this->getValue('deliveryTotalFee');
    }
    
    /**
     * 设置 订单配送费用
     * @param $deliveryTotalFee
     * @return AppOrderModel
     */
    public function setDeliveryTotalFee($deliveryTotalFee)
    {
        return $this->setValue('deliveryTotalFee', $deliveryTotalFee);
    }
    
    /**
     * 获取 配送状态 1 待确认，2 待取货，3 配送中，4配送完成（等待给商户结算）, 5 已结算
     * @return int
     */
    public function getDeliveryStatus(): ?int
    {
        return $this->getValue('deliveryStatus');
    }
    
    /**
     * 设置 配送状态 1 待确认，2 待取货，3 配送中，4配送完成（等待给商户结算）, 5 已结算
     * @param int $deliveryStatus
     * @return AppOrderModel
     */
    public function setDeliveryStatus(?int $deliveryStatus)
    {
        return $this->setValue('deliveryStatus', $deliveryStatus);
    }
    
    /**
     * 获取 订单状态 1 待发货，2配送中 ，3 待评价
     * @return int
     */
    public function getOrderStatus(): ?int
    {
        return $this->getValue('orderStatus');
    }
    
    /**
     * 设置 订单状态 1 待发货，2配送中 ，3 待评价
     * @param int $orderStatus
     * @return AppOrderModel
     */
    public function setOrderStatus(?int $orderStatus)
    {
        return $this->setValue('orderStatus', $orderStatus);
    }
    
    /**
     * 获取 发货时间
     * @return mixed
     */
    public function getGoodsDateTime()
    {
        return $this->getValue('goodsDateTime');
    }
    
    /**
     * 设置 发货时间
     * @param $goodsDateTime
     * @return AppOrderModel
     */
    public function setGoodsDateTime($goodsDateTime)
    {
        return $this->setValue('goodsDateTime', $goodsDateTime);
    }
    
    /**
     * 获取 收货地址
     * @return mixed
     */
    public function getReceiptAddress()
    {
        return $this->getValue('receiptAddress');
    }
    
    /**
     * 设置 收货地址
     * @param $receiptAddress
     * @return AppOrderModel
     */
    public function setReceiptAddress($receiptAddress)
    {
        return $this->setValue('receiptAddress', $receiptAddress);
    }
    
    /**
     * 获取 收货人姓名
     * @return mixed
     */
    public function getReceiptName()
    {
        return $this->getValue('receiptName');
    }
    
    /**
     * 设置 收货人姓名
     * @param $receiptName
     * @return AppOrderModel
     */
    public function setReceiptName($receiptName)
    {
        return $this->setValue('receiptName', $receiptName);
    }
    
    /**
     * 获取 收货人电话
     * @return mixed
     */
    public function getReceiptTel()
    {
        return $this->getValue('receiptTel');
    }
    
    /**
     * 设置 收货人电话
     * @param $receiptTel
     * @return AppOrderModel
     */
    public function setReceiptTel($receiptTel)
    {
        return $this->setValue('receiptTel', $receiptTel);
    }
    
    /**
     * 获取 是否删除
     * @return int
     */
    public function getIsDelete(): ?int
    {
        return $this->getValue('isDelete');
    }
    
    /**
     * 设置 是否删除
     * @param int $isDelete
     * @return AppOrderModel
     */
    public function setIsDelete(?int $isDelete)
    {
        return $this->setValue('isDelete', $isDelete);
    }
    
    /**
     * 获取 创建人Id
     * @return mixed
     */
    public function getCreatedUserId()
    {
        return $this->getValue('createdUserId');
    }
    
    /**
     * 设置 创建人Id
     * @param $createdUserId
     * @return AppOrderModel
     */
    public function setCreatedUserId($createdUserId)
    {
        return $this->setValue('createdUserId', $createdUserId);
    }
    
    /**
     * 获取 创建时间
     * @return mixed
     */
    public function getCreatedTime()
    {
        return $this->getValue('createdTime');
    }
    
    /**
     * 设置 创建时间
     * @param $createdTime
     * @return AppOrderModel
     */
    public function setCreatedTime($createdTime)
    {
        return $this->setValue('createdTime', $createdTime);
    }
    
    /**
     * 获取 修改人Id
     * @return mixed
     */
    public function getUpdatedUserId()
    {
        return $this->getValue('updatedUserId');
    }
    
    /**
     * 设置 修改人Id
     * @param $updatedUserId
     * @return AppOrderModel
     */
    public function setUpdatedUserId($updatedUserId)
    {
        return $this->setValue('updatedUserId', $updatedUserId);
    }
    
    /**
     * 获取 修改时间
     * @return mixed
     */
    public function getUpdatedTime()
    {
        return $this->getValue('updatedTime');
    }
    
    /**
     * 设置 修改时间
     * @param $updatedTime
     * @return AppOrderModel
     */
    public function setUpdatedTime($updatedTime)
    {
        return $this->setValue('updatedTime', $updatedTime);
    }
}