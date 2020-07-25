<?php

namespace application\model;

use rapidPHP\library\AB;

/**
 * 消息队列表
 * @table app_queue
 */
class AppQueueModel extends AB
{
        
    
    /**
     * 队列Id
     * @length 0
     * @typed bigint
     */
    public $id;    
    
    /**
     * 队列消息父Id
     * @length 0
     * @typed bigint
     */
    public $parent_id;    
    
    /**
     * 跟队列所关联的主键Id，用于取消队列
     * @length 0
     * @typed bigint
     */
    public $bind_id;    
    
    /**
     * 类型
     * @length 32
     * @typed varchar
     */
    public $type;    
    
    /**
     * 参数
     * @length 0
     * @typed json
     */
    public $param;    
    
    /**
     * 触发时间
     * @length 0
     * @typed int
     */
    public $trigger_time;    
    
    /**
     * 状态 1 等待执行 2 正在执行任务 3 执行完毕
     * @length 0
     * @typed tinyint
     */
    public $status;    
    
    /**
     * 状态发生时间
     * @length 0
     * @typed int
     */
    public $status_time;    
    
    /**
     * 备注
     * @length 50
     * @typed varchar
     */
    public $remark;    
    
    /**
     * 是否删除
     * @length 0
     * @typed tinyint
     */
    public $is_delete;    
    
    /**
     * 创建人Id
     * @length 0
     * @typed bigint
     */
    public $created_id;    
    
    /**
     * 创建时间
     * @length 0
     * @typed datetime
     */
    public $created_time;    
    
    /**
     * 修改人Id
     * @length 0
     * @typed bigint
     */
    public $updated_id;    
    
    /**
     * 修改时间
     * @length 0
     * @typed datetime
     */
    public $updated_time;    
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
     * @return AppQueueModel
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
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
     * @return AppQueueModel
     */
    public function setParentId($parent_id)
    {
        $this->parent_id = $parent_id;
        return $this;
    }
    
    /**
     * 获取 跟队列所关联的主键Id，用于取消队列
     * @return mixed
     */
    public function getBindId()
    {
        return $this->bind_id;
    }
    
    /**
     * 设置 跟队列所关联的主键Id，用于取消队列
     * @param $bind_id
     * @return AppQueueModel
     */
    public function setBindId($bind_id)
    {
        $this->bind_id = $bind_id;
        return $this;
    }
    
    /**
     * 获取 类型
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }
    
    /**
     * 设置 类型
     * @param $type
     * @return AppQueueModel
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
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
     * @return AppQueueModel
     */
    public function setParam($param)
    {
        $this->param = $param;
        return $this;
    }
    
    /**
     * 获取 触发时间
     * @return int
     */
    public function getTriggerTime(): ?int
    {
        return $this->trigger_time;
    }
    
    /**
     * 设置 触发时间
     * @param int $trigger_time
     * @return AppQueueModel
     */
    public function setTriggerTime(?int $trigger_time)
    {
        $this->trigger_time = $trigger_time;
        return $this;
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
     * @param int $status
     * @return AppQueueModel
     */
    public function setStatus(?int $status)
    {
        $this->status = $status;
        return $this;
    }
    
    /**
     * 获取 状态发生时间
     * @return int
     */
    public function getStatusTime(): ?int
    {
        return $this->status_time;
    }
    
    /**
     * 设置 状态发生时间
     * @param int $status_time
     * @return AppQueueModel
     */
    public function setStatusTime(?int $status_time)
    {
        $this->status_time = $status_time;
        return $this;
    }
    
    /**
     * 获取 备注
     * @return mixed
     */
    public function getRemark()
    {
        return $this->remark;
    }
    
    /**
     * 设置 备注
     * @param $remark
     * @return AppQueueModel
     */
    public function setRemark($remark)
    {
        $this->remark = $remark;
        return $this;
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
     * @param int $is_delete
     * @return AppQueueModel
     */
    public function setIsDelete(?int $is_delete)
    {
        $this->is_delete = $is_delete;
        return $this;
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
     * @return AppQueueModel
     */
    public function setCreatedId($created_id)
    {
        $this->created_id = $created_id;
        return $this;
    }
    
    /**
     * 获取 创建时间
     * @return mixed
     */
    public function getCreatedTime()
    {
        return $this->created_time;
    }
    
    /**
     * 设置 创建时间
     * @param $created_time
     * @return AppQueueModel
     */
    public function setCreatedTime($created_time)
    {
        $this->created_time = $created_time;
        return $this;
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
     * @return AppQueueModel
     */
    public function setUpdatedId($updated_id)
    {
        $this->updated_id = $updated_id;
        return $this;
    }
    
    /**
     * 获取 修改时间
     * @return mixed
     */
    public function getUpdatedTime()
    {
        return $this->updated_time;
    }
    
    /**
     * 设置 修改时间
     * @param $updated_time
     * @return AppQueueModel
     */
    public function setUpdatedTime($updated_time)
    {
        $this->updated_time = $updated_time;
        return $this;
    }
}