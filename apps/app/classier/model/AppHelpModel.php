<?php

namespace apps\app\classier\model;

use Exception;
use rapidPHP\modules\core\classier\Model;

/**
 * 帮助表
 * @table app_help
 * rapidPHP auto generate Model 2020-12-13 00:03:16
 */
class AppHelpModel extends Model
{
    
    /**
     * table name
     */
    const NAME = 'app_help';
        
    
    /**
     * id
     * @length 32
     * @typed varchar
     */
    public $id;    
    
    /**
     * 帮助栏目名称
     * @length 50
     * @typed varchar
     */
    public $name;    
    
    /**
     * 排序
     * @length 
     * @typed int
     */
    public $rank;    
    
    /**
     * 类型，用于区分哪里展示
     * @length 20
     * @typed varchar
     */
    public $type;    
    
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
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }
    
    /**
     * 设置 id
     * @param string|null $id
     */
    public function setId(?string $id)
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
     * 获取 帮助栏目名称
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }
    
    /**
     * 设置 帮助栏目名称
     * @param string|null $name
     */
    public function setName(?string $name)
    {
        $this->name = $name;
    }
    
    /**
     * 效验 帮助栏目名称
     * @param string $msg
     * @throws Exception
     */
    public function validName(string $msg = 'name Cannot be empty!')
    {
        if(empty($this->name)) throw new Exception($msg);
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
     * 获取 类型，用于区分哪里展示
     * @return string
     */
    public function getType(): ?string
    {
        return $this->type;
    }
    
    /**
     * 设置 类型，用于区分哪里展示
     * @param string|null $type
     */
    public function setType(?string $type)
    {
        $this->type = $type;
    }
    
    /**
     * 效验 类型，用于区分哪里展示
     * @param string $msg
     * @throws Exception
     */
    public function validType(string $msg = 'type Cannot be empty!')
    {
        if(empty($this->type)) throw new Exception($msg);
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