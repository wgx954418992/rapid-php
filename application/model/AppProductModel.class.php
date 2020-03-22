<?php
namespace application\model;

use rapidPHP\library\AB;

/**
 * 产品表
 */
class AppProductModel extends AB
{
    /**
     * 数据库表结构
     * @var array
     */
    public static $table = [
        'name' => 'app_product',
        'comment' => '产品表',
        'column' => [
            'productId' => ['type' => 'bigint', 'length' => 0, 'comment' => '产品Id'],
            'sellerId' => ['type' => 'bigint', 'length' => 0, 'comment' => '商户Id'],
            'categoryId' => ['type' => 'bigint', 'length' => 0, 'comment' => '分类Id'],
            'name' => ['type' => 'varchar', 'length' => 100, 'comment' => '名称'],
            'weight' => ['type' => 'int', 'length' => 0, 'comment' => '重量（单位 k）'],
            'price' => ['type' => 'decimal', 'length' => 0, 'comment' => '价格'],
            'originalPrice' => ['type' => 'decimal', 'length' => 0, 'comment' => '原价'],
            'score' => ['type' => 'int', 'length' => 0, 'comment' => '评分（100分/5）来计算，分数按照评论打分来计算 5增加2分，4分增加1分 3分不做增改，2分减1分 1分减2分'],
            'collectionCount' => ['type' => 'int', 'length' => 0, 'comment' => '收藏总数'],
            'commentCount' => ['type' => 'int', 'length' => 0, 'comment' => '评论总数'],
            'totalSalesVolume' => ['type' => 'int', 'length' => 0, 'comment' => '总销售量'],
            'rank' => ['type' => 'int', 'length' => 0, 'comment' => '排序'],
            'isReturn' => ['type' => 'int', 'length' => 0, 'comment' => '能否退货'],
            'isDelete' => ['type' => 'int', 'length' => 0, 'comment' => '是否删除'],
            'createdUserId' => ['type' => 'bigint', 'length' => 0, 'comment' => '创建人Id'],
            'createdTime' => ['type' => 'datetime', 'length' => 0, 'comment' => '创建时间'],
            'updatedUserId' => ['type' => 'bigint', 'length' => 0, 'comment' => '修改人Id'],
            'updatedTime' => ['type' => 'datetime', 'length' => 0, 'comment' => '修改时间'],
        ]
    ];

    /**
     * AppProductModel constructor.
     * @param array|null $data
     */
    public function __construct(array $data = null)
    {
        parent::__construct($data);
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
     * @return AppProductModel
     */
    public function setProductId($productId)
    {
        return $this->setValue('productId', $productId);
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
     * @return AppProductModel
     */
    public function setSellerId($sellerId)
    {
        return $this->setValue('sellerId', $sellerId);
    }
    
    /**
     * 获取 分类Id
     * @return mixed
     */
    public function getCategoryId()
    {
        return $this->getValue('categoryId');
    }
    
    /**
     * 设置 分类Id
     * @param $categoryId
     * @return AppProductModel
     */
    public function setCategoryId($categoryId)
    {
        return $this->setValue('categoryId', $categoryId);
    }
    
    /**
     * 获取 名称
     * @return mixed
     */
    public function getName()
    {
        return $this->getValue('name');
    }
    
    /**
     * 设置 名称
     * @param $name
     * @return AppProductModel
     */
    public function setName($name)
    {
        return $this->setValue('name', $name);
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
     * @return AppProductModel
     */
    public function setWeight(?int $weight)
    {
        return $this->setValue('weight', $weight);
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
     * @return AppProductModel
     */
    public function setPrice($price)
    {
        return $this->setValue('price', $price);
    }
    
    /**
     * 获取 原价
     * @return mixed
     */
    public function getOriginalPrice()
    {
        return $this->getValue('originalPrice');
    }
    
    /**
     * 设置 原价
     * @param $originalPrice
     * @return AppProductModel
     */
    public function setOriginalPrice($originalPrice)
    {
        return $this->setValue('originalPrice', $originalPrice);
    }
    
    /**
     * 获取 评分（100分/5）来计算，分数按照评论打分来计算 5增加2分，4分增加1分 3分不做增改，2分减1分 1分减2分
     * @return int
     */
    public function getScore(): ?int
    {
        return $this->getValue('score');
    }
    
    /**
     * 设置 评分（100分/5）来计算，分数按照评论打分来计算 5增加2分，4分增加1分 3分不做增改，2分减1分 1分减2分
     * @param int $score
     * @return AppProductModel
     */
    public function setScore(?int $score)
    {
        return $this->setValue('score', $score);
    }
    
    /**
     * 获取 收藏总数
     * @return int
     */
    public function getCollectionCount(): ?int
    {
        return $this->getValue('collectionCount');
    }
    
    /**
     * 设置 收藏总数
     * @param int $collectionCount
     * @return AppProductModel
     */
    public function setCollectionCount(?int $collectionCount)
    {
        return $this->setValue('collectionCount', $collectionCount);
    }
    
    /**
     * 获取 评论总数
     * @return int
     */
    public function getCommentCount(): ?int
    {
        return $this->getValue('commentCount');
    }
    
    /**
     * 设置 评论总数
     * @param int $commentCount
     * @return AppProductModel
     */
    public function setCommentCount(?int $commentCount)
    {
        return $this->setValue('commentCount', $commentCount);
    }
    
    /**
     * 获取 总销售量
     * @return int
     */
    public function getTotalSalesVolume(): ?int
    {
        return $this->getValue('totalSalesVolume');
    }
    
    /**
     * 设置 总销售量
     * @param int $totalSalesVolume
     * @return AppProductModel
     */
    public function setTotalSalesVolume(?int $totalSalesVolume)
    {
        return $this->setValue('totalSalesVolume', $totalSalesVolume);
    }
    
    /**
     * 获取 排序
     * @return int
     */
    public function getRank(): ?int
    {
        return $this->getValue('rank');
    }
    
    /**
     * 设置 排序
     * @param int $rank
     * @return AppProductModel
     */
    public function setRank(?int $rank)
    {
        return $this->setValue('rank', $rank);
    }
    
    /**
     * 获取 能否退货
     * @return int
     */
    public function getIsReturn(): ?int
    {
        return $this->getValue('isReturn');
    }
    
    /**
     * 设置 能否退货
     * @param int $isReturn
     * @return AppProductModel
     */
    public function setIsReturn(?int $isReturn)
    {
        return $this->setValue('isReturn', $isReturn);
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
     * @return AppProductModel
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
     * @return AppProductModel
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
     * @return AppProductModel
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
     * @return AppProductModel
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
     * @return AppProductModel
     */
    public function setUpdatedTime($updatedTime)
    {
        return $this->setValue('updatedTime', $updatedTime);
    }
}