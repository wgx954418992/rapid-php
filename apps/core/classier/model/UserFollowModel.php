<?php

namespace apps\core\classier\model;

use Exception;
use rapidPHP\modules\core\classier\Model;


/**
 * 用户关注表
 * @table user_follow
 * rapidPHP auto generate Model 2022-04-11 11:39:20
 */

class UserFollowModel extends Model 
{

    /**
     * table name
     */
    const NAME = 'user_follow';

    
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
     * 用户id
     * @var 
     * @length 
     * @typed bigint
     */
    protected $from_id;

    /**
     * 设置 用户id
     * @param $from_id
     */
    public function setFromId($from_id)
    {
        $this->from_id = $from_id;
    }

    /**
     * 获取 用户id
     * @return mixed
     */
    public function getFromId()
    {
        return $this->from_id;
    }

    /**
     * 效验 用户id
     * @param string $msg
     * @throws Exception
     */
    public function validFromId(string $msg = 'from_id Cannot be empty!')
    {
        if (empty($this->from_id)) throw new Exception($msg);
    }

    /**
     * 关注的用户id
     * @var 
     * @length 
     * @typed bigint
     */
    protected $to_id;

    /**
     * 设置 关注的用户id
     * @param $to_id
     */
    public function setToId($to_id)
    {
        $this->to_id = $to_id;
    }

    /**
     * 获取 关注的用户id
     * @return mixed
     */
    public function getToId()
    {
        return $this->to_id;
    }

    /**
     * 效验 关注的用户id
     * @param string $msg
     * @throws Exception
     */
    public function validToId(string $msg = 'to_id Cannot be empty!')
    {
        if (empty($this->to_id)) throw new Exception($msg);
    }

    /**
     * 状态 1 申请中 2 已关注 3 拒绝关注
     * @var int|null 
     * @length 
     * @typed tinyint
     */
    protected $status;

    /**
     * 设置 状态 1 申请中 2 已关注 3 拒绝关注
     * @param int|null $status
     */
    public function setStatus(?int $status)
    {
        $this->status = $status;
    }

    /**
     * 获取 状态 1 申请中 2 已关注 3 拒绝关注
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * 效验 状态 1 申请中 2 已关注 3 拒绝关注
     * @param string $msg
     * @throws Exception
     */
    public function validStatus(string $msg = 'status Cannot be empty!')
    {
        if (empty($this->status)) throw new Exception($msg);
    }

    /**
     * 申请或者关注时间
     * @var string|null 
     * @length 
     * @typed datetime
     */
    protected $apply_time;

    /**
     * 设置 申请或者关注时间
     * @param string|null $apply_time
     */
    public function setApplyTime(?string $apply_time)
    {
        $this->apply_time = $apply_time;
    }

    /**
     * 获取 申请或者关注时间
     * @return string|null
     */
    public function getApplyTime(): ?string
    {
        return $this->apply_time;
    }

    /**
     * 效验 申请或者关注时间
     * @param string $msg
     * @throws Exception
     */
    public function validApplyTime(string $msg = 'apply_time Cannot be empty!')
    {
        if (empty($this->apply_time)) throw new Exception($msg);
    }

}
