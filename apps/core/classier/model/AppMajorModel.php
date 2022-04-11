<?php

namespace apps\core\classier\model;

use Exception;
use rapidPHP\modules\core\classier\Model;


/**
 * 专业表
 * @table app_major
 * rapidPHP auto generate Model 2022-04-11 11:39:18
 */

class AppMajorModel extends Model 
{

    /**
     * table name
     */
    const NAME = 'app_major';

    
    /**
     * 分类Id
     * @var 
     * @length 
     * @typed bigint
     */
    protected $id;

    /**
     * 设置 分类Id
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * 获取 分类Id
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * 效验 分类Id
     * @param string $msg
     * @throws Exception
     */
    public function validId(string $msg = 'id Cannot be empty!')
    {
        if (empty($this->id)) throw new Exception($msg);
    }

    /**
     * 父id
     * @var 
     * @length 
     * @typed bigint
     */
    protected $parent_id;

    /**
     * 设置 父id
     * @param $parent_id
     */
    public function setParentId($parent_id)
    {
        $this->parent_id = $parent_id;
    }

    /**
     * 获取 父id
     * @return mixed
     */
    public function getParentId()
    {
        return $this->parent_id;
    }

    /**
     * 效验 父id
     * @param string $msg
     * @throws Exception
     */
    public function validParentId(string $msg = 'parent_id Cannot be empty!')
    {
        if (empty($this->parent_id)) throw new Exception($msg);
    }

    /**
     * 专业名称
     * @var string|null 
     * @length 50
     * @typed varchar
     */
    protected $name;

    /**
     * 设置 专业名称
     * @param string|null $name
     */
    public function setName(?string $name)
    {
        $this->name = $name;
    }

    /**
     * 获取 专业名称
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * 效验 专业名称
     * @param string $msg
     * @throws Exception
     */
    public function validName(string $msg = 'name Cannot be empty!')
    {
        if (empty($this->name)) throw new Exception($msg);
    }

    /**
     * 等级
     * @var int|null 
     * @length 
     * @typed tinyint
     */
    protected $level;

    /**
     * 设置 等级
     * @param int|null $level
     */
    public function setLevel(?int $level)
    {
        $this->level = $level;
    }

    /**
     * 获取 等级
     * @return int|null
     */
    public function getLevel(): ?int
    {
        return $this->level;
    }

    /**
     * 效验 等级
     * @param string $msg
     * @throws Exception
     */
    public function validLevel(string $msg = 'level Cannot be empty!')
    {
        if (empty($this->level)) throw new Exception($msg);
    }

    /**
     * 课程数量
     * @var int|null 
     * @length 
     * @typed int
     */
    protected $course_count;

    /**
     * 设置 课程数量
     * @param int|null $course_count
     */
    public function setCourseCount(?int $course_count)
    {
        $this->course_count = $course_count;
    }

    /**
     * 获取 课程数量
     * @return int|null
     */
    public function getCourseCount(): ?int
    {
        return $this->course_count;
    }

    /**
     * 效验 课程数量
     * @param string $msg
     * @throws Exception
     */
    public function validCourseCount(string $msg = 'course_count Cannot be empty!')
    {
        if (empty($this->course_count)) throw new Exception($msg);
    }

    /**
     * 题库数量
     * @var int|null 
     * @length 
     * @typed int
     */
    protected $question_count;

    /**
     * 设置 题库数量
     * @param int|null $question_count
     */
    public function setQuestionCount(?int $question_count)
    {
        $this->question_count = $question_count;
    }

    /**
     * 获取 题库数量
     * @return int|null
     */
    public function getQuestionCount(): ?int
    {
        return $this->question_count;
    }

    /**
     * 效验 题库数量
     * @param string $msg
     * @throws Exception
     */
    public function validQuestionCount(string $msg = 'question_count Cannot be empty!')
    {
        if (empty($this->question_count)) throw new Exception($msg);
    }

    /**
     * options
     * @var 
     * @length 
     * @typed json
     */
    protected $options;

    /**
     * 设置 options
     * @param $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }

    /**
     * 获取 options
     * @return mixed
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * 效验 options
     * @param string $msg
     * @throws Exception
     */
    public function validOptions(string $msg = 'options Cannot be empty!')
    {
        if (empty($this->options)) throw new Exception($msg);
    }

    /**
     * 是否删除
     * @var int|null 
     * @length 
     * @typed tinyint
     */
    protected $is_delete;

    /**
     * 设置 是否删除
     * @param int|null $is_delete
     */
    public function setIsDelete(?int $is_delete)
    {
        $this->is_delete = $is_delete;
    }

    /**
     * 获取 是否删除
     * @return int|null
     */
    public function getIsDelete(): ?int
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
