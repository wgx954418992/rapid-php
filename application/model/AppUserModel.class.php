<?php
namespace application\model;

use rapidPHP\library\AB;

/**
 * 用户跟微信绑定表
 */
class AppUserModel extends AB
{
    /**
     * 数据库表结构
     * @var array
     */
    public static $table = [
        'name' => 'app_user',
        'comment' => '用户跟微信绑定表',
        'column' => [
            'userId' => ['type' => 'bigint', 'length' => 0, 'comment' => '主键'],
            'telephone' => ['type' => 'varchar', 'length' => 11, 'comment' => '手机号'],
            'password' => ['type' => 'varchar', 'length' => 32, 'comment' => '密码'],
            'nickname' => ['type' => 'varchar', 'length' => 100, 'comment' => '名称'],
            'explain' => ['type' => 'varchar', 'length' => 50, 'comment' => '签名'],
            'headerFileId' => ['type' => 'bigint', 'length' => 0, 'comment' => '头像文件Id'],
            'RIp' => ['type' => 'varchar', 'length' => 18, 'comment' => '注册Ip'],
            'source' => ['type' => 'int', 'length' => 0, 'comment' => '1注册 2后台添加'],
            'type' => ['type' => 'int', 'length' => 0, 'comment' => '1注册为普通用户 2 注册为商户 3 注册为配送人员'],
            'isDelete' => ['type' => 'int', 'length' => 0, 'comment' => '是否删除'],
            'createdUserId' => ['type' => 'bigint', 'length' => 0, 'comment' => '创建人Id'],
            'createdTime' => ['type' => 'datetime', 'length' => 0, 'comment' => '创建时间'],
            'updatedUserId' => ['type' => 'bigint', 'length' => 0, 'comment' => '修改人Id'],
            'updatedTime' => ['type' => 'datetime', 'length' => 0, 'comment' => '修改时间'],
        ]
    ];

    /**
     * AppUserModel constructor.
     * @param array|null $data
     */
    public function __construct(array $data = null)
    {
        parent::__construct($data);
    }
    
    /**
     * 获取 主键
     * @return mixed
     */
    public function getUserId()
    {
        return $this->getValue('userId');
    }
    
    /**
     * 设置 主键
     * @param $userId
     * @return AppUserModel
     */
    public function setUserId($userId)
    {
        return $this->setValue('userId', $userId);
    }
    
    /**
     * 获取 手机号
     * @return mixed
     */
    public function getTelephone()
    {
        return $this->getValue('telephone');
    }
    
    /**
     * 设置 手机号
     * @param $telephone
     * @return AppUserModel
     */
    public function setTelephone($telephone)
    {
        return $this->setValue('telephone', $telephone);
    }
    
    /**
     * 获取 密码
     * @return mixed
     */
    public function getPassword()
    {
        return $this->getValue('password');
    }
    
    /**
     * 设置 密码
     * @param $password
     * @return AppUserModel
     */
    public function setPassword($password)
    {
        return $this->setValue('password', $password);
    }
    
    /**
     * 获取 名称
     * @return mixed
     */
    public function getNickname()
    {
        return $this->getValue('nickname');
    }
    
    /**
     * 设置 名称
     * @param $nickname
     * @return AppUserModel
     */
    public function setNickname($nickname)
    {
        return $this->setValue('nickname', $nickname);
    }
    
    /**
     * 获取 签名
     * @return mixed
     */
    public function getExplain()
    {
        return $this->getValue('explain');
    }
    
    /**
     * 设置 签名
     * @param $explain
     * @return AppUserModel
     */
    public function setExplain($explain)
    {
        return $this->setValue('explain', $explain);
    }
    
    /**
     * 获取 头像文件Id
     * @return mixed
     */
    public function getHeaderFileId()
    {
        return $this->getValue('headerFileId');
    }
    
    /**
     * 设置 头像文件Id
     * @param $headerFileId
     * @return AppUserModel
     */
    public function setHeaderFileId($headerFileId)
    {
        return $this->setValue('headerFileId', $headerFileId);
    }
    
    /**
     * 获取 注册Ip
     * @return mixed
     */
    public function getRIp()
    {
        return $this->getValue('RIp');
    }
    
    /**
     * 设置 注册Ip
     * @param $RIp
     * @return AppUserModel
     */
    public function setRIp($RIp)
    {
        return $this->setValue('RIp', $RIp);
    }
    
    /**
     * 获取 1注册 2后台添加
     * @return int
     */
    public function getSource(): ?int
    {
        return $this->getValue('source');
    }
    
    /**
     * 设置 1注册 2后台添加
     * @param int $source
     * @return AppUserModel
     */
    public function setSource(?int $source)
    {
        return $this->setValue('source', $source);
    }
    
    /**
     * 获取 1注册为普通用户 2 注册为商户 3 注册为配送人员
     * @return int
     */
    public function getType(): ?int
    {
        return $this->getValue('type');
    }
    
    /**
     * 设置 1注册为普通用户 2 注册为商户 3 注册为配送人员
     * @param int $type
     * @return AppUserModel
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
     * @return AppUserModel
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
     * @return AppUserModel
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
     * @return AppUserModel
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
     * @return AppUserModel
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
     * @return AppUserModel
     */
    public function setUpdatedTime($updatedTime)
    {
        return $this->setValue('updatedTime', $updatedTime);
    }
}