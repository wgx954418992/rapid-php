<?php

namespace apps\core\classier\model;

use Exception;
use rapidPHP\modules\core\classier\Model;

/**
 * 文件表
 * @table app_file
 * rapidPHP auto generate Model 2021-01-25 21:19:26
 */
class AppFileModel extends Model
{
    
    /**
     * table name
     */
    const NAME = 'app_file';
        
    
    /**
     * 主键
     * @length 
     * @typed bigint
     */
    private $id;    
    
    /**
     * 文件名
     * @length 256
     * @typed varchar
     */
    private $name;    
    
    /**
     * 文件大小
     * @length 
     * @typed bigint
     */
    private $size;    
    
    /**
     * 文件sha1效验值
     * @length 32
     * @typed varchar
     */
    private $md5;    
    
    /**
     * 文件MIME
     * @length 20
     * @typed varchar
     */
    private $mime;    
    
    /**
     * 文件路径
     * @length 1024
     * @typed varchar
     */
    private $path;    
    
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
     * 获取 文件名
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }
    
    /**
     * 设置 文件名
     * @param string|null $name
     */
    public function setName(?string $name)
    {
        $this->name = $name;
    }
    
    /**
     * 效验 文件名
     * @param string $msg
     * @throws Exception
     */
    public function validName(string $msg = 'name Cannot be empty!')
    {
        if(empty($this->name)) throw new Exception($msg);
    }
    
    /**
     * 获取 文件大小
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }
    
    /**
     * 设置 文件大小
     * @param $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }
    
    /**
     * 效验 文件大小
     * @param string $msg
     * @throws Exception
     */
    public function validSize(string $msg = 'size Cannot be empty!')
    {
        if(empty($this->size)) throw new Exception($msg);
    }
    
    /**
     * 获取 文件sha1效验值
     * @return string
     */
    public function getMd5(): ?string
    {
        return $this->md5;
    }
    
    /**
     * 设置 文件sha1效验值
     * @param string|null $md5
     */
    public function setMd5(?string $md5)
    {
        $this->md5 = $md5;
    }
    
    /**
     * 效验 文件sha1效验值
     * @param string $msg
     * @throws Exception
     */
    public function validMd5(string $msg = 'md5 Cannot be empty!')
    {
        if(empty($this->md5)) throw new Exception($msg);
    }
    
    /**
     * 获取 文件MIME
     * @return string
     */
    public function getMime(): ?string
    {
        return $this->mime;
    }
    
    /**
     * 设置 文件MIME
     * @param string|null $mime
     */
    public function setMime(?string $mime)
    {
        $this->mime = $mime;
    }
    
    /**
     * 效验 文件MIME
     * @param string $msg
     * @throws Exception
     */
    public function validMime(string $msg = 'mime Cannot be empty!')
    {
        if(empty($this->mime)) throw new Exception($msg);
    }
    
    /**
     * 获取 文件路径
     * @return string
     */
    public function getPath(): ?string
    {
        return $this->path;
    }
    
    /**
     * 设置 文件路径
     * @param string|null $path
     */
    public function setPath(?string $path)
    {
        $this->path = $path;
    }
    
    /**
     * 效验 文件路径
     * @param string $msg
     * @throws Exception
     */
    public function validPath(string $msg = 'path Cannot be empty!')
    {
        if(empty($this->path)) throw new Exception($msg);
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