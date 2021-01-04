<?php

namespace apps\core\classier\model;

use Exception;
use rapidPHP\modules\core\classier\Model;

/**
 * 后台管理员
 * @table app_admin
 * rapidPHP auto generate Model 2021-01-05 00:02:36
 */
class AppAdminModel extends Model
{
    
    /**
     * table name
     */
    const NAME = 'app_admin';
        
    
    /**
     * 管理员Id
     * @length 
     * @typed bigint
     */
    private $id;    
    
    /**
     * 父id
     * @length 
     * @typed bigint
     */
    private $parent_id;    
    
    /**
     * 管理员名称
     * @length 50
     * @typed varchar
     */
    private $nickname;    
    
    /**
     * 登录账号
     * @length 15
     * @typed varchar
     */
    private $username;    
    
    /**
     * 登录密码
     * @length 40
     * @typed varchar
     */
    private $password;    
    
    /**
     * 是否最高管理员
     * @length 
     * @typed bit
     */
    private $is_supreme;    
    
    /**
     * 备注
     * @length 50
     * @typed varchar
     */
    private $remark;    
    
    /**
     * 类型 1 后台系统 2 web数据大屏
     * @length 
     * @typed tinyint
     */
    private $type;    
    
    /**
     * 是否删除
     * @length 
     * @typed bit
     */
    private $is_delete;    
    
    /**
     * 创建人Id
     * @length 
     * @typed bigint
     */
    private $created_id;    
    
    /**
     * 创建时间
     * @length 
     * @typed datetime
     */
    private $created_time;    
    
    /**
     * 修改人Id
     * @length 
     * @typed bigint
     */
    private $updated_id;    
    
    /**
     * 修改时间
     * @length 
     * @typed datetime
     */
    private $updated_time;    
    /**
     * 获取 管理员Id
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * 设置 管理员Id
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
    /**
     * 效验 管理员Id
     * @param string $msg
     * @throws Exception
     */
    public function validId(string $msg = 'id Cannot be empty!')
    {
        if(empty($this->id)) throw new Exception($msg);
    }
    
    /**
     * 获取 父id
     * @return mixed
     */
    public function getParentId()
    {
        return $this->parent_id;
    }
    
    /**
     * 设置 父id
     * @param $parent_id
     */
    public function setParentId($parent_id)
    {
        $this->parent_id = $parent_id;
    }
    
    /**
     * 效验 父id
     * @param string $msg
     * @throws Exception
     */
    public function validParentId(string $msg = 'parent_id Cannot be empty!')
    {
        if(empty($this->parent_id)) throw new Exception($msg);
    }
    
    /**
     * 获取 管理员名称
     * @return string
     */
    public function getNickname(): ?string
    {
        return $this->nickname;
    }
    
    /**
     * 设置 管理员名称
     * @param string|null $nickname
     */
    public function setNickname(?string $nickname)
    {
        $this->nickname = $nickname;
    }
    
    /**
     * 效验 管理员名称
     * @param string $msg
     * @throws Exception
     */
    public function validNickname(string $msg = 'nickname Cannot be empty!')
    {
        if(empty($this->nickname)) throw new Exception($msg);
    }
    
    /**
     * 获取 登录账号
     * @return string
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }
    
    /**
     * 设置 登录账号
     * @param string|null $username
     */
    public function setUsername(?string $username)
    {
        $this->username = $username;
    }
    
    /**
     * 效验 登录账号
     * @param string $msg
     * @throws Exception
     */
    public function validUsername(string $msg = 'username Cannot be empty!')
    {
        if(empty($this->username)) throw new Exception($msg);
    }
    
    /**
     * 获取 登录密码
     * @return string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }
    
    /**
     * 设置 登录密码
     * @param string|null $password
     */
    public function setPassword(?string $password)
    {
        $this->password = $password;
    }
    
    /**
     * 效验 登录密码
     * @param string $msg
     * @throws Exception
     */
    public function validPassword(string $msg = 'password Cannot be empty!')
    {
        if(empty($this->password)) throw new Exception($msg);
    }
    
    /**
     * 获取 是否最高管理员
     * @return bool
     */
    public function getIsSupreme(): ?bool
    {
        return $this->is_supreme;
    }
    
    /**
     * 设置 是否最高管理员
     * @param bool|null $is_supreme
     */
    public function setIsSupreme(?bool $is_supreme)
    {
        $this->is_supreme = $is_supreme;
    }
    
    /**
     * 效验 是否最高管理员
     * @param string $msg
     * @throws Exception
     */
    public function validIsSupreme(string $msg = 'is_supreme Cannot be empty!')
    {
        if(empty($this->is_supreme)) throw new Exception($msg);
    }
    
    /**
     * 获取 备注
     * @return string
     */
    public function getRemark(): ?string
    {
        return $this->remark;
    }
    
    /**
     * 设置 备注
     * @param string|null $remark
     */
    public function setRemark(?string $remark)
    {
        $this->remark = $remark;
    }
    
    /**
     * 效验 备注
     * @param string $msg
     * @throws Exception
     */
    public function validRemark(string $msg = 'remark Cannot be empty!')
    {
        if(empty($this->remark)) throw new Exception($msg);
    }
    
    /**
     * 获取 类型 1 后台系统 2 web数据大屏
     * @return int
     */
    public function getType(): ?int
    {
        return $this->type;
    }
    
    /**
     * 设置 类型 1 后台系统 2 web数据大屏
     * @param int|null $type
     */
    public function setType(?int $type)
    {
        $this->type = $type;
    }
    
    /**
     * 效验 类型 1 后台系统 2 web数据大屏
     * @param string $msg
     * @throws Exception
     */
    public function validType(string $msg = 'type Cannot be empty!')
    {
        if(empty($this->type)) throw new Exception($msg);
    }
    
    /**
     * 获取 是否删除
     * @return bool
     */
    public function getIsDelete(): ?bool
    {
        return $this->is_delete;
    }
    
    /**
     * 设置 是否删除
     * @param bool|null $is_delete
     */
    public function setIsDelete(?bool $is_delete)
    {
        $this->is_delete = $is_delete;
    }
    
    /**
     * 效验 是否删除
     * @param string $msg
     * @throws Exception
     */
    public function validIsDelete(string $msg = 'is_delete Cannot be empty!')
    {
        if(empty($this->is_delete)) throw new Exception($msg);
    }
    
    /**
     * 获取 创建人Id
     * @return mixed
     */
    public function getCreatedId()
    {
        return $this->created_id;
    }
    
    /**
     * 设置 创建人Id
     * @param $created_id
     */
    public function setCreatedId($created_id)
    {
        $this->created_id = $created_id;
    }
    
    /**
     * 效验 创建人Id
     * @param string $msg
     * @throws Exception
     */
    public function validCreatedId(string $msg = 'created_id Cannot be empty!')
    {
        if(empty($this->created_id)) throw new Exception($msg);
    }
    
    /**
     * 获取 创建时间
     * @return string
     */
    public function getCreatedTime(): ?string
    {
        return $this->created_time;
    }
    
    /**
     * 设置 创建时间
     * @param string|null $created_time
     */
    public function setCreatedTime(?string $created_time)
    {
        $this->created_time = $created_time;
    }
    
    /**
     * 效验 创建时间
     * @param string $msg
     * @throws Exception
     */
    public function validCreatedTime(string $msg = 'created_time Cannot be empty!')
    {
        if(empty($this->created_time)) throw new Exception($msg);
    }
    
    /**
     * 获取 修改人Id
     * @return mixed
     */
    public function getUpdatedId()
    {
        return $this->updated_id;
    }
    
    /**
     * 设置 修改人Id
     * @param $updated_id
     */
    public function setUpdatedId($updated_id)
    {
        $this->updated_id = $updated_id;
    }
    
    /**
     * 效验 修改人Id
     * @param string $msg
     * @throws Exception
     */
    public function validUpdatedId(string $msg = 'updated_id Cannot be empty!')
    {
        if(empty($this->updated_id)) throw new Exception($msg);
    }
    
    /**
     * 获取 修改时间
     * @return string
     */
    public function getUpdatedTime(): ?string
    {
        return $this->updated_time;
    }
    
    /**
     * 设置 修改时间
     * @param string|null $updated_time
     */
    public function setUpdatedTime(?string $updated_time)
    {
        $this->updated_time = $updated_time;
    }
    
    /**
     * 效验 修改时间
     * @param string $msg
     * @throws Exception
     */
    public function validUpdatedTime(string $msg = 'updated_time Cannot be empty!')
    {
        if(empty($this->updated_time)) throw new Exception($msg);
    }
}