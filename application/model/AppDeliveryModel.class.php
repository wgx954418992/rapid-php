<?php
namespace application\model;

use rapidPHP\library\AB;

/**
 * 配送人员表
 */
class AppDeliveryModel extends AB
{
    /**
     * 数据库表结构
     * @var array
     */
    public static $table = [
        'name' => 'app_delivery',
        'comment' => '配送人员表',
        'column' => [
            'deliveryId' => ['type' => 'bigint', 'length' => 0, 'comment' => '配送id'],
            'userId' => ['type' => 'bigint', 'length' => 0, 'comment' => '用户Id'],
            'marketId' => ['type' => 'bigint', 'length' => 0, 'comment' => '市场id'],
            'authId' => ['type' => 'bigint', 'length' => 0, 'comment' => '认证Id'],
            'telephone' => ['type' => 'varchar', 'length' => 11, 'comment' => '电话'],
            'status' => ['type' => 'int', 'length' => 0, 'comment' => '状态 1 接单中 2 暂停接单'],
            'isDelete' => ['type' => 'int', 'length' => 0, 'comment' => '是否删除'],
            'createdUserId' => ['type' => 'bigint', 'length' => 0, 'comment' => '创建人Id'],
            'createdTime' => ['type' => 'datetime', 'length' => 0, 'comment' => '创建时间'],
            'updatedUserId' => ['type' => 'bigint', 'length' => 0, 'comment' => '修改人Id'],
            'updatedTime' => ['type' => 'datetime', 'length' => 0, 'comment' => '修改时间'],
        ]
    ];

    /**
     * AppDeliveryModel constructor.
     * @param array|null $data
     */
    public function __construct(array $data = null)
    {
        parent::__construct($data);
    }
    
    /**
     * 获取 配送id
     * @return mixed
     */
    public function getDeliveryId()
    {
        return $this->getValue('deliveryId');
    }
    
    /**
     * 设置 配送id
     * @param $deliveryId
     * @return AppDeliveryModel
     */
    public function setDeliveryId($deliveryId)
    {
        return $this->setValue('deliveryId', $deliveryId);
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
     * @return AppDeliveryModel
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
     * @return AppDeliveryModel
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
     * @return AppDeliveryModel
     */
    public function setAuthId($authId)
    {
        return $this->setValue('authId', $authId);
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
     * @return AppDeliveryModel
     */
    public function setTelephone($telephone)
    {
        return $this->setValue('telephone', $telephone);
    }
    
    /**
     * 获取 状态 1 接单中 2 暂停接单
     * @return int
     */
    public function getStatus(): ?int
    {
        return $this->getValue('status');
    }
    
    /**
     * 设置 状态 1 接单中 2 暂停接单
     * @param int $status
     * @return AppDeliveryModel
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
     * @return AppDeliveryModel
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
     * @return AppDeliveryModel
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
     * @return AppDeliveryModel
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
     * @return AppDeliveryModel
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
     * @return AppDeliveryModel
     */
    public function setUpdatedTime($updatedTime)
    {
        return $this->setValue('updatedTime', $updatedTime);
    }
}