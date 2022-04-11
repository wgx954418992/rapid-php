<?php

namespace apps\core\classier\model;

use Exception;
use rapidPHP\modules\core\classier\Model;


/**
 * 会员收费表
 * @table app_member
 * rapidPHP auto generate Model 2022-04-11 11:39:18
 */

class AppMemberModel extends Model 
{

    /**
     * table name
     */
    const NAME = 'app_member';

    
    /**
     * 日志Id
     * @var 
     * @length 
     * @typed bigint
     */
    protected $id;

    /**
     * 设置 日志Id
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * 获取 日志Id
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * 效验 日志Id
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
     * 标题
     * @var string|null 
     * @length 100
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
     * 介绍
     * @var string|null 
     * @length 200
     * @typed varchar
     */
    protected $desc;

    /**
     * 设置 介绍
     * @param string|null $desc
     */
    public function setDesc(?string $desc)
    {
        $this->desc = $desc;
    }

    /**
     * 获取 介绍
     * @return string|null
     */
    public function getDesc(): ?string
    {
        return $this->desc;
    }

    /**
     * 效验 介绍
     * @param string $msg
     * @throws Exception
     */
    public function validDesc(string $msg = 'desc Cannot be empty!')
    {
        if (empty($this->desc)) throw new Exception($msg);
    }

    /**
     * 现价
     * @var float|null 
     * @length 
     * @typed decimal
     */
    protected $amount;

    /**
     * 设置 现价
     * @param float|null $amount
     */
    public function setAmount(?float $amount)
    {
        $this->amount = $amount;
    }

    /**
     * 获取 现价
     * @return float|null
     */
    public function getAmount(): ?float
    {
        return $this->amount;
    }

    /**
     * 效验 现价
     * @param string $msg
     * @throws Exception
     */
    public function validAmount(string $msg = 'amount Cannot be empty!')
    {
        if (empty($this->amount)) throw new Exception($msg);
    }

    /**
     * 原价
     * @var float|null 
     * @length 
     * @typed decimal
     */
    protected $original_price;

    /**
     * 设置 原价
     * @param float|null $original_price
     */
    public function setOriginalPrice(?float $original_price)
    {
        $this->original_price = $original_price;
    }

    /**
     * 获取 原价
     * @return float|null
     */
    public function getOriginalPrice(): ?float
    {
        return $this->original_price;
    }

    /**
     * 效验 原价
     * @param string $msg
     * @throws Exception
     */
    public function validOriginalPrice(string $msg = 'original_price Cannot be empty!')
    {
        if (empty($this->original_price)) throw new Exception($msg);
    }

    /**
     * 有效期（秒）
     * @var int|null 
     * @length 
     * @typed int
     */
    protected $valid_time;

    /**
     * 设置 有效期（秒）
     * @param int|null $valid_time
     */
    public function setValidTime(?int $valid_time)
    {
        $this->valid_time = $valid_time;
    }

    /**
     * 获取 有效期（秒）
     * @return int|null
     */
    public function getValidTime(): ?int
    {
        return $this->valid_time;
    }

    /**
     * 效验 有效期（秒）
     * @param string $msg
     * @throws Exception
     */
    public function validValidTime(string $msg = 'valid_time Cannot be empty!')
    {
        if (empty($this->valid_time)) throw new Exception($msg);
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
