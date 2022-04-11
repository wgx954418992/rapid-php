<?php

namespace apps\core\classier\model;

use Exception;
use rapidPHP\modules\core\classier\Model;


/**
 * 系统日志表
 * @table app_log
 * rapidPHP auto generate Model 2022-04-11 11:39:18
 */

class AppLogModel extends Model 
{

    /**
     * table name
     */
    const NAME = 'app_log';

    
    /**
     * 主键
     * @var 
     * @length 
     * @typed bigint
     */
    protected $id;

    /**
     * 设置 主键
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * 获取 主键
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * 效验 主键
     * @param string $msg
     * @throws Exception
     */
    public function validId(string $msg = 'id Cannot be empty!')
    {
        if (empty($this->id)) throw new Exception($msg);
    }

    /**
     * 类型 1 运行日志 2 错误日志 3 操作日志 10 其他日志 
     * @var int|null 
     * @length 
     * @typed tinyint
     */
    protected $type;

    /**
     * 设置 类型 1 运行日志 2 错误日志 3 操作日志 10 其他日志 
     * @param int|null $type
     */
    public function setType(?int $type)
    {
        $this->type = $type;
    }

    /**
     * 获取 类型 1 运行日志 2 错误日志 3 操作日志 10 其他日志 
     * @return int|null
     */
    public function getType(): ?int
    {
        return $this->type;
    }

    /**
     * 效验 类型 1 运行日志 2 错误日志 3 操作日志 10 其他日志 
     * @param string $msg
     * @throws Exception
     */
    public function validType(string $msg = 'type Cannot be empty!')
    {
        if (empty($this->type)) throw new Exception($msg);
    }

    /**
     * bind id
     * @var 
     * @length 
     * @typed bigint
     */
    protected $bind_id;

    /**
     * 设置 bind id
     * @param $bind_id
     */
    public function setBindId($bind_id)
    {
        $this->bind_id = $bind_id;
    }

    /**
     * 获取 bind id
     * @return mixed
     */
    public function getBindId()
    {
        return $this->bind_id;
    }

    /**
     * 效验 bind id
     * @param string $msg
     * @throws Exception
     */
    public function validBindId(string $msg = 'bind_id Cannot be empty!')
    {
        if (empty($this->bind_id)) throw new Exception($msg);
    }

    /**
     * 日志消息
     * @var string|null 
     * @length 1024
     * @typed varchar
     */
    protected $msg;

    /**
     * 设置 日志消息
     * @param string|null $msg
     */
    public function setMsg(?string $msg)
    {
        $this->msg = $msg;
    }

    /**
     * 获取 日志消息
     * @return string|null
     */
    public function getMsg(): ?string
    {
        return $this->msg;
    }

    /**
     * 效验 日志消息
     * @param string $msg
     * @throws Exception
     */
    public function validMsg(string $msg = 'msg Cannot be empty!')
    {
        if (empty($this->msg)) throw new Exception($msg);
    }

    /**
     * 数据
     * @var string|null 
     * @length 4294967295
     * @typed longtext
     */
    protected $content;

    /**
     * 设置 数据
     * @param string|null $content
     */
    public function setContent(?string $content)
    {
        $this->content = $content;
    }

    /**
     * 获取 数据
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * 效验 数据
     * @param string $msg
     * @throws Exception
     */
    public function validContent(string $msg = 'content Cannot be empty!')
    {
        if (empty($this->content)) throw new Exception($msg);
    }

    /**
     * 时间
     * @var string|null 
     * @length 
     * @typed datetime
     */
    protected $add_time;

    /**
     * 设置 时间
     * @param string|null $add_time
     */
    public function setAddTime(?string $add_time)
    {
        $this->add_time = $add_time;
    }

    /**
     * 获取 时间
     * @return string|null
     */
    public function getAddTime(): ?string
    {
        return $this->add_time;
    }

    /**
     * 效验 时间
     * @param string $msg
     * @throws Exception
     */
    public function validAddTime(string $msg = 'add_time Cannot be empty!')
    {
        if (empty($this->add_time)) throw new Exception($msg);
    }

}
