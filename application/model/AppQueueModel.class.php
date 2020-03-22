<?php
namespace application\model;

use rapidPHP\library\AB;

/**
 * 消息队列表
 */
class AppQueueModel extends AB
{
    /**
     * 数据库表结构
     * @var array
     */
    public static $table = [
        'name' => 'app_queue',
        'comment' => '消息队列表',
        'column' => [
            'queueId' => ['type' => 'bigint', 'length' => 0, 'comment' => '队列Id'],
            'bindId' => ['type' => 'bigint', 'length' => 0, 'comment' => '跟队列所关联的主键Id(也可以是队列Id)用于取消队列'],
            'type' => ['type' => 'varchar', 'length' => 20, 'comment' => '类型'],
            'param' => ['type' => 'json', 'length' => 0, 'comment' => '参数'],
            'triggerTime' => ['type' => 'int', 'length' => 0, 'comment' => '触发时间'],
            'isExec' => ['type' => 'int', 'length' => 0, 'comment' => '是否执行'],
            'execTime' => ['type' => 'datetime', 'length' => 0, 'comment' => '执行时间'],
            'remark' => ['type' => 'varchar', 'length' => 50, 'comment' => '备注'],
            'isDelete' => ['type' => 'int', 'length' => 0, 'comment' => '是否删除'],
            'createdUserId' => ['type' => 'varchar', 'length' => 32, 'comment' => '创建人Id'],
            'createdTime' => ['type' => 'datetime', 'length' => 0, 'comment' => '创建时间'],
            'updatedUserId' => ['type' => 'varchar', 'length' => 32, 'comment' => '修改人Id'],
            'updatedTime' => ['type' => 'datetime', 'length' => 0, 'comment' => '修改时间'],
        ]
    ];

    /**
     * AppQueueModel constructor.
     * @param array|null $data
     */
    public function __construct(array $data = null)
    {
        parent::__construct($data);
    }
    
    /**
     * 获取 队列Id
     * @return mixed
     */
    public function getQueueId()
    {
        return $this->getValue('queueId');
    }
    
    /**
     * 设置 队列Id
     * @param $queueId
     * @return AppQueueModel
     */
    public function setQueueId($queueId)
    {
        return $this->setValue('queueId', $queueId);
    }
    
    /**
     * 获取 跟队列所关联的主键Id(也可以是队列Id)用于取消队列
     * @return mixed
     */
    public function getBindId()
    {
        return $this->getValue('bindId');
    }
    
    /**
     * 设置 跟队列所关联的主键Id(也可以是队列Id)用于取消队列
     * @param $bindId
     * @return AppQueueModel
     */
    public function setBindId($bindId)
    {
        return $this->setValue('bindId', $bindId);
    }
    
    /**
     * 获取 类型
     * @return mixed
     */
    public function getType()
    {
        return $this->getValue('type');
    }
    
    /**
     * 设置 类型
     * @param $type
     * @return AppQueueModel
     */
    public function setType($type)
    {
        return $this->setValue('type', $type);
    }
    
    /**
     * 获取 参数
     * @return array
     */
    public function getParam(): ?array
    {
        return $this->getValue('param');
    }
    
    /**
     * 设置 参数
     * @param array $param
     * @return AppQueueModel
     */
    public function setParam(?array $param)
    {
        return $this->setValue('param', $param);
    }
    
    /**
     * 获取 触发时间
     * @return int
     */
    public function getTriggerTime(): ?int
    {
        return $this->getValue('triggerTime');
    }
    
    /**
     * 设置 触发时间
     * @param int $triggerTime
     * @return AppQueueModel
     */
    public function setTriggerTime(?int $triggerTime)
    {
        return $this->setValue('triggerTime', $triggerTime);
    }
    
    /**
     * 获取 是否执行
     * @return int
     */
    public function getIsExec(): ?int
    {
        return $this->getValue('isExec');
    }
    
    /**
     * 设置 是否执行
     * @param int $isExec
     * @return AppQueueModel
     */
    public function setIsExec(?int $isExec)
    {
        return $this->setValue('isExec', $isExec);
    }
    
    /**
     * 获取 执行时间
     * @return mixed
     */
    public function getExecTime()
    {
        return $this->getValue('execTime');
    }
    
    /**
     * 设置 执行时间
     * @param $execTime
     * @return AppQueueModel
     */
    public function setExecTime($execTime)
    {
        return $this->setValue('execTime', $execTime);
    }
    
    /**
     * 获取 备注
     * @return mixed
     */
    public function getRemark()
    {
        return $this->getValue('remark');
    }
    
    /**
     * 设置 备注
     * @param $remark
     * @return AppQueueModel
     */
    public function setRemark($remark)
    {
        return $this->setValue('remark', $remark);
    }
    
    /**
     * 获取 是否删除
     * @return int
     */
    public function getIsDelete(): ?int
    {
        return $this->getValue('isDelete');
    }
    
    /**
     * 设置 是否删除
     * @param int $isDelete
     * @return AppQueueModel
     */
    public function setIsDelete(?int $isDelete)
    {
        return $this->setValue('isDelete', $isDelete);
    }
    
    /**
     * 获取 创建人Id
     * @return mixed
     */
    public function getCreatedUserId()
    {
        return $this->getValue('createdUserId');
    }
    
    /**
     * 设置 创建人Id
     * @param $createdUserId
     * @return AppQueueModel
     */
    public function setCreatedUserId($createdUserId)
    {
        return $this->setValue('createdUserId', $createdUserId);
    }
    
    /**
     * 获取 创建时间
     * @return mixed
     */
    public function getCreatedTime()
    {
        return $this->getValue('createdTime');
    }
    
    /**
     * 设置 创建时间
     * @param $createdTime
     * @return AppQueueModel
     */
    public function setCreatedTime($createdTime)
    {
        return $this->setValue('createdTime', $createdTime);
    }
    
    /**
     * 获取 修改人Id
     * @return mixed
     */
    public function getUpdatedUserId()
    {
        return $this->getValue('updatedUserId');
    }
    
    /**
     * 设置 修改人Id
     * @param $updatedUserId
     * @return AppQueueModel
     */
    public function setUpdatedUserId($updatedUserId)
    {
        return $this->setValue('updatedUserId', $updatedUserId);
    }
    
    /**
     * 获取 修改时间
     * @return mixed
     */
    public function getUpdatedTime()
    {
        return $this->getValue('updatedTime');
    }
    
    /**
     * 设置 修改时间
     * @param $updatedTime
     * @return AppQueueModel
     */
    public function setUpdatedTime($updatedTime)
    {
        return $this->setValue('updatedTime', $updatedTime);
    }
}