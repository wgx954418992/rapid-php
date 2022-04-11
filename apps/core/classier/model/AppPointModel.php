<?php

namespace apps\core\classier\model;

use Exception;
use rapidPHP\modules\core\classier\Model;


/**
 * 钱包或者其他积分点数表
 * @table app_point
 * rapidPHP auto generate Model 2022-04-11 11:39:19
 */

class AppPointModel extends Model 
{

    /**
     * table name
     */
    const NAME = 'app_point';

    
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
     * 绑定的用户Id或者其他标识符
     * @var 
     * @length 
     * @typed bigint
     */
    protected $bind_id;

    /**
     * 设置 绑定的用户Id或者其他标识符
     * @param $bind_id
     */
    public function setBindId($bind_id)
    {
        $this->bind_id = $bind_id;
    }

    /**
     * 获取 绑定的用户Id或者其他标识符
     * @return mixed
     */
    public function getBindId()
    {
        return $this->bind_id;
    }

    /**
     * 效验 绑定的用户Id或者其他标识符
     * @param string $msg
     * @throws Exception
     */
    public function validBindId(string $msg = 'bind_id Cannot be empty!')
    {
        if (empty($this->bind_id)) throw new Exception($msg);
    }

    /**
     * 点数
     * @var float|null 
     * @length 
     * @typed decimal
     */
    protected $number;

    /**
     * 设置 点数
     * @param float|null $number
     */
    public function setNumber(?float $number)
    {
        $this->number = $number;
    }

    /**
     * 获取 点数
     * @return float|null
     */
    public function getNumber(): ?float
    {
        return $this->number;
    }

    /**
     * 效验 点数
     * @param string $msg
     * @throws Exception
     */
    public function validNumber(string $msg = 'number Cannot be empty!')
    {
        if (empty($this->number)) throw new Exception($msg);
    }

    /**
     * 冻结点数
     * @var float|null 
     * @length 
     * @typed decimal
     */
    protected $frozen;

    /**
     * 设置 冻结点数
     * @param float|null $frozen
     */
    public function setFrozen(?float $frozen)
    {
        $this->frozen = $frozen;
    }

    /**
     * 获取 冻结点数
     * @return float|null
     */
    public function getFrozen(): ?float
    {
        return $this->frozen;
    }

    /**
     * 效验 冻结点数
     * @param string $msg
     * @throws Exception
     */
    public function validFrozen(string $msg = 'frozen Cannot be empty!')
    {
        if (empty($this->frozen)) throw new Exception($msg);
    }

    /**
     * 类型 1钱包余额 2 积分 3 贡献值
     * @var int|null 
     * @length 
     * @typed tinyint
     */
    protected $type;

    /**
     * 设置 类型 1钱包余额 2 积分 3 贡献值
     * @param int|null $type
     */
    public function setType(?int $type)
    {
        $this->type = $type;
    }

    /**
     * 获取 类型 1钱包余额 2 积分 3 贡献值
     * @return int|null
     */
    public function getType(): ?int
    {
        return $this->type;
    }

    /**
     * 效验 类型 1钱包余额 2 积分 3 贡献值
     * @param string $msg
     * @throws Exception
     */
    public function validType(string $msg = 'type Cannot be empty!')
    {
        if (empty($this->type)) throw new Exception($msg);
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
