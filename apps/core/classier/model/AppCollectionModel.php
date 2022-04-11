<?php

namespace apps\core\classier\model;

use Exception;
use rapidPHP\modules\core\classier\Model;


/**
 * 收藏表
 * @table app_collection
 * rapidPHP auto generate Model 2022-04-11 11:39:18
 */

class AppCollectionModel extends Model 
{

    /**
     * table name
     */
    const NAME = 'app_collection';

    
    /**
     * 收藏Id
     * @var 
     * @length 
     * @typed bigint
     */
    protected $id;

    /**
     * 设置 收藏Id
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * 获取 收藏Id
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * 效验 收藏Id
     * @param string $msg
     * @throws Exception
     */
    public function validId(string $msg = 'id Cannot be empty!')
    {
        if (empty($this->id)) throw new Exception($msg);
    }

    /**
     * 绑定id
     * @var 
     * @length 
     * @typed bigint
     */
    protected $bind_id;

    /**
     * 设置 绑定id
     * @param $bind_id
     */
    public function setBindId($bind_id)
    {
        $this->bind_id = $bind_id;
    }

    /**
     * 获取 绑定id
     * @return mixed
     */
    public function getBindId()
    {
        return $this->bind_id;
    }

    /**
     * 效验 绑定id
     * @param string $msg
     * @throws Exception
     */
    public function validBindId(string $msg = 'bind_id Cannot be empty!')
    {
        if (empty($this->bind_id)) throw new Exception($msg);
    }

    /**
     * 用户Id
     * @var 
     * @length 
     * @typed bigint
     */
    protected $user_id;

    /**
     * 设置 用户Id
     * @param $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * 获取 用户Id
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * 效验 用户Id
     * @param string $msg
     * @throws Exception
     */
    public function validUserId(string $msg = 'user_id Cannot be empty!')
    {
        if (empty($this->user_id)) throw new Exception($msg);
    }

    /**
     * 收藏类型（1课程，2题）
     * @var int|null 
     * @length 
     * @typed tinyint
     */
    protected $type;

    /**
     * 设置 收藏类型（1课程，2题）
     * @param int|null $type
     */
    public function setType(?int $type)
    {
        $this->type = $type;
    }

    /**
     * 获取 收藏类型（1课程，2题）
     * @return int|null
     */
    public function getType(): ?int
    {
        return $this->type;
    }

    /**
     * 效验 收藏类型（1课程，2题）
     * @param string $msg
     * @throws Exception
     */
    public function validType(string $msg = 'type Cannot be empty!')
    {
        if (empty($this->type)) throw new Exception($msg);
    }

    /**
     * 收藏时间
     * @var string|null 
     * @length 
     * @typed datetime
     */
    protected $add_time;

    /**
     * 设置 收藏时间
     * @param string|null $add_time
     */
    public function setAddTime(?string $add_time)
    {
        $this->add_time = $add_time;
    }

    /**
     * 获取 收藏时间
     * @return string|null
     */
    public function getAddTime(): ?string
    {
        return $this->add_time;
    }

    /**
     * 效验 收藏时间
     * @param string $msg
     * @throws Exception
     */
    public function validAddTime(string $msg = 'add_time Cannot be empty!')
    {
        if (empty($this->add_time)) throw new Exception($msg);
    }

}
