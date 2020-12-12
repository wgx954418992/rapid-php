<?php

namespace apps\app\classier\model;

use Exception;
use rapidPHP\modules\core\classier\Model;

/**
 * 作品标记
 * @table work_sign
 * rapidPHP auto generate Model 2020-12-13 00:03:19
 */
class WorkSignModel extends Model
{
    
    /**
     * table name
     */
    const NAME = 'work_sign';
        
    
    /**
     * 主键
     * @length 
     * @typed bigint
     */
    public $id;    
    
    /**
     * 作品id
     * @length 
     * @typed bigint
     */
    public $work_id;    
    
    /**
     * 可以是 work 图片id 或者是work视频id
     * @length 
     * @typed bigint
     */
    public $bind_id;    
    
    /**
     * 类型 1 图片 2 视频
     * @length 
     * @typed tinyint
     */
    public $type;    
    
    /**
     * 标题
     * @length 255
     * @typed varchar
     */
    public $title;    
    
    /**
     * 坐标x 如果是视频则为NULL
     * @length 
     * @typed float
     */
    public $x;    
    
    /**
     * 坐标y 如果是视频则为NULL
     * @length 
     * @typed float
     */
    public $y;    
    
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
     * 获取 作品id
     * @return mixed
     */
    public function getWorkId()
    {
        return $this->work_id;
    }
    
    /**
     * 设置 作品id
     * @param $work_id
     */
    public function setWorkId($work_id)
    {
        $this->work_id = $work_id;
    }
    
    /**
     * 效验 作品id
     * @param string $msg
     * @throws Exception
     */
    public function validWorkId(string $msg = 'work_id Cannot be empty!')
    {
        if(empty($this->work_id)) throw new Exception($msg);
    }
    
    /**
     * 获取 可以是 work 图片id 或者是work视频id
     * @return mixed
     */
    public function getBindId()
    {
        return $this->bind_id;
    }
    
    /**
     * 设置 可以是 work 图片id 或者是work视频id
     * @param $bind_id
     */
    public function setBindId($bind_id)
    {
        $this->bind_id = $bind_id;
    }
    
    /**
     * 效验 可以是 work 图片id 或者是work视频id
     * @param string $msg
     * @throws Exception
     */
    public function validBindId(string $msg = 'bind_id Cannot be empty!')
    {
        if(empty($this->bind_id)) throw new Exception($msg);
    }
    
    /**
     * 获取 类型 1 图片 2 视频
     * @return int
     */
    public function getType(): ?int
    {
        return $this->type;
    }
    
    /**
     * 设置 类型 1 图片 2 视频
     * @param int|null $type
     */
    public function setType(?int $type)
    {
        $this->type = $type;
    }
    
    /**
     * 效验 类型 1 图片 2 视频
     * @param string $msg
     * @throws Exception
     */
    public function validType(string $msg = 'type Cannot be empty!')
    {
        if(empty($this->type)) throw new Exception($msg);
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
     * 获取 坐标x 如果是视频则为NULL
     * @return float
     */
    public function getX(): ?float
    {
        return $this->x;
    }
    
    /**
     * 设置 坐标x 如果是视频则为NULL
     * @param float|null $x
     */
    public function setX(?float $x)
    {
        $this->x = $x;
    }
    
    /**
     * 效验 坐标x 如果是视频则为NULL
     * @param string $msg
     * @throws Exception
     */
    public function validX(string $msg = 'x Cannot be empty!')
    {
        if(empty($this->x)) throw new Exception($msg);
    }
    
    /**
     * 获取 坐标y 如果是视频则为NULL
     * @return float
     */
    public function getY(): ?float
    {
        return $this->y;
    }
    
    /**
     * 设置 坐标y 如果是视频则为NULL
     * @param float|null $y
     */
    public function setY(?float $y)
    {
        $this->y = $y;
    }
    
    /**
     * 效验 坐标y 如果是视频则为NULL
     * @param string $msg
     * @throws Exception
     */
    public function validY(string $msg = 'y Cannot be empty!')
    {
        if(empty($this->y)) throw new Exception($msg);
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