<?php

namespace apps\core\classier\model;

use Exception;
use rapidPHP\modules\core\classier\Model;


/**
 * 通知表
 * @table app_notify
 * rapidPHP auto generate Model 2022-04-11 11:39:18
 */

class AppNotifyModel extends Model 
{

    /**
     * table name
     */
    const NAME = 'app_notify';

    
    /**
     * id
     * @var 
     * @length 
     * @typed bigint
     */
    protected $id;

    /**
     * 设置 id
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * 获取 id
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * 效验 id
     * @param string $msg
     * @throws Exception
     */
    public function validId(string $msg = 'id Cannot be empty!')
    {
        if (empty($this->id)) throw new Exception($msg);
    }

    /**
     * 标题
     * @var string|null 
     * @length 50
     * @typed varchar
     */
    protected $title;

    /**
     * 设置 标题
     * @param string|null $title
     */
    public function setTitle(?string $title)
    {
        $this->title = $title;
    }

    /**
     * 获取 标题
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * 效验 标题
     * @param string $msg
     * @throws Exception
     */
    public function validTitle(string $msg = 'title Cannot be empty!')
    {
        if (empty($this->title)) throw new Exception($msg);
    }

    /**
     * 内容简介
     * @var string|null 
     * @length 500
     * @typed varchar
     */
    protected $brief;

    /**
     * 设置 内容简介
     * @param string|null $brief
     */
    public function setBrief(?string $brief)
    {
        $this->brief = $brief;
    }

    /**
     * 获取 内容简介
     * @return string|null
     */
    public function getBrief(): ?string
    {
        return $this->brief;
    }

    /**
     * 效验 内容简介
     * @param string $msg
     * @throws Exception
     */
    public function validBrief(string $msg = 'brief Cannot be empty!')
    {
        if (empty($this->brief)) throw new Exception($msg);
    }

    /**
     * 内容
     * @var string|null 
     * @length 4294967295
     * @typed longtext
     */
    protected $content;

    /**
     * 设置 内容
     * @param string|null $content
     */
    public function setContent(?string $content)
    {
        $this->content = $content;
    }

    /**
     * 获取 内容
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * 效验 内容
     * @param string $msg
     * @throws Exception
     */
    public function validContent(string $msg = 'content Cannot be empty!')
    {
        if (empty($this->content)) throw new Exception($msg);
    }

    /**
     * 事件 
     * @var string|null 
     * @length 30
     * @typed char
     */
    protected $event;

    /**
     * 设置 事件 
     * @param string|null $event
     */
    public function setEvent(?string $event)
    {
        $this->event = $event;
    }

    /**
     * 获取 事件 
     * @return string|null
     */
    public function getEvent(): ?string
    {
        return $this->event;
    }

    /**
     * 效验 事件 
     * @param string $msg
     * @throws Exception
     */
    public function validEvent(string $msg = 'event Cannot be empty!')
    {
        if (empty($this->event)) throw new Exception($msg);
    }

    /**
     * 来源id
     * @var 
     * @length 
     * @typed bigint
     */
    protected $from_id;

    /**
     * 设置 来源id
     * @param $from_id
     */
    public function setFromId($from_id)
    {
        $this->from_id = $from_id;
    }

    /**
     * 获取 来源id
     * @return mixed
     */
    public function getFromId()
    {
        return $this->from_id;
    }

    /**
     * 效验 来源id
     * @param string $msg
     * @throws Exception
     */
    public function validFromId(string $msg = 'from_id Cannot be empty!')
    {
        if (empty($this->from_id)) throw new Exception($msg);
    }

    /**
     * 发送者类型 1系统 2 用户
     * @var int|null 
     * @length 
     * @typed tinyint
     */
    protected $sender_type;

    /**
     * 设置 发送者类型 1系统 2 用户
     * @param int|null $sender_type
     */
    public function setSenderType(?int $sender_type)
    {
        $this->sender_type = $sender_type;
    }

    /**
     * 获取 发送者类型 1系统 2 用户
     * @return int|null
     */
    public function getSenderType(): ?int
    {
        return $this->sender_type;
    }

    /**
     * 效验 发送者类型 1系统 2 用户
     * @param string $msg
     * @throws Exception
     */
    public function validSenderType(string $msg = 'sender_type Cannot be empty!')
    {
        if (empty($this->sender_type)) throw new Exception($msg);
    }

    /**
     * 发送者 id
     * @var 
     * @length 
     * @typed bigint
     */
    protected $sender_id;

    /**
     * 设置 发送者 id
     * @param $sender_id
     */
    public function setSenderId($sender_id)
    {
        $this->sender_id = $sender_id;
    }

    /**
     * 获取 发送者 id
     * @return mixed
     */
    public function getSenderId()
    {
        return $this->sender_id;
    }

    /**
     * 效验 发送者 id
     * @param string $msg
     * @throws Exception
     */
    public function validSenderId(string $msg = 'sender_id Cannot be empty!')
    {
        if (empty($this->sender_id)) throw new Exception($msg);
    }

    /**
     * 接收者id
     * @var 
     * @length 
     * @typed bigint
     */
    protected $receiver_id;

    /**
     * 设置 接收者id
     * @param $receiver_id
     */
    public function setReceiverId($receiver_id)
    {
        $this->receiver_id = $receiver_id;
    }

    /**
     * 获取 接收者id
     * @return mixed
     */
    public function getReceiverId()
    {
        return $this->receiver_id;
    }

    /**
     * 效验 接收者id
     * @param string $msg
     * @throws Exception
     */
    public function validReceiverId(string $msg = 'receiver_id Cannot be empty!')
    {
        if (empty($this->receiver_id)) throw new Exception($msg);
    }

    /**
     * 附加数据
     * @var 
     * @length 
     * @typed json
     */
    protected $options;

    /**
     * 设置 附加数据
     * @param $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }

    /**
     * 获取 附加数据
     * @return mixed
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * 效验 附加数据
     * @param string $msg
     * @throws Exception
     */
    public function validOptions(string $msg = 'options Cannot be empty!')
    {
        if (empty($this->options)) throw new Exception($msg);
    }

    /**
     * 通知时间
     * @var string|null 
     * @length 
     * @typed datetime
     */
    protected $notify_time;

    /**
     * 设置 通知时间
     * @param string|null $notify_time
     */
    public function setNotifyTime(?string $notify_time)
    {
        $this->notify_time = $notify_time;
    }

    /**
     * 获取 通知时间
     * @return string|null
     */
    public function getNotifyTime(): ?string
    {
        return $this->notify_time;
    }

    /**
     * 效验 通知时间
     * @param string $msg
     * @throws Exception
     */
    public function validNotifyTime(string $msg = 'notify_time Cannot be empty!')
    {
        if (empty($this->notify_time)) throw new Exception($msg);
    }

    /**
     * 是否已读
     * @var bool|null 
     * @length 
     * @typed bit
     */
    protected $is_read;

    /**
     * 设置 是否已读
     * @param bool|null $is_read
     */
    public function setIsRead(?bool $is_read)
    {
        $this->is_read = $is_read;
    }

    /**
     * 获取 是否已读
     * @return bool|null
     */
    public function getIsRead(): ?bool
    {
        return $this->is_read;
    }

    /**
     * 效验 是否已读
     * @param string $msg
     * @throws Exception
     */
    public function validIsRead(string $msg = 'is_read Cannot be empty!')
    {
        if (empty($this->is_read)) throw new Exception($msg);
    }

    /**
     * 最后读取时间，null 就没有读取
     * @var string|null 
     * @length 
     * @typed datetime
     */
    protected $last_rtime;

    /**
     * 设置 最后读取时间，null 就没有读取
     * @param string|null $last_rtime
     */
    public function setLastRtime(?string $last_rtime)
    {
        $this->last_rtime = $last_rtime;
    }

    /**
     * 获取 最后读取时间，null 就没有读取
     * @return string|null
     */
    public function getLastRtime(): ?string
    {
        return $this->last_rtime;
    }

    /**
     * 效验 最后读取时间，null 就没有读取
     * @param string $msg
     * @throws Exception
     */
    public function validLastRtime(string $msg = 'last_rtime Cannot be empty!')
    {
        if (empty($this->last_rtime)) throw new Exception($msg);
    }

}
