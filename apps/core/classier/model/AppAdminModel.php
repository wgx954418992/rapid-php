<?php

namespace apps\core\classier\model;

use Exception;
use rapidPHP\modules\core\classier\Model;


/**
 * 后台管理员
 * @table app_admin
 * rapidPHP auto generate Model 2022-04-11 11:39:17
 */

class AppAdminModel extends Model 
{

    /**
     * table name
     */
    const NAME = 'app_admin';

    
    /**
     * 管理员Id
     * @var 
     * @length 
     * @typed bigint
     */
    protected $id;

    /**
     * 设置 管理员Id
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * 获取 管理员Id
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * 效验 管理员Id
     * @param string $msg
     * @throws Exception
     */
    public function validId(string $msg = 'id Cannot be empty!')
    {
        if (empty($this->id)) throw new Exception($msg);
    }

    /**
     * 父id
     * @var 
     * @length 
     * @typed bigint
     */
    protected $parent_id;

    /**
     * 设置 父id
     * @param $parent_id
     */
    public function setParentId($parent_id)
    {
        $this->parent_id = $parent_id;
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
     * 效验 父id
     * @param string $msg
     * @throws Exception
     */
    public function validParentId(string $msg = 'parent_id Cannot be empty!')
    {
        if (empty($this->parent_id)) throw new Exception($msg);
    }

    /**
     * 管理员名称
     * @var string|null 
     * @length 50
     * @typed varchar
     */
    protected $nickname;

    /**
     * 设置 管理员名称
     * @param string|null $nickname
     */
    public function setNickname(?string $nickname)
    {
        $this->nickname = $nickname;
    }

    /**
     * 获取 管理员名称
     * @return string|null
     */
    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    /**
     * 效验 管理员名称
     * @param string $msg
     * @throws Exception
     */
    public function validNickname(string $msg = 'nickname Cannot be empty!')
    {
        if (empty($this->nickname)) throw new Exception($msg);
    }

    /**
     * 登录账号
     * @var string|null 
     * @length 50
     * @typed varchar
     */
    protected $username;

    /**
     * 设置 登录账号
     * @param string|null $username
     */
    public function setUsername(?string $username)
    {
        $this->username = $username;
    }

    /**
     * 获取 登录账号
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * 效验 登录账号
     * @param string $msg
     * @throws Exception
     */
    public function validUsername(string $msg = 'username Cannot be empty!')
    {
        if (empty($this->username)) throw new Exception($msg);
    }

    /**
     * 登录密码
     * @var string|null 
     * @length 40
     * @typed varchar
     */
    protected $password;

    /**
     * 设置 登录密码
     * @param string|null $password
     */
    public function setPassword(?string $password)
    {
        $this->password = $password;
    }

    /**
     * 获取 登录密码
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * 效验 登录密码
     * @param string $msg
     * @throws Exception
     */
    public function validPassword(string $msg = 'password Cannot be empty!')
    {
        if (empty($this->password)) throw new Exception($msg);
    }

    /**
     * 头像文件Id
     * @var 
     * @length 
     * @typed bigint
     */
    protected $head_fid;

    /**
     * 设置 头像文件Id
     * @param $head_fid
     */
    public function setHeadFid($head_fid)
    {
        $this->head_fid = $head_fid;
    }

    /**
     * 获取 头像文件Id
     * @return mixed
     */
    public function getHeadFid()
    {
        return $this->head_fid;
    }

    /**
     * 效验 头像文件Id
     * @param string $msg
     * @throws Exception
     */
    public function validHeadFid(string $msg = 'head_fid Cannot be empty!')
    {
        if (empty($this->head_fid)) throw new Exception($msg);
    }

    /**
     * 是否最高管理员
     * @var bool|null 
     * @length 
     * @typed bit
     */
    protected $is_supreme;

    /**
     * 设置 是否最高管理员
     * @param bool|null $is_supreme
     */
    public function setIsSupreme(?bool $is_supreme)
    {
        $this->is_supreme = $is_supreme;
    }

    /**
     * 获取 是否最高管理员
     * @return bool|null
     */
    public function getIsSupreme(): ?bool
    {
        return $this->is_supreme;
    }

    /**
     * 效验 是否最高管理员
     * @param string $msg
     * @throws Exception
     */
    public function validIsSupreme(string $msg = 'is_supreme Cannot be empty!')
    {
        if (empty($this->is_supreme)) throw new Exception($msg);
    }

    /**
     * 备注
     * @var string|null 
     * @length 50
     * @typed varchar
     */
    protected $remark;

    /**
     * 设置 备注
     * @param string|null $remark
     */
    public function setRemark(?string $remark)
    {
        $this->remark = $remark;
    }

    /**
     * 获取 备注
     * @return string|null
     */
    public function getRemark(): ?string
    {
        return $this->remark;
    }

    /**
     * 效验 备注
     * @param string $msg
     * @throws Exception
     */
    public function validRemark(string $msg = 'remark Cannot be empty!')
    {
        if (empty($this->remark)) throw new Exception($msg);
    }

    /**
     * 类型 1 后台系统
     * @var int|null 
     * @length 
     * @typed tinyint
     */
    protected $type;

    /**
     * 设置 类型 1 后台系统
     * @param int|null $type
     */
    public function setType(?int $type)
    {
        $this->type = $type;
    }

    /**
     * 获取 类型 1 后台系统
     * @return int|null
     */
    public function getType(): ?int
    {
        return $this->type;
    }

    /**
     * 效验 类型 1 后台系统
     * @param string $msg
     * @throws Exception
     */
    public function validType(string $msg = 'type Cannot be empty!')
    {
        if (empty($this->type)) throw new Exception($msg);
    }

    /**
     * 是否删除
     * @var bool|null 
     * @length 
     * @typed bit
     */
    protected $is_delete;

    /**
     * 设置 是否删除
     * @param bool|null $is_delete
     */
    public function setIsDelete(?bool $is_delete)
    {
        $this->is_delete = $is_delete;
    }

    /**
     * 获取 是否删除
     * @return bool|null
     */
    public function getIsDelete(): ?bool
    {
        return $this->is_delete;
    }

    /**
     * 效验 是否删除
     * @param string $msg
     * @throws Exception
     */
    public function validIsDelete(string $msg = 'is_delete Cannot be empty!')
    {
        if (empty($this->is_delete)) throw new Exception($msg);
    }

    /**
     * 创建人Id
     * @var 
     * @length 
     * @typed bigint
     */
    protected $created_id;

    /**
     * 设置 创建人Id
     * @param $created_id
     */
    public function setCreatedId($created_id)
    {
        $this->created_id = $created_id;
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
     * 效验 创建人Id
     * @param string $msg
     * @throws Exception
     */
    public function validCreatedId(string $msg = 'created_id Cannot be empty!')
    {
        if (empty($this->created_id)) throw new Exception($msg);
    }

    /**
     * 创建时间
     * @var string|null 
     * @length 
     * @typed datetime
     */
    protected $created_time;

    /**
     * 设置 创建时间
     * @param string|null $created_time
     */
    public function setCreatedTime(?string $created_time)
    {
        $this->created_time = $created_time;
    }

    /**
     * 获取 创建时间
     * @return string|null
     */
    public function getCreatedTime(): ?string
    {
        return $this->created_time;
    }

    /**
     * 效验 创建时间
     * @param string $msg
     * @throws Exception
     */
    public function validCreatedTime(string $msg = 'created_time Cannot be empty!')
    {
        if (empty($this->created_time)) throw new Exception($msg);
    }

    /**
     * 修改人Id
     * @var 
     * @length 
     * @typed bigint
     */
    protected $updated_id;

    /**
     * 设置 修改人Id
     * @param $updated_id
     */
    public function setUpdatedId($updated_id)
    {
        $this->updated_id = $updated_id;
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
     * 效验 修改人Id
     * @param string $msg
     * @throws Exception
     */
    public function validUpdatedId(string $msg = 'updated_id Cannot be empty!')
    {
        if (empty($this->updated_id)) throw new Exception($msg);
    }

    /**
     * 修改时间
     * @var string|null 
     * @length 
     * @typed datetime
     */
    protected $updated_time;

    /**
     * 设置 修改时间
     * @param string|null $updated_time
     */
    public function setUpdatedTime(?string $updated_time)
    {
        $this->updated_time = $updated_time;
    }

    /**
     * 获取 修改时间
     * @return string|null
     */
    public function getUpdatedTime(): ?string
    {
        return $this->updated_time;
    }

    /**
     * 效验 修改时间
     * @param string $msg
     * @throws Exception
     */
    public function validUpdatedTime(string $msg = 'updated_time Cannot be empty!')
    {
        if (empty($this->updated_time)) throw new Exception($msg);
    }

}
