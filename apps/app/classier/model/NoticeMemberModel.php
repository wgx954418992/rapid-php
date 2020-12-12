<?php

namespace apps\app\classier\model;

use Exception;
use rapidPHP\modules\core\classier\Model;

/**
 * 通知成员表
 * @table notice_member
 * rapidPHP auto generate Model 2020-12-13 00:03:18
 */
class NoticeMemberModel extends Model
{
    
    /**
     * table name
     */
    const NAME = 'notice_member';
        
    
    /**
     * 成员id
     * @length 
     * @typed bigint
     */
    public $id;    
    
    /**
     * 消息id
     * @length 
     * @typed bigint
     */
    public $notice_id;    
    
    /**
     * 通知的用户id
     * @length 
     * @typed bigint
     */
    public $user_id;    
    
    /**
     * 发送时间
     * @length 
     * @typed datetime
     */
    public $send_time;    
    
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
     * 获取 成员id
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * 设置 成员id
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
    /**
     * 效验 成员id
     * @param string $msg
     * @throws Exception
     */
    public function validId(string $msg = 'id Cannot be empty!')
    {
        if(empty($this->id)) throw new Exception($msg);
    }
    
    /**
     * 获取 消息id
     * @return mixed
     */
    public function getNoticeId()
    {
        return $this->notice_id;
    }
    
    /**
     * 设置 消息id
     * @param $notice_id
     */
    public function setNoticeId($notice_id)
    {
        $this->notice_id = $notice_id;
    }
    
    /**
     * 效验 消息id
     * @param string $msg
     * @throws Exception
     */
    public function validNoticeId(string $msg = 'notice_id Cannot be empty!')
    {
        if(empty($this->notice_id)) throw new Exception($msg);
    }
    
    /**
     * 获取 通知的用户id
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }
    
    /**
     * 设置 通知的用户id
     * @param $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }
    
    /**
     * 效验 通知的用户id
     * @param string $msg
     * @throws Exception
     */
    public function validUserId(string $msg = 'user_id Cannot be empty!')
    {
        if(empty($this->user_id)) throw new Exception($msg);
    }
    
    /**
     * 获取 发送时间
     * @return string
     */
    public function getSendTime(): ?string
    {
        return $this->send_time;
    }
    
    /**
     * 设置 发送时间
     * @param string|null $send_time
     */
    public function setSendTime(?string $send_time)
    {
        $this->send_time = $send_time;
    }
    
    /**
     * 效验 发送时间
     * @param string $msg
     * @throws Exception
     */
    public function validSendTime(string $msg = 'send_time Cannot be empty!')
    {
        if(empty($this->send_time)) throw new Exception($msg);
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