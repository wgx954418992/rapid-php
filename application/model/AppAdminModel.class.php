<?php
namespace application\model;

use rapidPHP\library\AB;

/**
 * 后台管理员
 */
class AppAdminModel extends AB
{
    /**
     * 数据库表结构
     * @var array
     */
    public static $table = [
        'name' => 'app_admin',
        'comment' => '后台管理员',
        'column' => [
            'adminId' => ['type' => 'bigint', 'length' => 0, 'comment' => '管理员Id'],
            'username' => ['type' => 'varchar', 'length' => 15, 'comment' => '登录账号'],
            'password' => ['type' => 'varchar', 'length' => 32, 'comment' => '登录密码'],
            'isDelete' => ['type' => 'int', 'length' => 0, 'comment' => '是否删除'],
            'createdUserId' => ['type' => 'bigint', 'length' => 0, 'comment' => '创建人Id'],
            'createdTime' => ['type' => 'datetime', 'length' => 0, 'comment' => '创建时间'],
            'updatedUserId' => ['type' => 'bigint', 'length' => 0, 'comment' => '修改人Id'],
            'updatedTime' => ['type' => 'datetime', 'length' => 0, 'comment' => '修改时间'],
        ]
    ];

    /**
     * AppAdminModel constructor.
     * @param array|null $data
     */
    public function __construct(array $data = null)
    {
        parent::__construct($data);
    }
    
    /**
     * 获取 管理员Id
     * @return mixed
     */
    public function getAdminId()
    {
        return $this->getValue('adminId');
    }
    
    /**
     * 设置 管理员Id
     * @param $adminId
     * @return AppAdminModel
     */
    public function setAdminId($adminId)
    {
        return $this->setValue('adminId', $adminId);
    }
    
    /**
     * 获取 登录账号
     * @return mixed
     */
    public function getUsername()
    {
        return $this->getValue('username');
    }
    
    /**
     * 设置 登录账号
     * @param $username
     * @return AppAdminModel
     */
    public function setUsername($username)
    {
        return $this->setValue('username', $username);
    }
    
    /**
     * 获取 登录密码
     * @return mixed
     */
    public function getPassword()
    {
        return $this->getValue('password');
    }
    
    /**
     * 设置 登录密码
     * @param $password
     * @return AppAdminModel
     */
    public function setPassword($password)
    {
        return $this->setValue('password', $password);
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
     * @return AppAdminModel
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
     * @return AppAdminModel
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
     * @return AppAdminModel
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
     * @return AppAdminModel
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
     * @return AppAdminModel
     */
    public function setUpdatedTime($updatedTime)
    {
        return $this->setValue('updatedTime', $updatedTime);
    }
}