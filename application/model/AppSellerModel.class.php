<?php
namespace application\model;

use rapidPHP\library\AB;

/**
 * 商户表
 */
class AppSellerModel extends AB
{
    /**
     * 数据库表结构
     * @var array
     */
    public static $table = [
        'name' => 'app_seller',
        'comment' => '商户表',
        'column' => [
            'sellerId' => ['type' => 'bigint', 'length' => 0, 'comment' => '商户id'],
            'userId' => ['type' => 'bigint', 'length' => 0, 'comment' => '用户Id'],
            'marketId' => ['type' => 'bigint', 'length' => 0, 'comment' => '市场id'],
            'authId' => ['type' => 'bigint', 'length' => 0, 'comment' => '认证Id'],
            'desc' => ['type' => 'varchar', 'length' => 256, 'comment' => '商户介绍'],
            'areaId' => ['type' => 'int', 'length' => 0, 'comment' => '地区Id'],
            'address' => ['type' => 'varchar', 'length' => 50, 'comment' => '详细地址'],
            'location' => ['type' => 'varchar', 'length' => 50, 'comment' => '定位信息'],
            'telephone' => ['type' => 'varchar', 'length' => 11, 'comment' => '电话'],
            'collectionCount' => ['type' => 'int', 'length' => 0, 'comment' => '被收藏数量'],
            'status' => ['type' => 'int', 'length' => 0, 'comment' => '状态 1 营业中 2 休息中'],
            'isDelete' => ['type' => 'int', 'length' => 0, 'comment' => '是否删除'],
            'createdUserId' => ['type' => 'bigint', 'length' => 0, 'comment' => '创建人Id'],
            'createdTime' => ['type' => 'datetime', 'length' => 0, 'comment' => '创建时间'],
            'updatedUserId' => ['type' => 'bigint', 'length' => 0, 'comment' => '修改人Id'],
            'updatedTime' => ['type' => 'datetime', 'length' => 0, 'comment' => '修改时间'],
        ]
    ];

    /**
     * AppSellerModel constructor.
     * @param array|null $data
     */
    public function __construct(array $data = null)
    {
        parent::__construct($data);
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
     * @return AppSellerModel
     */
    public function setSellerId($sellerId)
    {
        return $this->setValue('sellerId', $sellerId);
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
     * @return AppSellerModel
     */
    public function setUserId($userId)
    {
        return $this->setValue('userId', $userId);
    }
    
    /**
     * 获取 市场id
     * @return mixed
     */
    public function getMarketId()
    {
        return $this->getValue('marketId');
    }
    
    /**
     * 设置 市场id
     * @param $marketId
     * @return AppSellerModel
     */
    public function setMarketId($marketId)
    {
        return $this->setValue('marketId', $marketId);
    }
    
    /**
     * 获取 认证Id
     * @return mixed
     */
    public function getAuthId()
    {
        return $this->getValue('authId');
    }
    
    /**
     * 设置 认证Id
     * @param $authId
     * @return AppSellerModel
     */
    public function setAuthId($authId)
    {
        return $this->setValue('authId', $authId);
    }
    
    /**
     * 获取 商户介绍
     * @return mixed
     */
    public function getDesc()
    {
        return $this->getValue('desc');
    }
    
    /**
     * 设置 商户介绍
     * @param $desc
     * @return AppSellerModel
     */
    public function setDesc($desc)
    {
        return $this->setValue('desc', $desc);
    }
    
    /**
     * 获取 地区Id
     * @return int
     */
    public function getAreaId(): ?int
    {
        return $this->getValue('areaId');
    }
    
    /**
     * 设置 地区Id
     * @param int $areaId
     * @return AppSellerModel
     */
    public function setAreaId(?int $areaId)
    {
        return $this->setValue('areaId', $areaId);
    }
    
    /**
     * 获取 详细地址
     * @return mixed
     */
    public function getAddress()
    {
        return $this->getValue('address');
    }
    
    /**
     * 设置 详细地址
     * @param $address
     * @return AppSellerModel
     */
    public function setAddress($address)
    {
        return $this->setValue('address', $address);
    }
    
    /**
     * 获取 定位信息
     * @return mixed
     */
    public function getLocation()
    {
        return $this->getValue('location');
    }
    
    /**
     * 设置 定位信息
     * @param $location
     * @return AppSellerModel
     */
    public function setLocation($location)
    {
        return $this->setValue('location', $location);
    }
    
    /**
     * 获取 电话
     * @return mixed
     */
    public function getTelephone()
    {
        return $this->getValue('telephone');
    }
    
    /**
     * 设置 电话
     * @param $telephone
     * @return AppSellerModel
     */
    public function setTelephone($telephone)
    {
        return $this->setValue('telephone', $telephone);
    }
    
    /**
     * 获取 被收藏数量
     * @return int
     */
    public function getCollectionCount(): ?int
    {
        return $this->getValue('collectionCount');
    }
    
    /**
     * 设置 被收藏数量
     * @param int $collectionCount
     * @return AppSellerModel
     */
    public function setCollectionCount(?int $collectionCount)
    {
        return $this->setValue('collectionCount', $collectionCount);
    }
    
    /**
     * 获取 状态 1 营业中 2 休息中
     * @return int
     */
    public function getStatus(): ?int
    {
        return $this->getValue('status');
    }
    
    /**
     * 设置 状态 1 营业中 2 休息中
     * @param int $status
     * @return AppSellerModel
     */
    public function setStatus(?int $status)
    {
        return $this->setValue('status', $status);
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
     * @return AppSellerModel
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
     * @return AppSellerModel
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
     * @return AppSellerModel
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
     * @return AppSellerModel
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
     * @return AppSellerModel
     */
    public function setUpdatedTime($updatedTime)
    {
        return $this->setValue('updatedTime', $updatedTime);
    }
}