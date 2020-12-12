<?php

namespace apps\app\classier\model;

use Exception;
use rapidPHP\modules\core\classier\Model;

/**
 * 用户学校
 * @table user_school
 * rapidPHP auto generate Model 2020-12-13 00:03:18
 */
class UserSchoolModel extends Model
{
    
    /**
     * table name
     */
    const NAME = 'user_school';
        
    
    /**
     * 主键
     * @length 
     * @typed bigint
     */
    public $id;    
    
    /**
     * 用户id
     * @length 
     * @typed bigint
     */
    public $user_id;    
    
    /**
     * 学校id 前期资料不足，为null
     * @length 
     * @typed bigint
     */
    public $school_id;    
    
    /**
     * 学校名称
     * @length 50
     * @typed varchar
     */
    public $name;    
    
    /**
     * 入学时间
     * @length 
     * @typed datetime
     */
    public $in_time;    
    
    /**
     * 是否毕业
     * @length 
     * @typed bit
     */
    public $is_graduation;    
    
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
     * 获取 用户id
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }
    
    /**
     * 设置 用户id
     * @param $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }
    
    /**
     * 效验 用户id
     * @param string $msg
     * @throws Exception
     */
    public function validUserId(string $msg = 'user_id Cannot be empty!')
    {
        if(empty($this->user_id)) throw new Exception($msg);
    }
    
    /**
     * 获取 学校id 前期资料不足，为null
     * @return mixed
     */
    public function getSchoolId()
    {
        return $this->school_id;
    }
    
    /**
     * 设置 学校id 前期资料不足，为null
     * @param $school_id
     */
    public function setSchoolId($school_id)
    {
        $this->school_id = $school_id;
    }
    
    /**
     * 效验 学校id 前期资料不足，为null
     * @param string $msg
     * @throws Exception
     */
    public function validSchoolId(string $msg = 'school_id Cannot be empty!')
    {
        if(empty($this->school_id)) throw new Exception($msg);
    }
    
    /**
     * 获取 学校名称
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }
    
    /**
     * 设置 学校名称
     * @param string|null $name
     */
    public function setName(?string $name)
    {
        $this->name = $name;
    }
    
    /**
     * 效验 学校名称
     * @param string $msg
     * @throws Exception
     */
    public function validName(string $msg = 'name Cannot be empty!')
    {
        if(empty($this->name)) throw new Exception($msg);
    }
    
    /**
     * 获取 入学时间
     * @return string
     */
    public function getInTime(): ?string
    {
        return $this->in_time;
    }
    
    /**
     * 设置 入学时间
     * @param string|null $in_time
     */
    public function setInTime(?string $in_time)
    {
        $this->in_time = $in_time;
    }
    
    /**
     * 效验 入学时间
     * @param string $msg
     * @throws Exception
     */
    public function validInTime(string $msg = 'in_time Cannot be empty!')
    {
        if(empty($this->in_time)) throw new Exception($msg);
    }
    
    /**
     * 获取 是否毕业
     * @return bool
     */
    public function getIsGraduation(): ?bool
    {
        return $this->is_graduation;
    }
    
    /**
     * 设置 是否毕业
     * @param bool|null $is_graduation
     */
    public function setIsGraduation(?bool $is_graduation)
    {
        $this->is_graduation = $is_graduation;
    }
    
    /**
     * 效验 是否毕业
     * @param string $msg
     * @throws Exception
     */
    public function validIsGraduation(string $msg = 'is_graduation Cannot be empty!')
    {
        if(empty($this->is_graduation)) throw new Exception($msg);
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