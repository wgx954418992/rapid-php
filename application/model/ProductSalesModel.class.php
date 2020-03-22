<?php
namespace application\model;

use rapidPHP\library\AB;

/**
 * 产品销售表
 */
class ProductSalesModel extends AB
{
    /**
     * 数据库表结构
     * @var array
     */
    public static $table = [
        'name' => 'product_sales',
        'comment' => '产品销售表',
        'column' => [
            'salesId' => ['type' => 'varchar', 'length' => 32, 'comment' => '销售记录Id'],
            'userId' => ['type' => 'varchar', 'length' => 32, 'comment' => '用户Id'],
            'productId' => ['type' => 'varchar', 'length' => 32, 'comment' => '产品Id'],
            'orderId' => ['type' => 'varchar', 'length' => 32, 'comment' => '订单Id'],
            'count' => ['type' => 'int', 'length' => 0, 'comment' => '购买数量'],
            'year' => ['type' => 'int', 'length' => 0, 'comment' => '年'],
            'month' => ['type' => 'int', 'length' => 0, 'comment' => '月'],
            'day' => ['type' => 'int', 'length' => 0, 'comment' => '日'],
            'isDelete' => ['type' => 'int', 'length' => 0, 'comment' => '是否删除'],
            'createdUserId' => ['type' => 'bigint', 'length' => 0, 'comment' => '创建人Id'],
            'createdTime' => ['type' => 'datetime', 'length' => 0, 'comment' => '创建时间'],
            'updatedUserId' => ['type' => 'bigint', 'length' => 0, 'comment' => '修改人Id'],
            'updatedTime' => ['type' => 'datetime', 'length' => 0, 'comment' => '修改时间'],
        ]
    ];

    /**
     * ProductSalesModel constructor.
     * @param array|null $data
     */
    public function __construct(array $data = null)
    {
        parent::__construct($data);
    }
    
    /**
     * 获取 销售记录Id
     * @return mixed
     */
    public function getSalesId()
    {
        return $this->getValue('salesId');
    }
    
    /**
     * 设置 销售记录Id
     * @param $salesId
     * @return ProductSalesModel
     */
    public function setSalesId($salesId)
    {
        return $this->setValue('salesId', $salesId);
    }
    
    /**
     * 获取 用户Id
     * @return mixed
     */
    public function getUserId()
    {
        return $this->getValue('userId');
    }
    
    /**
     * 设置 用户Id
     * @param $userId
     * @return ProductSalesModel
     */
    public function setUserId($userId)
    {
        return $this->setValue('userId', $userId);
    }
    
    /**
     * 获取 产品Id
     * @return mixed
     */
    public function getProductId()
    {
        return $this->getValue('productId');
    }
    
    /**
     * 设置 产品Id
     * @param $productId
     * @return ProductSalesModel
     */
    public function setProductId($productId)
    {
        return $this->setValue('productId', $productId);
    }
    
    /**
     * 获取 订单Id
     * @return mixed
     */
    public function getOrderId()
    {
        return $this->getValue('orderId');
    }
    
    /**
     * 设置 订单Id
     * @param $orderId
     * @return ProductSalesModel
     */
    public function setOrderId($orderId)
    {
        return $this->setValue('orderId', $orderId);
    }
    
    /**
     * 获取 购买数量
     * @return int
     */
    public function getCount(): ?int
    {
        return $this->getValue('count');
    }
    
    /**
     * 设置 购买数量
     * @param int $count
     * @return ProductSalesModel
     */
    public function setCount(?int $count)
    {
        return $this->setValue('count', $count);
    }
    
    /**
     * 获取 年
     * @return int
     */
    public function getYear(): ?int
    {
        return $this->getValue('year');
    }
    
    /**
     * 设置 年
     * @param int $year
     * @return ProductSalesModel
     */
    public function setYear(?int $year)
    {
        return $this->setValue('year', $year);
    }
    
    /**
     * 获取 月
     * @return int
     */
    public function getMonth(): ?int
    {
        return $this->getValue('month');
    }
    
    /**
     * 设置 月
     * @param int $month
     * @return ProductSalesModel
     */
    public function setMonth(?int $month)
    {
        return $this->setValue('month', $month);
    }
    
    /**
     * 获取 日
     * @return int
     */
    public function getDay(): ?int
    {
        return $this->getValue('day');
    }
    
    /**
     * 设置 日
     * @param int $day
     * @return ProductSalesModel
     */
    public function setDay(?int $day)
    {
        return $this->setValue('day', $day);
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
     * @return ProductSalesModel
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
     * @return ProductSalesModel
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
     * @return ProductSalesModel
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
     * @return ProductSalesModel
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
     * @return ProductSalesModel
     */
    public function setUpdatedTime($updatedTime)
    {
        return $this->setValue('updatedTime', $updatedTime);
    }
}