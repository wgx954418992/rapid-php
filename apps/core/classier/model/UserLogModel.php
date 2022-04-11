<?php

namespace apps\core\classier\model;

use Exception;
use rapidPHP\modules\core\classier\Model;


/**
 * 用户登录日志表
 * @table user_log
 * rapidPHP auto generate Model 2022-04-11 11:39:20
 */

class UserLogModel extends Model 
{

    /**
     * table name
     */
    const NAME = 'user_log';

    
    /**
     * 日志Id
     * @var 
     * @length 
     * @typed bigint
     */
    protected $id;

    /**
     * 设置 日志Id
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * 获取 日志Id
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * 效验 日志Id
     * @param string $msg
     * @throws Exception
     */
    public function validId(string $msg = 'id Cannot be empty!')
    {
        if (empty($this->id)) throw new Exception($msg);
    }

    /**
     * 用户Id
     * @var 
     * @length 
     * @typed bigint
     */
    protected $bind_id;

    /**
     * 设置 用户Id
     * @param $bind_id
     */
    public function setBindId($bind_id)
    {
        $this->bind_id = $bind_id;
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
     * 效验 用户Id
     * @param string $msg
     * @throws Exception
     */
    public function validBindId(string $msg = 'bind_id Cannot be empty!')
    {
        if (empty($this->bind_id)) throw new Exception($msg);
    }

    /**
     * tokenId
     * @var string|null 
     * @length 32
     * @typed varchar
     */
    protected $token;

    /**
     * 设置 tokenId
     * @param string|null $token
     */
    public function setToken(?string $token)
    {
        $this->token = $token;
    }

    /**
     * 获取 tokenId
     * @return string|null
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * 效验 tokenId
     * @param string $msg
     * @throws Exception
     */
    public function validToken(string $msg = 'token Cannot be empty!')
    {
        if (empty($this->token)) throw new Exception($msg);
    }

    /**
     * 登录方式
     * @var string|null 
     * @length 10
     * @typed varchar
     */
    protected $type;

    /**
     * 设置 登录方式
     * @param string|null $type
     */
    public function setType(?string $type)
    {
        $this->type = $type;
    }

    /**
     * 获取 登录方式
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * 效验 登录方式
     * @param string $msg
     * @throws Exception
     */
    public function validType(string $msg = 'type Cannot be empty!')
    {
        if (empty($this->type)) throw new Exception($msg);
    }

    /**
     * 日期
     * @var string|null 
     * @length 
     * @typed datetime
     */
    protected $date;

    /**
     * 设置 日期
     * @param string|null $date
     */
    public function setDate(?string $date)
    {
        $this->date = $date;
    }

    /**
     * 获取 日期
     * @return string|null
     */
    public function getDate(): ?string
    {
        return $this->date;
    }

    /**
     * 效验 日期
     * @param string $msg
     * @throws Exception
     */
    public function validDate(string $msg = 'date Cannot be empty!')
    {
        if (empty($this->date)) throw new Exception($msg);
    }

    /**
     * 登录ip
     * @var string|null 
     * @length 18
     * @typed varchar
     */
    protected $ip;

    /**
     * 设置 登录ip
     * @param string|null $ip
     */
    public function setIp(?string $ip)
    {
        $this->ip = $ip;
    }

    /**
     * 获取 登录ip
     * @return string|null
     */
    public function getIp(): ?string
    {
        return $this->ip;
    }

    /**
     * 效验 登录ip
     * @param string $msg
     * @throws Exception
     */
    public function validIp(string $msg = 'ip Cannot be empty!')
    {
        if (empty($this->ip)) throw new Exception($msg);
    }

    /**
     * 登录设备
     * @var string|null 
     * @length 1024
     * @typed varchar
     */
    protected $device;

    /**
     * 设置 登录设备
     * @param string|null $device
     */
    public function setDevice(?string $device)
    {
        $this->device = $device;
    }

    /**
     * 获取 登录设备
     * @return string|null
     */
    public function getDevice(): ?string
    {
        return $this->device;
    }

    /**
     * 效验 登录设备
     * @param string $msg
     * @throws Exception
     */
    public function validDevice(string $msg = 'device Cannot be empty!')
    {
        if (empty($this->device)) throw new Exception($msg);
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
