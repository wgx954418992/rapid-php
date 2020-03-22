<?php
namespace application\model;

use rapidPHP\library\AB;

/**
 * 收藏表
 */
class AppCollectionModel extends AB
{
    /**
     * 数据库表结构
     * @var array
     */
    public static $table = [
        'name' => 'app_collection',
        'comment' => '收藏表',
        'column' => [
            'collectionId' => ['type' => 'bigint', 'length' => 0, 'comment' => '收藏Id'],
            'bindId' => ['type' => 'bigint', 'length' => 0, 'comment' => '绑定的商品或者店铺Id'],
            'userId' => ['type' => 'bigint', 'length' => 0, 'comment' => '用户Id'],
            'datetime' => ['type' => 'datetime', 'length' => 0, 'comment' => '收藏时间'],
            'type' => ['type' => 'int', 'length' => 0, 'comment' => '收藏类型（1商品，2店铺）'],
            'isDelete' => ['type' => 'int', 'length' => 0, 'comment' => '是否删除'],
            'createdUserId' => ['type' => 'bigint', 'length' => 0, 'comment' => '创建人Id'],
            'createdTime' => ['type' => 'datetime', 'length' => 0, 'comment' => '创建时间'],
            'updatedUserId' => ['type' => 'bigint', 'length' => 0, 'comment' => '修改人Id'],
            'updatedTime' => ['type' => 'datetime', 'length' => 0, 'comment' => '修改时间'],
        ]
    ];

    /**
     * AppCollectionModel constructor.
     * @param array|null $data
     */
    public function __construct(array $data = null)
    {
        parent::__construct($data);
    }
    
    /**
     * 获取 收藏Id
     * @return mixed
     */
    public function getCollectionId()
    {
        return $this->getValue('collectionId');
    }
    
    /**
     * 设置 收藏Id
     * @param $collectionId
     * @return AppCollectionModel
     */
    public function setCollectionId($collectionId)
    {
        return $this->setValue('collectionId', $collectionId);
    }
    
    /**
     * 获取 绑定的商品或者店铺Id
     * @return mixed
     */
    public function getBindId()
    {
        return $this->getValue('bindId');
    }
    
    /**
     * 设置 绑定的商品或者店铺Id
     * @param $bindId
     * @return AppCollectionModel
     */
    public function setBindId($bindId)
    {
        return $this->setValue('bindId', $bindId);
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
     * @return AppCollectionModel
     */
    public function setUserId($userId)
    {
        return $this->setValue('userId', $userId);
    }
    
    /**
     * 获取 收藏时间
     * @return mixed
     */
    public function getDatetime()
    {
        return $this->getValue('datetime');
    }
    
    /**
     * 设置 收藏时间
     * @param $datetime
     * @return AppCollectionModel
     */
    public function setDatetime($datetime)
    {
        return $this->setValue('datetime', $datetime);
    }
    
    /**
     * 获取 收藏类型（1商品，2店铺）
     * @return int
     */
    public function getType(): ?int
    {
        return $this->getValue('type');
    }
    
    /**
     * 设置 收藏类型（1商品，2店铺）
     * @param int $type
     * @return AppCollectionModel
     */
    public function setType(?int $type)
    {
        return $this->setValue('type', $type);
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
     * @return AppCollectionModel
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
     * @return AppCollectionModel
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
     * @return AppCollectionModel
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
     * @return AppCollectionModel
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
     * @return AppCollectionModel
     */
    public function setUpdatedTime($updatedTime)
    {
        return $this->setValue('updatedTime', $updatedTime);
    }
}