<?php

namespace apps\app\classier\model;

use Exception;
use rapidPHP\modules\core\classier\Model;

/**
 * 作品视频
 * @table work_video
 * rapidPHP auto generate Model 2020-12-13 00:03:19
 */
class WorkVideoModel extends Model
{
    
    /**
     * table name
     */
    const NAME = 'work_video';
        
    
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
     * 文件id
     * @length 
     * @typed bigint
     */
    public $file_id;    
    
    /**
     * 封面文件id
     * @length 
     * @typed bigint
     */
    public $cover_fid;    
    
    /**
     * 总时长
     * @length 
     * @typed int
     */
    public $duration;    
    
    /**
     * 排序
     * @length 
     * @typed int
     */
    public $rank;    
    
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
     * 获取 文件id
     * @return mixed
     */
    public function getFileId()
    {
        return $this->file_id;
    }
    
    /**
     * 设置 文件id
     * @param $file_id
     */
    public function setFileId($file_id)
    {
        $this->file_id = $file_id;
    }
    
    /**
     * 效验 文件id
     * @param string $msg
     * @throws Exception
     */
    public function validFileId(string $msg = 'file_id Cannot be empty!')
    {
        if(empty($this->file_id)) throw new Exception($msg);
    }
    
    /**
     * 获取 封面文件id
     * @return mixed
     */
    public function getCoverFid()
    {
        return $this->cover_fid;
    }
    
    /**
     * 设置 封面文件id
     * @param $cover_fid
     */
    public function setCoverFid($cover_fid)
    {
        $this->cover_fid = $cover_fid;
    }
    
    /**
     * 效验 封面文件id
     * @param string $msg
     * @throws Exception
     */
    public function validCoverFid(string $msg = 'cover_fid Cannot be empty!')
    {
        if(empty($this->cover_fid)) throw new Exception($msg);
    }
    
    /**
     * 获取 总时长
     * @return int
     */
    public function getDuration(): ?int
    {
        return $this->duration;
    }
    
    /**
     * 设置 总时长
     * @param int|null $duration
     */
    public function setDuration(?int $duration)
    {
        $this->duration = $duration;
    }
    
    /**
     * 效验 总时长
     * @param string $msg
     * @throws Exception
     */
    public function validDuration(string $msg = 'duration Cannot be empty!')
    {
        if(empty($this->duration)) throw new Exception($msg);
    }
    
    /**
     * 获取 排序
     * @return int
     */
    public function getRank(): ?int
    {
        return $this->rank;
    }
    
    /**
     * 设置 排序
     * @param int|null $rank
     */
    public function setRank(?int $rank)
    {
        $this->rank = $rank;
    }
    
    /**
     * 效验 排序
     * @param string $msg
     * @throws Exception
     */
    public function validRank(string $msg = 'rank Cannot be empty!')
    {
        if(empty($this->rank)) throw new Exception($msg);
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