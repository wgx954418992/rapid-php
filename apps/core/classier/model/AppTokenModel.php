<?php

namespace apps\core\classier\model;

use Exception;
use rapidPHP\modules\core\classier\Model;

/**
 * Token存储表
 * @table app_token
 * rapidPHP auto generate Model 2021-01-25 21:19:26
 */
class AppTokenModel extends Model
{
    
    /**
     * table name
     */
    const NAME = 'app_token';
        
    
    /**
     * token
     * @length 32
     * @typed varchar
     */
    private $token;    
    
    /**
     * 绑定的Id可以是用户Id，或其他
     * @length 
     * @typed bigint
     */
    private $bind_id;    
    
    /**
     * token类型1用户0后台
     * @length 10
     * @typed varchar
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
     * 获取 token
     * @return string
     */
    public function getToken(): ?string
    {
        return $this->token;
    }
    
    /**
     * 设置 token
     * @param string|null $token
     */
    public function setToken(?string $token)
    {
        $this->token = $token;
    }
    
    /**
     * 效验 token
     * @param string $msg
     * @throws Exception
     */
    public function validToken(string $msg = 'token Cannot be empty!')
    {
        if(empty($this->token)) throw new Exception($msg);
    }
    
    /**
     * 获取 绑定的Id可以是用户Id，或其他
     * @return mixed
     */
    public function getBindId()
    {
        return $this->bind_id;
    }
    
    /**
     * 设置 绑定的Id可以是用户Id，或其他
     * @param $bind_id
     */
    public function setBindId($bind_id)
    {
        $this->bind_id = $bind_id;
    }
    
    /**
     * 效验 绑定的Id可以是用户Id，或其他
     * @param string $msg
     * @throws Exception
     */
    public function validBindId(string $msg = 'bind_id Cannot be empty!')
    {
        if(empty($this->bind_id)) throw new Exception($msg);
    }
    
    /**
     * 获取 token类型1用户0后台
     * @return string
     */
    public function getType(): ?string
    {
        return $this->type;
    }
    
    /**
     * 设置 token类型1用户0后台
     * @param string|null $type
     */
    public function setType(?string $type)
    {
        $this->type = $type;
    }
    
    /**
     * 效验 token类型1用户0后台
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