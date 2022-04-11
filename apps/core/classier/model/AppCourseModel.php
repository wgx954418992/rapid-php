<?php

namespace apps\core\classier\model;

use Exception;
use rapidPHP\modules\core\classier\Model;


/**
 * 课程表
 * @table app_course
 * rapidPHP auto generate Model 2022-04-11 11:39:18
 */

class AppCourseModel extends Model 
{

    /**
     * table name
     */
    const NAME = 'app_course';

    
    /**
     * 主键
     * @var 
     * @length 
     * @typed bigint
     */
    protected $id;

    /**
     * 设置 主键
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * 获取 主键
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * 效验 主键
     * @param string $msg
     * @throws Exception
     */
    public function validId(string $msg = 'id Cannot be empty!')
    {
        if (empty($this->id)) throw new Exception($msg);
    }

    /**
     * 专业id
     * @var 
     * @length 
     * @typed bigint
     */
    protected $major_id;

    /**
     * 设置 专业id
     * @param $major_id
     */
    public function setMajorId($major_id)
    {
        $this->major_id = $major_id;
    }

    /**
     * 获取 专业id
     * @return mixed
     */
    public function getMajorId()
    {
        return $this->major_id;
    }

    /**
     * 效验 专业id
     * @param string $msg
     * @throws Exception
     */
    public function validMajorId(string $msg = 'major_id Cannot be empty!')
    {
        if (empty($this->major_id)) throw new Exception($msg);
    }

    /**
     * 标题
     * @var string|null 
     * @length 255
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
     * 课程介绍
     * @var string|null 
     * @length 1024
     * @typed varchar
     */
    protected $desc;

    /**
     * 设置 课程介绍
     * @param string|null $desc
     */
    public function setDesc(?string $desc)
    {
        $this->desc = $desc;
    }

    /**
     * 获取 课程介绍
     * @return string|null
     */
    public function getDesc(): ?string
    {
        return $this->desc;
    }

    /**
     * 效验 课程介绍
     * @param string $msg
     * @throws Exception
     */
    public function validDesc(string $msg = 'desc Cannot be empty!')
    {
        if (empty($this->desc)) throw new Exception($msg);
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
     * 收藏数量
     * @var int|null 
     * @length 
     * @typed int
     */
    protected $collection_count;

    /**
     * 设置 收藏数量
     * @param int|null $collection_count
     */
    public function setCollectionCount(?int $collection_count)
    {
        $this->collection_count = $collection_count;
    }

    /**
     * 获取 收藏数量
     * @return int|null
     */
    public function getCollectionCount(): ?int
    {
        return $this->collection_count;
    }

    /**
     * 效验 收藏数量
     * @param string $msg
     * @throws Exception
     */
    public function validCollectionCount(string $msg = 'collection_count Cannot be empty!')
    {
        if (empty($this->collection_count)) throw new Exception($msg);
    }

    /**
     * tag
     * @var 
     * @length 
     * @typed json
     */
    protected $tag;

    /**
     * 设置 tag
     * @param $tag
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
    }

    /**
     * 获取 tag
     * @return mixed
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * 效验 tag
     * @param string $msg
     * @throws Exception
     */
    public function validTag(string $msg = 'tag Cannot be empty!')
    {
        if (empty($this->tag)) throw new Exception($msg);
    }

    /**
     * 状态 1审核通过
     * @var int|null 
     * @length 
     * @typed tinyint
     */
    protected $status;

    /**
     * 设置 状态 1审核通过
     * @param int|null $status
     */
    public function setStatus(?int $status)
    {
        $this->status = $status;
    }

    /**
     * 获取 状态 1审核通过
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * 效验 状态 1审核通过
     * @param string $msg
     * @throws Exception
     */
    public function validStatus(string $msg = 'status Cannot be empty!')
    {
        if (empty($this->status)) throw new Exception($msg);
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
