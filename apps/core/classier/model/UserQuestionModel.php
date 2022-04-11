<?php

namespace apps\core\classier\model;

use Exception;
use rapidPHP\modules\core\classier\Model;


/**
 * 用户题库表
 * @table user_question
 * rapidPHP auto generate Model 2022-04-11 11:39:20
 */

class UserQuestionModel extends Model 
{

    /**
     * table name
     */
    const NAME = 'user_question';

    
    /**
     * id
     * @var 
     * @length 
     * @typed bigint
     */
    protected $id;

    /**
     * 设置 id
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * 获取 id
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * 效验 id
     * @param string $msg
     * @throws Exception
     */
    public function validId(string $msg = 'id Cannot be empty!')
    {
        if (empty($this->id)) throw new Exception($msg);
    }

    /**
     * user id
     * @var 
     * @length 
     * @typed bigint
     */
    protected $user_id;

    /**
     * 设置 user id
     * @param $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * 获取 user id
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * 效验 user id
     * @param string $msg
     * @throws Exception
     */
    public function validUserId(string $msg = 'user_id Cannot be empty!')
    {
        if (empty($this->user_id)) throw new Exception($msg);
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
     * 题id
     * @var 
     * @length 
     * @typed bigint
     */
    protected $question_id;

    /**
     * 设置 题id
     * @param $question_id
     */
    public function setQuestionId($question_id)
    {
        $this->question_id = $question_id;
    }

    /**
     * 获取 题id
     * @return mixed
     */
    public function getQuestionId()
    {
        return $this->question_id;
    }

    /**
     * 效验 题id
     * @param string $msg
     * @throws Exception
     */
    public function validQuestionId(string $msg = 'question_id Cannot be empty!')
    {
        if (empty($this->question_id)) throw new Exception($msg);
    }

    /**
     * 结果 0跳过 1 答错 2 答对
     * @var int|null 
     * @length 
     * @typed tinyint
     */
    protected $result;

    /**
     * 设置 结果 0跳过 1 答错 2 答对
     * @param int|null $result
     */
    public function setResult(?int $result)
    {
        $this->result = $result;
    }

    /**
     * 获取 结果 0跳过 1 答错 2 答对
     * @return int|null
     */
    public function getResult(): ?int
    {
        return $this->result;
    }

    /**
     * 效验 结果 0跳过 1 答错 2 答对
     * @param string $msg
     * @throws Exception
     */
    public function validResult(string $msg = 'result Cannot be empty!')
    {
        if (empty($this->result)) throw new Exception($msg);
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
