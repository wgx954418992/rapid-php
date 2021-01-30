<?php

namespace apps\core\classier\model;

use Exception;
use rapidPHP\modules\core\classier\Model;

/**
 * 消息队列表
 * @table app_queue
 * rapidPHP auto generate Model 2021-01-25 21:19:26
 */
class AppQueueModel extends Model
{
    
    /**
     * table name
     */
    const NAME = 'app_queue';
        
    
    /**
     * 队列Id
     * @length 
     * @typed bigint
     */
    private $id;    
    
    /**
     * 队列消息父Id
     * @length 
     * @typed bigint
     */
    private $parent_id;    
    
    /**
     * 跟队列所关联的值，用于取消队列
     * @length 50
     * @typed varchar
     */
    private $bind_id;    
    
    /**
     * 类型
     * @length 32
     * @typed varchar
     */
    private $type;    
    
    /**
     * 参数
     * @length 
     * @typed json
     */
    private $param;    
    
    /**
     * 触发时间
     * @length 
     * @typed bigint
     */
    private $trigger_time;    
    
    /**
     * 状态 1 等待执行 2 正在执行任务 3 执行完毕
     * @length 
     * @typed tinyint
     */
    private $status;    
    
    /**
     * 状态发生时间
     * @length 
     * @typed bigint
     */
    private $status_time;    
    
    /**
     * 备注
     * @length 50
     * @typed varchar
     */
    private $remark;    
    
    /**
     * 是否删除
     * @length 
     * @typed tinyint
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
     * 获取 队列Id
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * 设置 队列Id
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
    /**
     * 效验 队列Id
     * @param string $msg
     * @throws Exception
     */
    public function validId(string $msg = 'id Cannot be empty!')
    {
        if(empty($this->id)) throw new Exception($msg);
    }
    
    /**
     * 获取 队列消息父Id
     * @return mixed
     */
    public function getParentId()
    {
        return $this->parent_id;
    }
    
    /**
     * 设置 队列消息父Id
     * @param $parent_id
     */
    public function setParentId($parent_id)
    {
        $this->parent_id = $parent_id;
    }
    
    /**
     * 效验 队列消息父Id
     * @param string $msg
     * @throws Exception
     */
    public function validParentId(string $msg = 'parent_id Cannot be empty!')
    {
        if(empty($this->parent_id)) throw new Exception($msg);
    }
    
    /**
     * 获取 跟队列所关联的值，用于取消队列
     * @return string
     */
    public function getBindId(): ?string
    {
        return $this->bind_id;
    }
    
    /**
     * 设置 跟队列所关联的值，用于取消队列
     * @param string|null $bind_id
     */
    public function setBindId(?string $bind_id)
    {
        $this->bind_id = $bind_id;
    }
    
    /**
     * 效验 跟队列所关联的值，用于取消队列
     * @param string $msg
     * @throws Exception
     */
    public function validBindId(string $msg = 'bind_id Cannot be empty!')
    {
        if(empty($this->bind_id)) throw new Exception($msg);
    }
    
    /**
     * 获取 类型
     * @return string
     */
    public function getType(): ?string
    {
        return $this->type;
    }
    
    /**
     * 设置 类型
     * @param string|null $type
     */
    public function setType(?string $type)
    {
        $this->type = $type;
    }
    
    /**
     * 效验 类型
     * @param string $msg
     * @throws Exception
     */
    public function validType(string $msg = 'type Cannot be empty!')
    {
        if(empty($this->type)) throw new Exception($msg);
    }
    
    /**
     * 获取 参数
     * @return mixed
     */
    public function getParam()
    {
        return $this->param;
    }
    
    /**
     * 设置 参数
     * @param $param
     */
    public function setParam($param)
    {
        $this->param = $param;
    }
    
    /**
     * 效验 参数
     * @param string $msg
     * @throws Exception
     */
    public function validParam(string $msg = 'param Cannot be empty!')
    {
        if(empty($this->param)) throw new Exception($msg);
    }
    
    /**
     * 获取 触发时间
     * @return mixed
     */
    public function getTriggerTime()
    {
        return $this->trigger_time;
    }
    
    /**
     * 设置 触发时间
     * @param $trigger_time
     */
    public function setTriggerTime($trigger_time)
    {
        $this->trigger_time = $trigger_time;
    }
    
    /**
     * 效验 触发时间
     * @param string $msg
     * @throws Exception
     */
    public function validTriggerTime(string $msg = 'trigger_time Cannot be empty!')
    {
        if(empty($this->trigger_time)) throw new Exception($msg);
    }
    
    /**
     * 获取 状态 1 等待执行 2 正在执行任务 3 执行完毕
     * @return int
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }
    
    /**
     * 设置 状态 1 等待执行 2 正在执行任务 3 执行完毕
     * @param int|null $status
     */
    public function setStatus(?int $status)
    {
        $this->status = $status;
    }
    
    /**
     * 效验 状态 1 等待执行 2 正在执行任务 3 执行完毕
     * @param string $msg
     * @throws Exception
     */
    public function validStatus(string $msg = 'status Cannot be empty!')
    {
        if(empty($this->status)) throw new Exception($msg);
    }
    
    /**
     * 获取 状态发生时间
     * @return mixed
     */
    public function getStatusTime()
    {
        return $this->status_time;
    }
    
    /**
     * 设置 状态发生时间
     * @param $status_time
     */
    public function setStatusTime($status_time)
    {
        $this->status_time = $status_time;
    }
    
    /**
     * 效验 状态发生时间
     * @param string $msg
     * @throws Exception
     */
    public function validStatusTime(string $msg = 'status_time Cannot be empty!')
    {
        if(empty($this->status_time)) throw new Exception($msg);
    }
    
    /**
     * 获取 备注
     * @return string
     */
    public function getRemark(): ?string
    {
        return $this->remark;
    }
    
    /**
     * 设置 备注
     * @param string|null $remark
     */
    public function setRemark(?string $remark)
    {
        $this->remark = $remark;
    }
    
    /**
     * 效验 备注
     * @param string $msg
     * @throws Exception
     */
    public function validRemark(string $msg = 'remark Cannot be empty!')
    {
        if(empty($this->remark)) throw new Exception($msg);
    }
    
    /**
     * 获取 是否删除
     * @return int
     */
    public function getIsDelete(): ?int
    {
        return $this->is_delete;
    }
    
    /**
     * 设置 是否删除
     * @param int|null $is_delete
     */
    public function setIsDelete(?int $is_delete)
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