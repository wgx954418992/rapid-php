<?php

namespace apps\app\classier\model;

use Exception;
use rapidPHP\modules\core\classier\Model;

/**
 * 相册
 * @table app_album
 * rapidPHP auto generate Model 2020-12-13 00:03:16
 */
class AppAlbumModel extends Model
{
    
    /**
     * table name
     */
    const NAME = 'app_album';
        
    
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
     * 标题
     * @length 255
     * @typed varchar
     */
    public $title;    
    
    /**
     * 密令
     * @length 40
     * @typed varchar
     */
    public $secret_key;    
    
    /**
     * 密令结束日期 为null 则为长期
     * @length 
     * @typed datetime
     */
    public $secret_valid;    
    
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
     * 获取 标题
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }
    
    /**
     * 设置 标题
     * @param string|null $title
     */
    public function setTitle(?string $title)
    {
        $this->title = $title;
    }
    
    /**
     * 效验 标题
     * @param string $msg
     * @throws Exception
     */
    public function validTitle(string $msg = 'title Cannot be empty!')
    {
        if(empty($this->title)) throw new Exception($msg);
    }
    
    /**
     * 获取 密令
     * @return string
     */
    public function getSecretKey(): ?string
    {
        return $this->secret_key;
    }
    
    /**
     * 设置 密令
     * @param string|null $secret_key
     */
    public function setSecretKey(?string $secret_key)
    {
        $this->secret_key = $secret_key;
    }
    
    /**
     * 效验 密令
     * @param string $msg
     * @throws Exception
     */
    public function validSecretKey(string $msg = 'secret_key Cannot be empty!')
    {
        if(empty($this->secret_key)) throw new Exception($msg);
    }
    
    /**
     * 获取 密令结束日期 为null 则为长期
     * @return string
     */
    public function getSecretValid(): ?string
    {
        return $this->secret_valid;
    }
    
    /**
     * 设置 密令结束日期 为null 则为长期
     * @param string|null $secret_valid
     */
    public function setSecretValid(?string $secret_valid)
    {
        $this->secret_valid = $secret_valid;
    }
    
    /**
     * 效验 密令结束日期 为null 则为长期
     * @param string $msg
     * @throws Exception
     */
    public function validSecretValid(string $msg = 'secret_valid Cannot be empty!')
    {
        if(empty($this->secret_valid)) throw new Exception($msg);
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