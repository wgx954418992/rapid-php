<?php

namespace apps\core\classier\model;

use Exception;
use rapidPHP\modules\core\classier\Model;

/**
 * 后台系统uri资源表
 * @table admin_uri
 * rapidPHP auto generate Model 2021-01-05 00:02:36
 */
class AdminUriModel extends Model
{
    
    /**
     * table name
     */
    const NAME = 'admin_uri';
        
    
    /**
     * 主键
     * @length 
     * @typed bigint
     */
    private $id;    
    
    /**
     * 名称
     * @length 50
     * @typed varchar
     */
    private $name;    
    
    /**
     * uri
     * @length 50
     * @typed varchar
     */
    private $uri;    
    
    /**
     * 组
     * @length 50
     * @typed varchar
     */
    private $group;    
    
    /**
     * 是否系统
     * @length 
     * @typed bit
     */
    private $is_system;    
    
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
     * 获取 名称
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }
    
    /**
     * 设置 名称
     * @param string|null $name
     */
    public function setName(?string $name)
    {
        $this->name = $name;
    }
    
    /**
     * 效验 名称
     * @param string $msg
     * @throws Exception
     */
    public function validName(string $msg = 'name Cannot be empty!')
    {
        if(empty($this->name)) throw new Exception($msg);
    }
    
    /**
     * 获取 uri
     * @return string
     */
    public function getUri(): ?string
    {
        return $this->uri;
    }
    
    /**
     * 设置 uri
     * @param string|null $uri
     */
    public function setUri(?string $uri)
    {
        $this->uri = $uri;
    }
    
    /**
     * 效验 uri
     * @param string $msg
     * @throws Exception
     */
    public function validUri(string $msg = 'uri Cannot be empty!')
    {
        if(empty($this->uri)) throw new Exception($msg);
    }
    
    /**
     * 获取 组
     * @return string
     */
    public function getGroup(): ?string
    {
        return $this->group;
    }
    
    /**
     * 设置 组
     * @param string|null $group
     */
    public function setGroup(?string $group)
    {
        $this->group = $group;
    }
    
    /**
     * 效验 组
     * @param string $msg
     * @throws Exception
     */
    public function validGroup(string $msg = 'group Cannot be empty!')
    {
        if(empty($this->group)) throw new Exception($msg);
    }
    
    /**
     * 获取 是否系统
     * @return bool
     */
    public function getIsSystem(): ?bool
    {
        return $this->is_system;
    }
    
    /**
     * 设置 是否系统
     * @param bool|null $is_system
     */
    public function setIsSystem(?bool $is_system)
    {
        $this->is_system = $is_system;
    }
    
    /**
     * 效验 是否系统
     * @param string $msg
     * @throws Exception
     */
    public function validIsSystem(string $msg = 'is_system Cannot be empty!')
    {
        if(empty($this->is_system)) throw new Exception($msg);
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