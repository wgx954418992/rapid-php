<?php
namespace application\model;

use rapidPHP\library\AB;

/**
 * 认证表
 */
class AppAuthModel extends AB
{
    /**
     * 数据库表结构
     * @var array
     */
    public static $table = [
        'name' => 'app_auth',
        'comment' => '认证表',
        'column' => [
            'authId' => ['type' => 'bigint', 'length' => 0, 'comment' => '认证Id'],
            'name' => ['type' => 'varchar', 'length' => 10, 'comment' => '真实姓名'],
            'idNo' => ['type' => 'varchar', 'length' => 18, 'comment' => '身份证号'],
            'idPicJustFileId' => ['type' => 'bigint', 'length' => 0, 'comment' => '身份证人像面文件Id'],
            'idPicBackFileId' => ['type' => 'bigint', 'length' => 0, 'comment' => '身份证人国徽面文件Id'],
            'status' => ['type' => 'int', 'length' => 0, 'comment' => '审核状态 1 审核中 2审核通过 3 审核不通过'],
            'isDelete' => ['type' => 'int', 'length' => 0, 'comment' => '是否删除'],
            'createdUserId' => ['type' => 'bigint', 'length' => 0, 'comment' => '创建人Id'],
            'createdTime' => ['type' => 'datetime', 'length' => 0, 'comment' => '创建时间'],
            'updatedUserId' => ['type' => 'bigint', 'length' => 0, 'comment' => '修改人Id'],
            'updatedTime' => ['type' => 'datetime', 'length' => 0, 'comment' => '修改时间'],
        ]
    ];

    /**
     * AppAuthModel constructor.
     * @param array|null $data
     */
    public function __construct(array $data = null)
    {
        parent::__construct($data);
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
     * @return AppAuthModel
     */
    public function setAuthId($authId)
    {
        return $this->setValue('authId', $authId);
    }
    
    /**
     * 获取 真实姓名
     * @return mixed
     */
    public function getName()
    {
        return $this->getValue('name');
    }
    
    /**
     * 设置 真实姓名
     * @param $name
     * @return AppAuthModel
     */
    public function setName($name)
    {
        return $this->setValue('name', $name);
    }
    
    /**
     * 获取 身份证号
     * @return mixed
     */
    public function getIdNo()
    {
        return $this->getValue('idNo');
    }
    
    /**
     * 设置 身份证号
     * @param $idNo
     * @return AppAuthModel
     */
    public function setIdNo($idNo)
    {
        return $this->setValue('idNo', $idNo);
    }
    
    /**
     * 获取 身份证人像面文件Id
     * @return mixed
     */
    public function getIdPicJustFileId()
    {
        return $this->getValue('idPicJustFileId');
    }
    
    /**
     * 设置 身份证人像面文件Id
     * @param $idPicJustFileId
     * @return AppAuthModel
     */
    public function setIdPicJustFileId($idPicJustFileId)
    {
        return $this->setValue('idPicJustFileId', $idPicJustFileId);
    }
    
    /**
     * 获取 身份证人国徽面文件Id
     * @return mixed
     */
    public function getIdPicBackFileId()
    {
        return $this->getValue('idPicBackFileId');
    }
    
    /**
     * 设置 身份证人国徽面文件Id
     * @param $idPicBackFileId
     * @return AppAuthModel
     */
    public function setIdPicBackFileId($idPicBackFileId)
    {
        return $this->setValue('idPicBackFileId', $idPicBackFileId);
    }
    
    /**
     * 获取 审核状态 1 审核中 2审核通过 3 审核不通过
     * @return int
     */
    public function getStatus(): ?int
    {
        return $this->getValue('status');
    }
    
    /**
     * 设置 审核状态 1 审核中 2审核通过 3 审核不通过
     * @param int $status
     * @return AppAuthModel
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
     * @return AppAuthModel
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
     * @return AppAuthModel
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
     * @return AppAuthModel
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
     * @return AppAuthModel
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
     * @return AppAuthModel
     */
    public function setUpdatedTime($updatedTime)
    {
        return $this->setValue('updatedTime', $updatedTime);
    }
}