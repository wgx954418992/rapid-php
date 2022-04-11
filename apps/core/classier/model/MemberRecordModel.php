<?php

namespace apps\core\classier\model;

use Exception;
use rapidPHP\modules\core\classier\Model;


/**
 * 用户会员记录表
 * @table member_record
 * rapidPHP auto generate Model 2022-04-11 11:39:20
 */

class MemberRecordModel extends Model 
{

    /**
     * table name
     */
    const NAME = 'member_record';

    
    /**
     * 会员记录id
     * @var 
     * @length 
     * @typed bigint
     */
    protected $id;

    /**
     * 设置 会员记录id
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * 获取 会员记录id
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * 效验 会员记录id
     * @param string $msg
     * @throws Exception
     */
    public function validId(string $msg = 'id Cannot be empty!')
    {
        if (empty($this->id)) throw new Exception($msg);
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
     * 会员订单Id
     * @var 
     * @length 
     * @typed bigint
     */
    protected $order_id;

    /**
     * 设置 会员订单Id
     * @param $order_id
     */
    public function setOrderId($order_id)
    {
        $this->order_id = $order_id;
    }

    /**
     * 获取 会员订单Id
     * @return mixed
     */
    public function getOrderId()
    {
        return $this->order_id;
    }

    /**
     * 效验 会员订单Id
     * @param string $msg
     * @throws Exception
     */
    public function validOrderId(string $msg = 'order_id Cannot be empty!')
    {
        if (empty($this->order_id)) throw new Exception($msg);
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
     * 会员id
     * @var 
     * @length 
     * @typed bigint
     */
    protected $member_id;

    /**
     * 设置 会员id
     * @param $member_id
     */
    public function setMemberId($member_id)
    {
        $this->member_id = $member_id;
    }

    /**
     * 获取 会员id
     * @return mixed
     */
    public function getMemberId()
    {
        return $this->member_id;
    }

    /**
     * 效验 会员id
     * @param string $msg
     * @throws Exception
     */
    public function validMemberId(string $msg = 'member_id Cannot be empty!')
    {
        if (empty($this->member_id)) throw new Exception($msg);
    }

    /**
     * 会员名称
     * @var string|null 
     * @length 50
     * @typed varchar
     */
    protected $name;

    /**
     * 设置 会员名称
     * @param string|null $name
     */
    public function setName(?string $name)
    {
        $this->name = $name;
    }

    /**
     * 获取 会员名称
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * 效验 会员名称
     * @param string $msg
     * @throws Exception
     */
    public function validName(string $msg = 'name Cannot be empty!')
    {
        if (empty($this->name)) throw new Exception($msg);
    }

    /**
     * 开通方式 1 充值开通，2后台开通
     * @var int|null 
     * @length 
     * @typed tinyint
     */
    protected $mode;

    /**
     * 设置 开通方式 1 充值开通，2后台开通
     * @param int|null $mode
     */
    public function setMode(?int $mode)
    {
        $this->mode = $mode;
    }

    /**
     * 获取 开通方式 1 充值开通，2后台开通
     * @return int|null
     */
    public function getMode(): ?int
    {
        return $this->mode;
    }

    /**
     * 效验 开通方式 1 充值开通，2后台开通
     * @param string $msg
     * @throws Exception
     */
    public function validMode(string $msg = 'mode Cannot be empty!')
    {
        if (empty($this->mode)) throw new Exception($msg);
    }

    /**
     * 开通时间
     * @var string|null 
     * @length 
     * @typed datetime
     */
    protected $open_time;

    /**
     * 设置 开通时间
     * @param string|null $open_time
     */
    public function setOpenTime(?string $open_time)
    {
        $this->open_time = $open_time;
    }

    /**
     * 获取 开通时间
     * @return string|null
     */
    public function getOpenTime(): ?string
    {
        return $this->open_time;
    }

    /**
     * 效验 开通时间
     * @param string $msg
     * @throws Exception
     */
    public function validOpenTime(string $msg = 'open_time Cannot be empty!')
    {
        if (empty($this->open_time)) throw new Exception($msg);
    }

    /**
     * 结束时间
     * @var string|null 
     * @length 
     * @typed datetime
     */
    protected $end_time;

    /**
     * 设置 结束时间
     * @param string|null $end_time
     */
    public function setEndTime(?string $end_time)
    {
        $this->end_time = $end_time;
    }

    /**
     * 获取 结束时间
     * @return string|null
     */
    public function getEndTime(): ?string
    {
        return $this->end_time;
    }

    /**
     * 效验 结束时间
     * @param string $msg
     * @throws Exception
     */
    public function validEndTime(string $msg = 'end_time Cannot be empty!')
    {
        if (empty($this->end_time)) throw new Exception($msg);
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
