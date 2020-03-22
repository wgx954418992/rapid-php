<?php
namespace application\model;

use rapidPHP\library\AB;

/**
 * 用户登录日志表

 */
class UserLogModel extends AB
{
    /**
     * 数据库表结构
     * @var array
     */
    public static $table = [
        'name' => 'user_log',
        'comment' => '用户登录日志表
',
        'column' => [
            'logId' => ['type' => 'bigint', 'length' => 0, 'comment' => '日志Id'],
            'bindId' => ['type' => 'bigint', 'length' => 0, 'comment' => '用户Id'],
            'tokenId' => ['type' => 'varchar', 'length' => 32, 'comment' => 'tokenId'],
            'mode' => ['type' => 'int', 'length' => 0, 'comment' => '登录方式'],
            'date' => ['type' => 'datetime', 'length' => 0, 'comment' => '日期'],
            'ip' => ['type' => 'varchar', 'length' => 18, 'comment' => '登录ip'],
            'device' => ['type' => 'varchar', 'length' => 1024, 'comment' => '登录设备'],
            'isDelete' => ['type' => 'int', 'length' => 0, 'comment' => '是否删除'],
            'createdUserId' => ['type' => 'bigint', 'length' => 0, 'comment' => '创建人Id'],
            'createdTime' => ['type' => 'datetime', 'length' => 0, 'comment' => '创建时间'],
            'updatedUserId' => ['type' => 'bigint', 'length' => 0, 'comment' => '修改人Id'],
            'updatedTime' => ['type' => 'datetime', 'length' => 0, 'comment' => '修改时间'],
        ]
    ];

    /**
     * UserLogModel constructor.
     * @param array|null $data
     */
    public function __construct(array $data = null)
    {
        parent::__construct($data);
    }
    
    /**
     * 获取 日志Id
     * @return mixed
     */
    public function getLogId()
    {
        return $this->getValue('logId');
    }
    
    /**
     * 设置 日志Id
     * @param $logId
     * @return UserLogModel
     */
    public function setLogId($logId)
    {
        return $this->setValue('logId', $logId);
    }
    
    /**
     * 获取 用户Id
     * @return mixed
     */
    public function getBindId()
    {
        return $this->getValue('bindId');
    }
    
    /**
     * 设置 用户Id
     * @param $bindId
     * @return UserLogModel
     */
    public function setBindId($bindId)
    {
        return $this->setValue('bindId', $bindId);
    }
    
    /**
     * 获取 tokenId
     * @return mixed
     */
    public function getTokenId()
    {
        return $this->getValue('tokenId');
    }
    
    /**
     * 设置 tokenId
     * @param $tokenId
     * @return UserLogModel
     */
    public function setTokenId($tokenId)
    {
        return $this->setValue('tokenId', $tokenId);
    }
    
    /**
     * 获取 登录方式
     * @return int
     */
    public function getMode(): ?int
    {
        return $this->getValue('mode');
    }
    
    /**
     * 设置 登录方式
     * @param int $mode
     * @return UserLogModel
     */
    public function setMode(?int $mode)
    {
        return $this->setValue('mode', $mode);
    }
    
    /**
     * 获取 日期
     * @return mixed
     */
    public function getDate()
    {
        return $this->getValue('date');
    }
    
    /**
     * 设置 日期
     * @param $date
     * @return UserLogModel
     */
    public function setDate($date)
    {
        return $this->setValue('date', $date);
    }
    
    /**
     * 获取 登录ip
     * @return mixed
     */
    public function getIp()
    {
        return $this->getValue('ip');
    }
    
    /**
     * 设置 登录ip
     * @param $ip
     * @return UserLogModel
     */
    public function setIp($ip)
    {
        return $this->setValue('ip', $ip);
    }
    
    /**
     * 获取 登录设备
     * @return mixed
     */
    public function getDevice()
    {
        return $this->getValue('device');
    }
    
    /**
     * 设置 登录设备
     * @param $device
     * @return UserLogModel
     */
    public function setDevice($device)
    {
        return $this->setValue('device', $device);
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
     * @return UserLogModel
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
     * @return UserLogModel
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
     * @return UserLogModel
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
     * @return UserLogModel
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
     * @return UserLogModel
     */
    public function setUpdatedTime($updatedTime)
    {
        return $this->setValue('updatedTime', $updatedTime);
    }
}