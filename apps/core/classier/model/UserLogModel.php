<?php

namespace apps\core\classier\model;

use Exception;
use rapidPHP\modules\core\classier\Model;

/**
 * 用户登录日志表
 * @table user_log
 * rapidPHP auto generate Model 2021-01-25 21:19:27
 */
class UserLogModel extends Model
{
    
    /**
     * table name
     */
    const NAME = 'user_log';
        
    
    /**
     * 日志Id
     * @length 
     * @typed bigint
     */
    private $id;    
    
    /**
     * 用户Id
     * @length 
     * @typed bigint
     */
    private $bind_id;    
    
    /**
     * tokenId
     * @length 32
     * @typed varchar
     */
    private $token;    
    
    /**
     * 登录方式
     * @length 50
     * @typed varchar
     */
    private $mode;    
    
    /**
     * 日期
     * @length 
     * @typed datetime
     */
    private $date;    
    
    /**
     * 登录ip
     * @length 18
     * @typed varchar
     */
    private $ip;    
    
    /**
     * 登录设备
     * @length 1024
     * @typed varchar
     */
    private $device;    
    
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
     * 获取 日志Id
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * 设置 日志Id
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
    /**
     * 效验 日志Id
     * @param string $msg
     * @throws Exception
     */
    public function validId(string $msg = 'id Cannot be empty!')
    {
        if(empty($this->id)) throw new Exception($msg);
    }
    
    /**
     * 获取 用户Id
     * @return mixed
     */
    public function getBindId()
    {
        return $this->bind_id;
    }
    
    /**
     * 设置 用户Id
     * @param $bind_id
     */
    public function setBindId($bind_id)
    {
        $this->bind_id = $bind_id;
    }
    
    /**
     * 效验 用户Id
     * @param string $msg
     * @throws Exception
     */
    public function validBindId(string $msg = 'bind_id Cannot be empty!')
    {
        if(empty($this->bind_id)) throw new Exception($msg);
    }
    
    /**
     * 获取 tokenId
     * @return string
     */
    public function getToken(): ?string
    {
        return $this->token;
    }
    
    /**
     * 设置 tokenId
     * @param string|null $token
     */
    public function setToken(?string $token)
    {
        $this->token = $token;
    }
    
    /**
     * 效验 tokenId
     * @param string $msg
     * @throws Exception
     */
    public function validToken(string $msg = 'token Cannot be empty!')
    {
        if(empty($this->token)) throw new Exception($msg);
    }
    
    /**
     * 获取 登录方式
     * @return string
     */
    public function getMode(): ?string
    {
        return $this->mode;
    }
    
    /**
     * 设置 登录方式
     * @param string|null $mode
     */
    public function setMode(?string $mode)
    {
        $this->mode = $mode;
    }
    
    /**
     * 效验 登录方式
     * @param string $msg
     * @throws Exception
     */
    public function validMode(string $msg = 'mode Cannot be empty!')
    {
        if(empty($this->mode)) throw new Exception($msg);
    }
    
    /**
     * 获取 日期
     * @return string
     */
    public function getDate(): ?string
    {
        return $this->date;
    }
    
    /**
     * 设置 日期
     * @param string|null $date
     */
    public function setDate(?string $date)
    {
        $this->date = $date;
    }
    
    /**
     * 效验 日期
     * @param string $msg
     * @throws Exception
     */
    public function validDate(string $msg = 'date Cannot be empty!')
    {
        if(empty($this->date)) throw new Exception($msg);
    }
    
    /**
     * 获取 登录ip
     * @return string
     */
    public function getIp(): ?string
    {
        return $this->ip;
    }
    
    /**
     * 设置 登录ip
     * @param string|null $ip
     */
    public function setIp(?string $ip)
    {
        $this->ip = $ip;
    }
    
    /**
     * 效验 登录ip
     * @param string $msg
     * @throws Exception
     */
    public function validIp(string $msg = 'ip Cannot be empty!')
    {
        if(empty($this->ip)) throw new Exception($msg);
    }
    
    /**
     * 获取 登录设备
     * @return string
     */
    public function getDevice(): ?string
    {
        return $this->device;
    }
    
    /**
     * 设置 登录设备
     * @param string|null $device
     */
    public function setDevice(?string $device)
    {
        $this->device = $device;
    }
    
    /**
     * 效验 登录设备
     * @param string $msg
     * @throws Exception
     */
    public function validDevice(string $msg = 'device Cannot be empty!')
    {
        if(empty($this->device)) throw new Exception($msg);
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