<?php

namespace apps\core\classier\model;

use Exception;
use rapidPHP\modules\core\classier\Model;


/**
 * 题库表
 * @table app_question
 * rapidPHP auto generate Model 2022-04-11 11:39:19
 */

class AppQuestionModel extends Model 
{

    /**
     * table name
     */
    const NAME = 'app_question';

    
    /**
     * 主键 index 先小后大写入原则
     * @var 
     * @length 
     * @typed bigint
     */
    protected $id;

    /**
     * 设置 主键 index 先小后大写入原则
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * 获取 主键 index 先小后大写入原则
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * 效验 主键 index 先小后大写入原则
     * @param string $msg
     * @throws Exception
     */
    public function validId(string $msg = 'id Cannot be empty!')
    {
        if (empty($this->id)) throw new Exception($msg);
    }

    /**
     * 课程id
     * @var 
     * @length 
     * @typed bigint
     */
    protected $course_id;

    /**
     * 设置 课程id
     * @param $course_id
     */
    public function setCourseId($course_id)
    {
        $this->course_id = $course_id;
    }

    /**
     * 获取 课程id
     * @return mixed
     */
    public function getCourseId()
    {
        return $this->course_id;
    }

    /**
     * 效验 课程id
     * @param string $msg
     * @throws Exception
     */
    public function validCourseId(string $msg = 'course_id Cannot be empty!')
    {
        if (empty($this->course_id)) throw new Exception($msg);
    }

    /**
     * 类型 1 判断题 2 选择题 3 问答题
     * @var int|null 
     * @length 
     * @typed tinyint
     */
    protected $type;

    /**
     * 设置 类型 1 判断题 2 选择题 3 问答题
     * @param int|null $type
     */
    public function setType(?int $type)
    {
        $this->type = $type;
    }

    /**
     * 获取 类型 1 判断题 2 选择题 3 问答题
     * @return int|null
     */
    public function getType(): ?int
    {
        return $this->type;
    }

    /**
     * 效验 类型 1 判断题 2 选择题 3 问答题
     * @param string $msg
     * @throws Exception
     */
    public function validType(string $msg = 'type Cannot be empty!')
    {
        if (empty($this->type)) throw new Exception($msg);
    }

    /**
     * 标题
     * @var string|null 
     * @length 1024
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
     * 封面文件id
     * @var 
     * @length 
     * @typed bigint
     */
    protected $cover_fid;

    /**
     * 设置 封面文件id
     * @param $cover_fid
     */
    public function setCoverFid($cover_fid)
    {
        $this->cover_fid = $cover_fid;
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
     * 效验 封面文件id
     * @param string $msg
     * @throws Exception
     */
    public function validCoverFid(string $msg = 'cover_fid Cannot be empty!')
    {
        if (empty($this->cover_fid)) throw new Exception($msg);
    }

    /**
     * 问答题答案
     * @var string|null 
     * @length 1024
     * @typed varchar
     */
    protected $qa_answer;

    /**
     * 设置 问答题答案
     * @param string|null $qa_answer
     */
    public function setQaAnswer(?string $qa_answer)
    {
        $this->qa_answer = $qa_answer;
    }

    /**
     * 获取 问答题答案
     * @return string|null
     */
    public function getQaAnswer(): ?string
    {
        return $this->qa_answer;
    }

    /**
     * 效验 问答题答案
     * @param string $msg
     * @throws Exception
     */
    public function validQaAnswer(string $msg = 'qa_answer Cannot be empty!')
    {
        if (empty($this->qa_answer)) throw new Exception($msg);
    }

    /**
     * 解析
     * @var string|null 
     * @length 4294967295
     * @typed longtext
     */
    protected $tips;

    /**
     * 设置 解析
     * @param string|null $tips
     */
    public function setTips(?string $tips)
    {
        $this->tips = $tips;
    }

    /**
     * 获取 解析
     * @return string|null
     */
    public function getTips(): ?string
    {
        return $this->tips;
    }

    /**
     * 效验 解析
     * @param string $msg
     * @throws Exception
     */
    public function validTips(string $msg = 'tips Cannot be empty!')
    {
        if (empty($this->tips)) throw new Exception($msg);
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
