<?php

namespace apps\core\classier\model;

use Exception;
use rapidPHP\modules\core\classier\Model;

/**
 * 验证码表
 * @table app_code
 * rapidPHP auto generate Model 2021-01-05 00:02:36
 */
class AppCodeModel extends Model
{
    
    /**
     * table name
     */
    const NAME = 'app_code';
        
    
    /**
     * code Id
     * @length 
     * @typed bigint
     */
    private $id;    
    
    /**
     * 模板Id
     * @length 21
     * @typed varchar
     */
    private $template_id;    
    
    /**
     * 手机号或者其他
     * @length 50
     * @typed varchar
     */
    private $bind_id;    
    
    /**
     * 验证码
     * @length 23
     * @typed varchar
     */
    private $code;    
    
    /**
     * 短信内容
     * @length 256
     * @typed varchar
     */
    private $content;    
    
    /**
     * 发送时间
     * @length 
     * @typed int
     */
    private $send_time;    
    
    /**
     * 效验时间
     * @length 
     * @typed int
     */
    private $check_time;    
    
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
     * 获取 code Id
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * 设置 code Id
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
    /**
     * 效验 code Id
     * @param string $msg
     * @throws Exception
     */
    public function validId(string $msg = 'id Cannot be empty!')
    {
        if(empty($this->id)) throw new Exception($msg);
    }
    
    /**
     * 获取 模板Id
     * @return string
     */
    public function getTemplateId(): ?string
    {
        return $this->template_id;
    }
    
    /**
     * 设置 模板Id
     * @param string|null $template_id
     */
    public function setTemplateId(?string $template_id)
    {
        $this->template_id = $template_id;
    }
    
    /**
     * 效验 模板Id
     * @param string $msg
     * @throws Exception
     */
    public function validTemplateId(string $msg = 'template_id Cannot be empty!')
    {
        if(empty($this->template_id)) throw new Exception($msg);
    }
    
    /**
     * 获取 手机号或者其他
     * @return string
     */
    public function getBindId(): ?string
    {
        return $this->bind_id;
    }
    
    /**
     * 设置 手机号或者其他
     * @param string|null $bind_id
     */
    public function setBindId(?string $bind_id)
    {
        $this->bind_id = $bind_id;
    }
    
    /**
     * 效验 手机号或者其他
     * @param string $msg
     * @throws Exception
     */
    public function validBindId(string $msg = 'bind_id Cannot be empty!')
    {
        if(empty($this->bind_id)) throw new Exception($msg);
    }
    
    /**
     * 获取 验证码
     * @return string
     */
    public function getCode(): ?string
    {
        return $this->code;
    }
    
    /**
     * 设置 验证码
     * @param string|null $code
     */
    public function setCode(?string $code)
    {
        $this->code = $code;
    }
    
    /**
     * 效验 验证码
     * @param string $msg
     * @throws Exception
     */
    public function validCode(string $msg = 'code Cannot be empty!')
    {
        if(empty($this->code)) throw new Exception($msg);
    }
    
    /**
     * 获取 短信内容
     * @return string
     */
    public function getContent(): ?string
    {
        return $this->content;
    }
    
    /**
     * 设置 短信内容
     * @param string|null $content
     */
    public function setContent(?string $content)
    {
        $this->content = $content;
    }
    
    /**
     * 效验 短信内容
     * @param string $msg
     * @throws Exception
     */
    public function validContent(string $msg = 'content Cannot be empty!')
    {
        if(empty($this->content)) throw new Exception($msg);
    }
    
    /**
     * 获取 发送时间
     * @return int
     */
    public function getSendTime(): ?int
    {
        return $this->send_time;
    }
    
    /**
     * 设置 发送时间
     * @param int|null $send_time
     */
    public function setSendTime(?int $send_time)
    {
        $this->send_time = $send_time;
    }
    
    /**
     * 效验 发送时间
     * @param string $msg
     * @throws Exception
     */
    public function validSendTime(string $msg = 'send_time Cannot be empty!')
    {
        if(empty($this->send_time)) throw new Exception($msg);
    }
    
    /**
     * 获取 效验时间
     * @return int
     */
    public function getCheckTime(): ?int
    {
        return $this->check_time;
    }
    
    /**
     * 设置 效验时间
     * @param int|null $check_time
     */
    public function setCheckTime(?int $check_time)
    {
        $this->check_time = $check_time;
    }
    
    /**
     * 效验 效验时间
     * @param string $msg
     * @throws Exception
     */
    public function validCheckTime(string $msg = 'check_time Cannot be empty!')
    {
        if(empty($this->check_time)) throw new Exception($msg);
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