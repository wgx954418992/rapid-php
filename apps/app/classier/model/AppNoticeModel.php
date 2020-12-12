<?php

namespace apps\app\classier\model;

use Exception;
use rapidPHP\modules\core\classier\Model;

/**
 * 通知表
 * @table app_notice
 * rapidPHP auto generate Model 2020-12-13 00:03:17
 */
class AppNoticeModel extends Model
{
    
    /**
     * table name
     */
    const NAME = 'app_notice';
        
    
    /**
     * id
     * @length 
     * @typed bigint
     */
    public $id;    
    
    /**
     * 标题
     * @length 50
     * @typed varchar
     */
    public $title;    
    
    /**
     * 图片文件id
     * @length 
     * @typed bigint
     */
    public $img_fid;    
    
    /**
     * 类型 1 关注请求，2 共享相册
     * @length 
     * @typed tinyint
     */
    public $type;    
    
    /**
     * 接收对象 1 全部 2 指定用户
     * @length 
     * @typed tinyint
     */
    public $recipient;    
    
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
     * 获取 id
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * 设置 id
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
    /**
     * 效验 id
     * @param string $msg
     * @throws Exception
     */
    public function validId(string $msg = 'id Cannot be empty!')
    {
        if(empty($this->id)) throw new Exception($msg);
    }
    
    /**
     * 获取 标题
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }
    
    /**
     * 设置 标题
     * @param string|null $title
     */
    public function setTitle(?string $title)
    {
        $this->title = $title;
    }
    
    /**
     * 效验 标题
     * @param string $msg
     * @throws Exception
     */
    public function validTitle(string $msg = 'title Cannot be empty!')
    {
        if(empty($this->title)) throw new Exception($msg);
    }
    
    /**
     * 获取 图片文件id
     * @return mixed
     */
    public function getImgFid()
    {
        return $this->img_fid;
    }
    
    /**
     * 设置 图片文件id
     * @param $img_fid
     */
    public function setImgFid($img_fid)
    {
        $this->img_fid = $img_fid;
    }
    
    /**
     * 效验 图片文件id
     * @param string $msg
     * @throws Exception
     */
    public function validImgFid(string $msg = 'img_fid Cannot be empty!')
    {
        if(empty($this->img_fid)) throw new Exception($msg);
    }
    
    /**
     * 获取 类型 1 关注请求，2 共享相册
     * @return int
     */
    public function getType(): ?int
    {
        return $this->type;
    }
    
    /**
     * 设置 类型 1 关注请求，2 共享相册
     * @param int|null $type
     */
    public function setType(?int $type)
    {
        $this->type = $type;
    }
    
    /**
     * 效验 类型 1 关注请求，2 共享相册
     * @param string $msg
     * @throws Exception
     */
    public function validType(string $msg = 'type Cannot be empty!')
    {
        if(empty($this->type)) throw new Exception($msg);
    }
    
    /**
     * 获取 接收对象 1 全部 2 指定用户
     * @return int
     */
    public function getRecipient(): ?int
    {
        return $this->recipient;
    }
    
    /**
     * 设置 接收对象 1 全部 2 指定用户
     * @param int|null $recipient
     */
    public function setRecipient(?int $recipient)
    {
        $this->recipient = $recipient;
    }
    
    /**
     * 效验 接收对象 1 全部 2 指定用户
     * @param string $msg
     * @throws Exception
     */
    public function validRecipient(string $msg = 'recipient Cannot be empty!')
    {
        if(empty($this->recipient)) throw new Exception($msg);
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