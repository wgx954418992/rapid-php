<?php
namespace application\model;

use rapidPHP\library\AB;

/**
 * 配送人员表
 */
class DeliveryPriceModel extends AB
{
    /**
     * 数据库表结构
     * @var array
     */
    public static $table = [
        'name' => 'delivery_price',
        'comment' => '配送人员表',
        'column' => [
            'priceId' => ['type' => 'bigint', 'length' => 0, 'comment' => '价格id'],
            'deliveryId' => ['type' => 'bigint', 'length' => 0, 'comment' => '配送人员Id'],
            'categoryId' => ['type' => 'bigint', 'length' => 0, 'comment' => '分类Id（如果为空则是默认价格）'],
            'price' => ['type' => 'decimal', 'length' => 0, 'comment' => '价格'],
            'weight' => ['type' => 'int', 'length' => 0, 'comment' => '重量（单位 k）'],
            'isDelete' => ['type' => 'int', 'length' => 0, 'comment' => '是否删除'],
            'createdUserId' => ['type' => 'bigint', 'length' => 0, 'comment' => '创建人Id'],
            'createdTime' => ['type' => 'datetime', 'length' => 0, 'comment' => '创建时间'],
            'updatedUserId' => ['type' => 'bigint', 'length' => 0, 'comment' => '修改人Id'],
            'updatedTime' => ['type' => 'datetime', 'length' => 0, 'comment' => '修改时间'],
        ]
    ];

    /**
     * DeliveryPriceModel constructor.
     * @param array|null $data
     */
    public function __construct(array $data = null)
    {
        parent::__construct($data);
    }
    
    /**
     * 获取 价格id
     * @return mixed
     */
    public function getPriceId()
    {
        return $this->getValue('priceId');
    }
    
    /**
     * 设置 价格id
     * @param $priceId
     * @return DeliveryPriceModel
     */
    public function setPriceId($priceId)
    {
        return $this->setValue('priceId', $priceId);
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
     * @return DeliveryPriceModel
     */
    public function setDeliveryId($deliveryId)
    {
        return $this->setValue('deliveryId', $deliveryId);
    }
    
    /**
     * 获取 分类Id（如果为空则是默认价格）
     * @return mixed
     */
    public function getCategoryId()
    {
        return $this->getValue('categoryId');
    }
    
    /**
     * 设置 分类Id（如果为空则是默认价格）
     * @param $categoryId
     * @return DeliveryPriceModel
     */
    public function setCategoryId($categoryId)
    {
        return $this->setValue('categoryId', $categoryId);
    }
    
    /**
     * 获取 价格
     * @return mixed
     */
    public function getPrice()
    {
        return $this->getValue('price');
    }
    
    /**
     * 设置 价格
     * @param $price
     * @return DeliveryPriceModel
     */
    public function setPrice($price)
    {
        return $this->setValue('price', $price);
    }
    
    /**
     * 获取 重量（单位 k）
     * @return int
     */
    public function getWeight(): ?int
    {
        return $this->getValue('weight');
    }
    
    /**
     * 设置 重量（单位 k）
     * @param int $weight
     * @return DeliveryPriceModel
     */
    public function setWeight(?int $weight)
    {
        return $this->setValue('weight', $weight);
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
     * @return DeliveryPriceModel
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
     * @return DeliveryPriceModel
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
     * @return DeliveryPriceModel
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
     * @return DeliveryPriceModel
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
     * @return DeliveryPriceModel
     */
    public function setUpdatedTime($updatedTime)
    {
        return $this->setValue('updatedTime', $updatedTime);
    }
}