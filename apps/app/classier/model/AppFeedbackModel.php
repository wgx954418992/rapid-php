<?php

namespace apps\app\classier\model;

use Exception;
use rapidPHP\modules\core\classier\Model;

/**
 * 反馈表
 * @table app_feedback
 * rapidPHP auto generate Model 2020-12-13 00:03:16
 */
class AppFeedbackModel extends Model
{
    
    /**
     * table name
     */
    const NAME = 'app_feedback';
        
    
    /**
     * 反馈Id
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
     * 内容
     * @length 4294967295
     * @typed longtext
     */
    public $content;    
    
    /**
     * 联系方式
     * @length 50
     * @typed varchar
     */
    public $contact;    
    
    /**
     * 状态 1 反馈成功(等待处理) 2 已处理 
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
     * 获取 反馈Id
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * 设置 反馈Id
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
    /**
     * 效验 反馈Id
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
     * 获取 内容
     * @return string
     */
    public function getContent(): ?string
    {
        return $this->content;
    }
    
    /**
     * 设置 内容
     * @param string|null $content
     */
    public function setContent(?string $content)
    {
        $this->content = $content;
    }
    
    /**
     * 效验 内容
     * @param string $msg
     * @throws Exception
     */
    public function validContent(string $msg = 'content Cannot be empty!')
    {
        if(empty($this->content)) throw new Exception($msg);
    }
    
    /**
     * 获取 联系方式
     * @return string
     */
    public function getContact(): ?string
    {
        return $this->contact;
    }
    
    /**
     * 设置 联系方式
     * @param string|null $contact
     */
    public function setContact(?string $contact)
    {
        $this->contact = $contact;
    }
    
    /**
     * 效验 联系方式
     * @param string $msg
     * @throws Exception
     */
    public function validContact(string $msg = 'contact Cannot be empty!')
    {
        if(empty($this->contact)) throw new Exception($msg);
    }
    
    /**
     * 获取 状态 1 反馈成功(等待处理) 2 已处理 
     * @return int
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }
    
    /**
     * 设置 状态 1 反馈成功(等待处理) 2 已处理 
     * @param int|null $status
     */
    public function setStatus(?int $status)
    {
        $this->status = $status;
    }
    
    /**
     * 效验 状态 1 反馈成功(等待处理) 2 已处理 
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