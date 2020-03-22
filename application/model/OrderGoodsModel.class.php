<?php
namespace application\model;

use rapidPHP\library\AB;

/**
 * 订单货物表
 */
class OrderGoodsModel extends AB
{
    /**
     * 数据库表结构
     * @var array
     */
    public static $table = [
        'name' => 'order_goods',
        'comment' => '订单货物表',
        'column' => [
            'goodsId' => ['type' => 'bigint', 'length' => 0, 'comment' => '货物Id'],
            'productId' => ['type' => 'bigint', 'length' => 0, 'comment' => '产品id'],
            'productName' => ['type' => 'varchar', 'length' => 100, 'comment' => '产品名称'],
            'productPicFileId' => ['type' => 'varchar', 'length' => 1024, 'comment' => '产品图片'],
            'productPrice' => ['type' => 'decimal', 'length' => 0, 'comment' => '产品价格'],
            'productOriginalPrice' => ['type' => 'decimal', 'length' => 0, 'comment' => '产品原价'],
            'productWeight' => ['type' => 'int', 'length' => 0, 'comment' => '产品重量（单位 k）'],
            'count' => ['type' => 'int', 'length' => 0, 'comment' => '订单总数量'],
            'isDelete' => ['type' => 'int', 'length' => 0, 'comment' => '是否删除'],
            'createdUserId' => ['type' => 'bigint', 'length' => 0, 'comment' => '创建人Id'],
            'createdTime' => ['type' => 'datetime', 'length' => 0, 'comment' => '创建时间'],
            'updatedUserId' => ['type' => 'bigint', 'length' => 0, 'comment' => '修改人Id'],
            'updatedTime' => ['type' => 'datetime', 'length' => 0, 'comment' => '修改时间'],
        ]
    ];

    /**
     * OrderGoodsModel constructor.
     * @param array|null $data
     */
    public function __construct(array $data = null)
    {
        parent::__construct($data);
    }
    
    /**
     * 获取 货物Id
     * @return mixed
     */
    public function getGoodsId()
    {
        return $this->getValue('goodsId');
    }
    
    /**
     * 设置 货物Id
     * @param $goodsId
     * @return OrderGoodsModel
     */
    public function setGoodsId($goodsId)
    {
        return $this->setValue('goodsId', $goodsId);
    }
    
    /**
     * 获取 产品id
     * @return mixed
     */
    public function getProductId()
    {
        return $this->getValue('productId');
    }
    
    /**
     * 设置 产品id
     * @param $productId
     * @return OrderGoodsModel
     */
    public function setProductId($productId)
    {
        return $this->setValue('productId', $productId);
    }
    
    /**
     * 获取 产品名称
     * @return mixed
     */
    public function getProductName()
    {
        return $this->getValue('productName');
    }
    
    /**
     * 设置 产品名称
     * @param $productName
     * @return OrderGoodsModel
     */
    public function setProductName($productName)
    {
        return $this->setValue('productName', $productName);
    }
    
    /**
     * 获取 产品图片
     * @return mixed
     */
    public function getProductPicFileId()
    {
        return $this->getValue('productPicFileId');
    }
    
    /**
     * 设置 产品图片
     * @param $productPicFileId
     * @return OrderGoodsModel
     */
    public function setProductPicFileId($productPicFileId)
    {
        return $this->setValue('productPicFileId', $productPicFileId);
    }
    
    /**
     * 获取 产品价格
     * @return mixed
     */
    public function getProductPrice()
    {
        return $this->getValue('productPrice');
    }
    
    /**
     * 设置 产品价格
     * @param $productPrice
     * @return OrderGoodsModel
     */
    public function setProductPrice($productPrice)
    {
        return $this->setValue('productPrice', $productPrice);
    }
    
    /**
     * 获取 产品原价
     * @return mixed
     */
    public function getProductOriginalPrice()
    {
        return $this->getValue('productOriginalPrice');
    }
    
    /**
     * 设置 产品原价
     * @param $productOriginalPrice
     * @return OrderGoodsModel
     */
    public function setProductOriginalPrice($productOriginalPrice)
    {
        return $this->setValue('productOriginalPrice', $productOriginalPrice);
    }
    
    /**
     * 获取 产品重量（单位 k）
     * @return int
     */
    public function getProductWeight(): ?int
    {
        return $this->getValue('productWeight');
    }
    
    /**
     * 设置 产品重量（单位 k）
     * @param int $productWeight
     * @return OrderGoodsModel
     */
    public function setProductWeight(?int $productWeight)
    {
        return $this->setValue('productWeight', $productWeight);
    }
    
    /**
     * 获取 订单总数量
     * @return int
     */
    public function getCount(): ?int
    {
        return $this->getValue('count');
    }
    
    /**
     * 设置 订单总数量
     * @param int $count
     * @return OrderGoodsModel
     */
    public function setCount(?int $count)
    {
        return $this->setValue('count', $count);
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
     * @return OrderGoodsModel
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
     * @return OrderGoodsModel
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
     * @return OrderGoodsModel
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
     * @return OrderGoodsModel
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
     * @return OrderGoodsModel
     */
    public function setUpdatedTime($updatedTime)
    {
        return $this->setValue('updatedTime', $updatedTime);
    }
}