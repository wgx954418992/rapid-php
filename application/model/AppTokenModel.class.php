<?php
namespace application\model;

use rapidPHP\library\AB;

/**
 * Token存储表
 */
class AppTokenModel extends AB
{
    /**
     * 数据库表结构
     * @var array
     */
    public static $table = [
        'name' => 'app_token',
        'comment' => 'Token存储表',
        'column' => [
            'tokenId' => ['type' => 'varchar', 'length' => 32, 'comment' => 'tokenId'],
            'bindId' => ['type' => 'bigint', 'length' => 0, 'comment' => '绑定的Id可以是用户Id，或其他'],
            'type' => ['type' => 'varchar', 'length' => 10, 'comment' => 'token类型WXAPP|ADMIN'],
            'isDelete' => ['type' => 'int', 'length' => 0, 'comment' => '是否删除'],
            'createdUserId' => ['type' => 'bigint', 'length' => 0, 'comment' => '创建人Id'],
            'createdTime' => ['type' => 'datetime', 'length' => 0, 'comment' => '创建时间'],
            'updatedUserId' => ['type' => 'bigint', 'length' => 0, 'comment' => '修改人Id'],
            'updatedTime' => ['type' => 'datetime', 'length' => 0, 'comment' => '修改时间'],
        ]
    ];

    /**
     * AppTokenModel constructor.
     * @param array|null $data
     */
    public function __construct(array $data = null)
    {
        parent::__construct($data);
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
     * @return AppTokenModel
     */
    public function setTokenId($tokenId)
    {
        return $this->setValue('tokenId', $tokenId);
    }
    
    /**
     * 获取 绑定的Id可以是用户Id，或其他
     * @return mixed
     */
    public function getBindId()
    {
        return $this->getValue('bindId');
    }
    
    /**
     * 设置 绑定的Id可以是用户Id，或其他
     * @param $bindId
     * @return AppTokenModel
     */
    public function setBindId($bindId)
    {
        return $this->setValue('bindId', $bindId);
    }
    
    /**
     * 获取 token类型WXAPP|ADMIN
     * @return mixed
     */
    public function getType()
    {
        return $this->getValue('type');
    }
    
    /**
     * 设置 token类型WXAPP|ADMIN
     * @param $type
     * @return AppTokenModel
     */
    public function setType($type)
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
     * @return AppTokenModel
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
     * @return AppTokenModel
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
     * @return AppTokenModel
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
     * @return AppTokenModel
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
     * @return AppTokenModel
     */
    public function setUpdatedTime($updatedTime)
    {
        return $this->setValue('updatedTime', $updatedTime);
    }
}