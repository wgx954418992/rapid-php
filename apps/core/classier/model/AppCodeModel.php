<?php

namespace apps\core\classier\model;

use Exception;
use rapidPHP\modules\core\classier\Model;


/**
 * 验证码表
 * @table app_code
 * rapidPHP auto generate Model 2022-04-11 11:39:18
 */

class AppCodeModel extends Model 
{

    /**
     * table name
     */
    const NAME = 'app_code';

    
    /**
     * code Id
     * @var 
     * @length 
     * @typed bigint
     */
    protected $id;

    /**
     * 设置 code Id
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * 获取 code Id
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * 效验 code Id
     * @param string $msg
     * @throws Exception
     */
    public function validId(string $msg = 'id Cannot be empty!')
    {
        if (empty($this->id)) throw new Exception($msg);
    }

    /**
     * 模板Id
     * @var string|null 
     * @length 30
     * @typed varchar
     */
    protected $code_type;

    /**
     * 设置 模板Id
     * @param string|null $code_type
     */
    public function setCodeType(?string $code_type)
    {
        $this->code_type = $code_type;
    }

    /**
     * 获取 模板Id
     * @return string|null
     */
    public function getCodeType(): ?string
    {
        return $this->code_type;
    }

    /**
     * 效验 模板Id
     * @param string $msg
     * @throws Exception
     */
    public function validCodeType(string $msg = 'code_type Cannot be empty!')
    {
        if (empty($this->code_type)) throw new Exception($msg);
    }

    /**
     * 接收者 手机号码或者邮箱等
     * @var string|null 
     * @length 50
     * @typed varchar
     */
    protected $receiver;

    /**
     * 设置 接收者 手机号码或者邮箱等
     * @param string|null $receiver
     */
    public function setReceiver(?string $receiver)
    {
        $this->receiver = $receiver;
    }

    /**
     * 获取 接收者 手机号码或者邮箱等
     * @return string|null
     */
    public function getReceiver(): ?string
    {
        return $this->receiver;
    }

    /**
     * 效验 接收者 手机号码或者邮箱等
     * @param string $msg
     * @throws Exception
     */
    public function validReceiver(string $msg = 'receiver Cannot be empty!')
    {
        if (empty($this->receiver)) throw new Exception($msg);
    }

    /**
     * 验证码
     * @var string|null 
     * @length 23
     * @typed varchar
     */
    protected $code;

    /**
     * 设置 验证码
     * @param string|null $code
     */
    public function setCode(?string $code)
    {
        $this->code = $code;
    }

    /**
     * 获取 验证码
     * @return string|null
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * 效验 验证码
     * @param string $msg
     * @throws Exception
     */
    public function validCode(string $msg = 'code Cannot be empty!')
    {
        if (empty($this->code)) throw new Exception($msg);
    }

    /**
     * 短信内容
     * @var string|null 
     * @length 256
     * @typed varchar
     */
    protected $content;

    /**
     * 设置 短信内容
     * @param string|null $content
     */
    public function setContent(?string $content)
    {
        $this->content = $content;
    }

    /**
     * 获取 短信内容
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * 效验 短信内容
     * @param string $msg
     * @throws Exception
     */
    public function validContent(string $msg = 'content Cannot be empty!')
    {
        if (empty($this->content)) throw new Exception($msg);
    }

    /**
     * 发送类型 1 短信 2 邮件
     * @var int|null 
     * @length 
     * @typed tinyint
     */
    protected $send_type;

    /**
     * 设置 发送类型 1 短信 2 邮件
     * @param int|null $send_type
     */
    public function setSendType(?int $send_type)
    {
        $this->send_type = $send_type;
    }

    /**
     * 获取 发送类型 1 短信 2 邮件
     * @return int|null
     */
    public function getSendType(): ?int
    {
        return $this->send_type;
    }

    /**
     * 效验 发送类型 1 短信 2 邮件
     * @param string $msg
     * @throws Exception
     */
    public function validSendType(string $msg = 'send_type Cannot be empty!')
    {
        if (empty($this->send_type)) throw new Exception($msg);
    }

    /**
     * 发送时间
     * @var int|null 
     * @length 
     * @typed int
     */
    protected $send_time;

    /**
     * 设置 发送时间
     * @param int|null $send_time
     */
    public function setSendTime(?int $send_time)
    {
        $this->send_time = $send_time;
    }

    /**
     * 获取 发送时间
     * @return int|null
     */
    public function getSendTime(): ?int
    {
        return $this->send_time;
    }

    /**
     * 效验 发送时间
     * @param string $msg
     * @throws Exception
     */
    public function validSendTime(string $msg = 'send_time Cannot be empty!')
    {
        if (empty($this->send_time)) throw new Exception($msg);
    }

    /**
     * 效验时间
     * @var int|null 
     * @length 
     * @typed int
     */
    protected $check_time;

    /**
     * 设置 效验时间
     * @param int|null $check_time
     */
    public function setCheckTime(?int $check_time)
    {
        $this->check_time = $check_time;
    }

    /**
     * 获取 效验时间
     * @return int|null
     */
    public function getCheckTime(): ?int
    {
        return $this->check_time;
    }

    /**
     * 效验 效验时间
     * @param string $msg
     * @throws Exception
     */
    public function validCheckTime(string $msg = 'check_time Cannot be empty!')
    {
        if (empty($this->check_time)) throw new Exception($msg);
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
