<?php

namespace apps\app\classier\model;

use Exception;
use rapidPHP\modules\core\classier\Model;

/**
 * 用户关注表
 * @table user_follow
 * rapidPHP auto generate Model 2020-12-13 00:03:18
 */
class UserFollowModel extends Model
{
    
    /**
     * table name
     */
    const NAME = 'user_follow';
        
    
    /**
     * 主键
     * @length 
     * @typed bigint
     */
    public $id;    
    
    /**
     * 用户id
     * @length 
     * @typed bigint
     */
    public $user_id;    
    
    /**
     * 关注的用户id
     * @length 
     * @typed bigint
     */
    public $to_id;    
    
    /**
     * 申请关注的用户id
     * @length 
     * @typed bigint
     */
    public $apply_id;    
    
    /**
     * 状态 1 申请中 2 已关注 3 拒绝关注
     * @length 
     * @typed tinyint
     */
    public $status;    
    
    /**
     * 是否删除
     * @length 
     * @typed bit
     */
    public $is_delete;    
    
    /**
     * 创建人Id
     * @length 
     * @typed bigint
     */
    public $created_id;    
    
    /**
     * 创建时间
     * @length 
     * @typed datetime
     */
    public $created_time;    
    
    /**
     * 修改人Id
     * @length 
     * @typed bigint
     */
    public $updated_id;    
    
    /**
     * 修改时间
     * @length 
     * @typed datetime
     */
    public $updated_time;    
    /**
     * 获取 主键
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * 设置 主键
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
    /**
     * 效验 主键
     * @param string $msg
     * @throws Exception
     */
    public function validId(string $msg = 'id Cannot be empty!')
    {
        if(empty($this->id)) throw new Exception($msg);
    }
    
    /**
     * 获取 用户id
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }
    
    /**
     * 设置 用户id
     * @param $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }
    
    /**
     * 效验 用户id
     * @param string $msg
     * @throws Exception
     */
    public function validUserId(string $msg = 'user_id Cannot be empty!')
    {
        if(empty($this->user_id)) throw new Exception($msg);
    }
    
    /**
     * 获取 关注的用户id
     * @return mixed
     */
    public function getToId()
    {
        return $this->to_id;
    }
    
    /**
     * 设置 关注的用户id
     * @param $to_id
     */
    public function setToId($to_id)
    {
        $this->to_id = $to_id;
    }
    
    /**
     * 效验 关注的用户id
     * @param string $msg
     * @throws Exception
     */
    public function validToId(string $msg = 'to_id Cannot be empty!')
    {
        if(empty($this->to_id)) throw new Exception($msg);
    }
    
    /**
     * 获取 申请关注的用户id
     * @return mixed
     */
    public function getApplyId()
    {
        return $this->apply_id;
    }
    
    /**
     * 设置 申请关注的用户id
     * @param $apply_id
     */
    public function setApplyId($apply_id)
    {
        $this->apply_id = $apply_id;
    }
    
    /**
     * 效验 申请关注的用户id
     * @param string $msg
     * @throws Exception
     */
    public function validApplyId(string $msg = 'apply_id Cannot be empty!')
    {
        if(empty($this->apply_id)) throw new Exception($msg);
    }
    
    /**
     * 获取 状态 1 申请中 2 已关注 3 拒绝关注
     * @return int
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }
    
    /**
     * 设置 状态 1 申请中 2 已关注 3 拒绝关注
     * @param int|null $status
     */
    public function setStatus(?int $status)
    {
        $this->status = $status;
    }
    
    /**
     * 效验 状态 1 申请中 2 已关注 3 拒绝关注
     * @param string $msg
     * @throws Exception
     */
    public function validStatus(string $msg = 'status Cannot be empty!')
    {
        if(empty($this->status)) throw new Exception($msg);
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