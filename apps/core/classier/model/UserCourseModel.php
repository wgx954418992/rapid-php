<?php

namespace apps\core\classier\model;

use Exception;
use rapidPHP\modules\core\classier\Model;


/**
 * 用户课程表
 * @table user_course
 * rapidPHP auto generate Model 2022-04-11 11:39:20
 */

class UserCourseModel extends Model 
{

    /**
     * table name
     */
    const NAME = 'user_course';

    
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
     * 已刷题数量
     * @var int|null 
     * @length 
     * @typed int
     */
    protected $brushed_count;

    /**
     * 设置 已刷题数量
     * @param int|null $brushed_count
     */
    public function setBrushedCount(?int $brushed_count)
    {
        $this->brushed_count = $brushed_count;
    }

    /**
     * 获取 已刷题数量
     * @return int|null
     */
    public function getBrushedCount(): ?int
    {
        return $this->brushed_count;
    }

    /**
     * 效验 已刷题数量
     * @param string $msg
     * @throws Exception
     */
    public function validBrushedCount(string $msg = 'brushed_count Cannot be empty!')
    {
        if (empty($this->brushed_count)) throw new Exception($msg);
    }

    /**
     * 答对题数量
     * @var int|null 
     * @length 
     * @typed int
     */
    protected $right_count;

    /**
     * 设置 答对题数量
     * @param int|null $right_count
     */
    public function setRightCount(?int $right_count)
    {
        $this->right_count = $right_count;
    }

    /**
     * 获取 答对题数量
     * @return int|null
     */
    public function getRightCount(): ?int
    {
        return $this->right_count;
    }

    /**
     * 效验 答对题数量
     * @param string $msg
     * @throws Exception
     */
    public function validRightCount(string $msg = 'right_count Cannot be empty!')
    {
        if (empty($this->right_count)) throw new Exception($msg);
    }

    /**
     * 答错题数量
     * @var int|null 
     * @length 
     * @typed int
     */
    protected $error_count;

    /**
     * 设置 答错题数量
     * @param int|null $error_count
     */
    public function setErrorCount(?int $error_count)
    {
        $this->error_count = $error_count;
    }

    /**
     * 获取 答错题数量
     * @return int|null
     */
    public function getErrorCount(): ?int
    {
        return $this->error_count;
    }

    /**
     * 效验 答错题数量
     * @param string $msg
     * @throws Exception
     */
    public function validErrorCount(string $msg = 'error_count Cannot be empty!')
    {
        if (empty($this->error_count)) throw new Exception($msg);
    }

    /**
     * 跳过题数量
     * @var int|null 
     * @length 
     * @typed int
     */
    protected $skip_count;

    /**
     * 设置 跳过题数量
     * @param int|null $skip_count
     */
    public function setSkipCount(?int $skip_count)
    {
        $this->skip_count = $skip_count;
    }

    /**
     * 获取 跳过题数量
     * @return int|null
     */
    public function getSkipCount(): ?int
    {
        return $this->skip_count;
    }

    /**
     * 效验 跳过题数量
     * @param string $msg
     * @throws Exception
     */
    public function validSkipCount(string $msg = 'skip_count Cannot be empty!')
    {
        if (empty($this->skip_count)) throw new Exception($msg);
    }

    /**
     * 最后题id
     * @var 
     * @length 
     * @typed bigint
     */
    protected $last_qid;

    /**
     * 设置 最后题id
     * @param $last_qid
     */
    public function setLastQid($last_qid)
    {
        $this->last_qid = $last_qid;
    }

    /**
     * 获取 最后题id
     * @return mixed
     */
    public function getLastQid()
    {
        return $this->last_qid;
    }

    /**
     * 效验 最后题id
     * @param string $msg
     * @throws Exception
     */
    public function validLastQid(string $msg = 'last_qid Cannot be empty!')
    {
        if (empty($this->last_qid)) throw new Exception($msg);
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
