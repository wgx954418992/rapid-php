<?php
namespace application\model;

use rapidPHP\library\AB;

/**
 * 系统任务表
 */
class AppLogModel extends AB
{
    /**
     * 数据库表结构
     * @var array
     */
    public static $table = [
        'name' => 'app_log',
        'comment' => '系统任务表',
        'column' => [
            'logId' => ['type' => 'bigint', 'length' => 0, 'comment' => '主键'],
            'msg' => ['type' => 'varchar', 'length' => 1024, 'comment' => '日志消息'],
            'context' => ['type' => 'varchar', 'length' => 1024, 'comment' => '数据'],
            'datetime' => ['type' => 'datetime', 'length' => 0, 'comment' => '时间'],
        ]
    ];

    /**
     * AppLogModel constructor.
     * @param array|null $data
     */
    public function __construct(array $data = null)
    {
        parent::__construct($data);
    }
    
    /**
     * 获取 主键
     * @return mixed
     */
    public function getLogId()
    {
        return $this->getValue('logId');
    }
    
    /**
     * 设置 主键
     * @param $logId
     * @return AppLogModel
     */
    public function setLogId($logId)
    {
        return $this->setValue('logId', $logId);
    }
    
    /**
     * 获取 日志消息
     * @return mixed
     */
    public function getMsg()
    {
        return $this->getValue('msg');
    }
    
    /**
     * 设置 日志消息
     * @param $msg
     * @return AppLogModel
     */
    public function setMsg($msg)
    {
        return $this->setValue('msg', $msg);
    }
    
    /**
     * 获取 数据
     * @return mixed
     */
    public function getContext()
    {
        return $this->getValue('context');
    }
    
    /**
     * 设置 数据
     * @param $context
     * @return AppLogModel
     */
    public function setContext($context)
    {
        return $this->setValue('context', $context);
    }
    
    /**
     * 获取 时间
     * @return mixed
     */
    public function getDatetime()
    {
        return $this->getValue('datetime');
    }
    
    /**
     * 设置 时间
     * @param $datetime
     * @return AppLogModel
     */
    public function setDatetime($datetime)
    {
        return $this->setValue('datetime', $datetime);
    }
}