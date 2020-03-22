<?php
namespace application\model;

use rapidPHP\library\AB;

/**
 * 购物车表
 */
class AppShoppingModel extends AB
{
    /**
     * 数据库表结构
     * @var array
     */
    public static $table = [
        'name' => 'app_shopping',
        'comment' => '购物车表',
        'column' => [
            'shoppingId' => ['type' => 'bigint', 'length' => 0, 'comment' => '购物车Id'],
            'userId' => ['type' => 'bigint', 'length' => 0, 'comment' => '用户Id'],
            'sellerId' => ['type' => 'bigint', 'length' => 0, 'comment' => '商户Id'],
            'sellerName' => ['type' => 'varchar', 'length' => 32, 'comment' => '商户名称'],
            'productName' => ['type' => 'varchar', 'length' => 100, 'comment' => '产品名称'],
            'productPicFileId' => ['type' => 'varchar', 'length' => 1024, 'comment' => '产品图片'],
            'productPrice' => ['type' => 'decimal', 'length' => 0, 'comment' => '产品价格'],
            'productOriginalPrice' => ['type' => 'decimal', 'length' => 0, 'comment' => '产品原价'],
            'productWeight' => ['type' => 'int', 'length' => 0, 'comment' => '产品重量'],
            'count' => ['type' => 'int', 'length' => 0, 'comment' => '订单总数量'],
            'isDelete' => ['type' => 'int', 'length' => 0, 'comment' => '是否删除'],
            'createdUserId' => ['type' => 'bigint', 'length' => 0, 'comment' => '创建人Id'],
            'createdTime' => ['type' => 'datetime', 'length' => 0, 'comment' => '创建时间'],
            'updatedUserId' => ['type' => 'bigint', 'length' => 0, 'comment' => '修改人Id'],
            'updatedTime' => ['type' => 'datetime', 'length' => 0, 'comment' => '修改时间'],
        ]
    ];

    /**
     * AppShoppingModel constructor.
     * @param array|null $data
     */
    public function __construct(array $data = null)
    {
        parent::__construct($data);
    }
    
    /**
     * 获取 购物车Id
     * @return mixed
     */
    public function getShoppingId()
    {
        return $this->getValue('shoppingId');
    }
    
    /**
     * 设置 购物车Id
     * @param $shoppingId
     * @return AppShoppingModel
     */
    public function setShoppingId($shoppingId)
    {
        return $this->setValue('shoppingId', $shoppingId);
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
     * @return AppShoppingModel
     */
    public function setUserId($userId)
    {
        return $this->setValue('userId', $userId);
    }
    
    /**
     * 获取 商户Id
     * @return mixed
     */
    public function getSellerId()
    {
        return $this->getValue('sellerId');
    }
    
    /**
     * 设置 商户Id
     * @param $sellerId
     * @return AppShoppingModel
     */
    public function setSellerId($sellerId)
    {
        return $this->setValue('sellerId', $sellerId);
    }
    
    /**
     * 获取 商户名称
     * @return mixed
     */
    public function getSellerName()
    {
        return $this->getValue('sellerName');
    }
    
    /**
     * 设置 商户名称
     * @param $sellerName
     * @return AppShoppingModel
     */
    public function setSellerName($sellerName)
    {
        return $this->setValue('sellerName', $sellerName);
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
     * @return AppShoppingModel
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
     * @return AppShoppingModel
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
     * @return AppShoppingModel
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
     * @return AppShoppingModel
     */
    public function setProductOriginalPrice($productOriginalPrice)
    {
        return $this->setValue('productOriginalPrice', $productOriginalPrice);
    }
    
    /**
     * 获取 产品重量
     * @return int
     */
    public function getProductWeight(): ?int
    {
        return $this->getValue('productWeight');
    }
    
    /**
     * 设置 产品重量
     * @param int $productWeight
     * @return AppShoppingModel
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
     * @return AppShoppingModel
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
     * @return AppShoppingModel
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
     * @return AppShoppingModel
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
     * @return AppShoppingModel
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
     * @return AppShoppingModel
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
     * @return AppShoppingModel
     */
    public function setUpdatedTime($updatedTime)
    {
        return $this->setValue('updatedTime', $updatedTime);
    }
}