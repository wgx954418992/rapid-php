<?php
namespace application\model;

use rapidPHP\library\AB;

/**
 * 收货地址表
 */
class AppReceiptModel extends AB
{
    /**
     * 数据库表结构
     * @var array
     */
    public static $table = [
        'name' => 'app_receipt',
        'comment' => '收货地址表',
        'column' => [
            'receiptId' => ['type' => 'bigint', 'length' => 0, 'comment' => '收货地址Id'],
            'userId' => ['type' => 'bigint', 'length' => 0, 'comment' => '用户Id'],
            'areaId' => ['type' => 'bigint', 'length' => 0, 'comment' => '地区Id'],
            'address' => ['type' => 'varchar', 'length' => 100, 'comment' => '地址'],
            'postcode' => ['type' => 'int', 'length' => 0, 'comment' => '邮政编码'],
            'name' => ['type' => 'varchar', 'length' => 32, 'comment' => '收货人姓名'],
            'tel' => ['type' => 'varchar', 'length' => 11, 'comment' => '电话'],
            'isDefault' => ['type' => 'int', 'length' => 0, 'comment' => '是否默认'],
            'isDelete' => ['type' => 'int', 'length' => 0, 'comment' => '是否删除'],
            'createdUserId' => ['type' => 'bigint', 'length' => 0, 'comment' => '创建人Id'],
            'createdTime' => ['type' => 'datetime', 'length' => 0, 'comment' => '创建时间'],
            'updatedUserId' => ['type' => 'bigint', 'length' => 0, 'comment' => '修改人Id'],
            'updatedTime' => ['type' => 'datetime', 'length' => 0, 'comment' => '修改时间'],
        ]
    ];

    /**
     * AppReceiptModel constructor.
     * @param array|null $data
     */
    public function __construct(array $data = null)
    {
        parent::__construct($data);
    }
    
    /**
     * 获取 收货地址Id
     * @return mixed
     */
    public function getReceiptId()
    {
        return $this->getValue('receiptId');
    }
    
    /**
     * 设置 收货地址Id
     * @param $receiptId
     * @return AppReceiptModel
     */
    public function setReceiptId($receiptId)
    {
        return $this->setValue('receiptId', $receiptId);
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
     * @return AppReceiptModel
     */
    public function setUserId($userId)
    {
        return $this->setValue('userId', $userId);
    }
    
    /**
     * 获取 地区Id
     * @return mixed
     */
    public function getAreaId()
    {
        return $this->getValue('areaId');
    }
    
    /**
     * 设置 地区Id
     * @param $areaId
     * @return AppReceiptModel
     */
    public function setAreaId($areaId)
    {
        return $this->setValue('areaId', $areaId);
    }
    
    /**
     * 获取 地址
     * @return mixed
     */
    public function getAddress()
    {
        return $this->getValue('address');
    }
    
    /**
     * 设置 地址
     * @param $address
     * @return AppReceiptModel
     */
    public function setAddress($address)
    {
        return $this->setValue('address', $address);
    }
    
    /**
     * 获取 邮政编码
     * @return int
     */
    public function getPostcode(): ?int
    {
        return $this->getValue('postcode');
    }
    
    /**
     * 设置 邮政编码
     * @param int $postcode
     * @return AppReceiptModel
     */
    public function setPostcode(?int $postcode)
    {
        return $this->setValue('postcode', $postcode);
    }
    
    /**
     * 获取 收货人姓名
     * @return mixed
     */
    public function getName()
    {
        return $this->getValue('name');
    }
    
    /**
     * 设置 收货人姓名
     * @param $name
     * @return AppReceiptModel
     */
    public function setName($name)
    {
        return $this->setValue('name', $name);
    }
    
    /**
     * 获取 电话
     * @return mixed
     */
    public function getTel()
    {
        return $this->getValue('tel');
    }
    
    /**
     * 设置 电话
     * @param $tel
     * @return AppReceiptModel
     */
    public function setTel($tel)
    {
        return $this->setValue('tel', $tel);
    }
    
    /**
     * 获取 是否默认
     * @return int
     */
    public function getIsDefault(): ?int
    {
        return $this->getValue('isDefault');
    }
    
    /**
     * 设置 是否默认
     * @param int $isDefault
     * @return AppReceiptModel
     */
    public function setIsDefault(?int $isDefault)
    {
        return $this->setValue('isDefault', $isDefault);
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
     * @return AppReceiptModel
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
     * @return AppReceiptModel
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
     * @return AppReceiptModel
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
     * @return AppReceiptModel
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
     * @return AppReceiptModel
     */
    public function setUpdatedTime($updatedTime)
    {
        return $this->setValue('updatedTime', $updatedTime);
    }
}