<?php

namespace apps\app\classier\model;

use Exception;
use rapidPHP\modules\core\classier\Model;

/**
 * 系统日志表
 * @table app_log
 * rapidPHP auto generate Model 2020-12-13 00:03:16
 */
class AppLogModel extends Model
{
    
    /**
     * table name
     */
    const NAME = 'app_log';
        
    
    /**
     * 主键
     * @length 
     * @typed bigint
     */
    public $id;    
    
    /**
     * 日志消息
     * @length 1024
     * @typed varchar
     */
    public $msg;    
    
    /**
     * 数据
     * @length 4294967295
     * @typed longtext
     */
    public $content;    
    
    /**
     * 类型：1 运行日志 2 错误日志 3 操作日志 4 设备日志 5 其他日志
     * @length 
     * @typed tinyint
     */
    public $type;    
    
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
     * 获取 日志消息
     * @return string
     */
    public function getMsg(): ?string
    {
        return $this->msg;
    }
    
    /**
     * 设置 日志消息
     * @param string|null $msg
     */
    public function setMsg(?string $msg)
    {
        $this->msg = $msg;
    }
    
    /**
     * 效验 日志消息
     * @param string $msg
     * @throws Exception
     */
    public function validMsg(string $msg = 'msg Cannot be empty!')
    {
        if(empty($this->msg)) throw new Exception($msg);
    }
    
    /**
     * 获取 数据
     * @return string
     */
    public function getContent(): ?string
    {
        return $this->content;
    }
    
    /**
     * 设置 数据
     * @param string|null $content
     */
    public function setContent(?string $content)
    {
        $this->content = $content;
    }
    
    /**
     * 效验 数据
     * @param string $msg
     * @throws Exception
     */
    public function validContent(string $msg = 'content Cannot be empty!')
    {
        if(empty($this->content)) throw new Exception($msg);
    }
    
    /**
     * 获取 类型：1 运行日志 2 错误日志 3 操作日志 4 设备日志 5 其他日志
     * @return int
     */
    public function getType(): ?int
    {
        return $this->type;
    }
    
    /**
     * 设置 类型：1 运行日志 2 错误日志 3 操作日志 4 设备日志 5 其他日志
     * @param int|null $type
     */
    public function setType(?int $type)
    {
        $this->type = $type;
    }
    
    /**
     * 效验 类型：1 运行日志 2 错误日志 3 操作日志 4 设备日志 5 其他日志
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