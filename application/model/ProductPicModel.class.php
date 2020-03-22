<?php
namespace application\model;

use rapidPHP\library\AB;

/**
 * 产品图片表
 */
class ProductPicModel extends AB
{
    /**
     * 数据库表结构
     * @var array
     */
    public static $table = [
        'name' => 'product_pic',
        'comment' => '产品图片表',
        'column' => [
            'picId' => ['type' => 'bigint', 'length' => 0, 'comment' => '图片Id'],
            'productId' => ['type' => 'bigint', 'length' => 0, 'comment' => '产品Id'],
            'fileId' => ['type' => 'bigint', 'length' => 0, 'comment' => '图片文件Id'],
            'rank' => ['type' => 'int', 'length' => 0, 'comment' => '图片顺序'],
            'isDelete' => ['type' => 'int', 'length' => 0, 'comment' => '是否删除'],
            'createdUserId' => ['type' => 'bigint', 'length' => 0, 'comment' => '创建人Id'],
            'createdTime' => ['type' => 'datetime', 'length' => 0, 'comment' => '创建时间'],
            'updatedUserId' => ['type' => 'bigint', 'length' => 0, 'comment' => '修改人Id'],
            'updatedTime' => ['type' => 'datetime', 'length' => 0, 'comment' => '修改时间'],
        ]
    ];

    /**
     * ProductPicModel constructor.
     * @param array|null $data
     */
    public function __construct(array $data = null)
    {
        parent::__construct($data);
    }
    
    /**
     * 获取 图片Id
     * @return mixed
     */
    public function getPicId()
    {
        return $this->getValue('picId');
    }
    
    /**
     * 设置 图片Id
     * @param $picId
     * @return ProductPicModel
     */
    public function setPicId($picId)
    {
        return $this->setValue('picId', $picId);
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
     * @return ProductPicModel
     */
    public function setProductId($productId)
    {
        return $this->setValue('productId', $productId);
    }
    
    /**
     * 获取 图片文件Id
     * @return mixed
     */
    public function getFileId()
    {
        return $this->getValue('fileId');
    }
    
    /**
     * 设置 图片文件Id
     * @param $fileId
     * @return ProductPicModel
     */
    public function setFileId($fileId)
    {
        return $this->setValue('fileId', $fileId);
    }
    
    /**
     * 获取 图片顺序
     * @return int
     */
    public function getRank(): ?int
    {
        return $this->getValue('rank');
    }
    
    /**
     * 设置 图片顺序
     * @param int $rank
     * @return ProductPicModel
     */
    public function setRank(?int $rank)
    {
        return $this->setValue('rank', $rank);
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
     * @return ProductPicModel
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
     * @return ProductPicModel
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
     * @return ProductPicModel
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
     * @return ProductPicModel
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
     * @return ProductPicModel
     */
    public function setUpdatedTime($updatedTime)
    {
        return $this->setValue('updatedTime', $updatedTime);
    }
}