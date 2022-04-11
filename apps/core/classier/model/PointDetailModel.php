<?php

namespace apps\core\classier\model;

use Exception;
use rapidPHP\modules\core\classier\Model;


/**
 * 余额或者其他积分点数表的明细表
 * @table point_detail
 * rapidPHP auto generate Model 2022-04-11 11:39:20
 */

class PointDetailModel extends Model 
{

    /**
     * table name
     */
    const NAME = 'point_detail';

    
    /**
     * 明细Id
     * @var 
     * @length 
     * @typed bigint
     */
    protected $id;

    /**
     * 设置 明细Id
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * 获取 明细Id
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * 效验 明细Id
     * @param string $msg
     * @throws Exception
     */
    public function validId(string $msg = 'id Cannot be empty!')
    {
        if (empty($this->id)) throw new Exception($msg);
    }

    /**
     * 点Id
     * @var 
     * @length 
     * @typed bigint
     */
    protected $point_id;

    /**
     * 设置 点Id
     * @param $point_id
     */
    public function setPointId($point_id)
    {
        $this->point_id = $point_id;
    }

    /**
     * 获取 点Id
     * @return mixed
     */
    public function getPointId()
    {
        return $this->point_id;
    }

    /**
     * 效验 点Id
     * @param string $msg
     * @throws Exception
     */
    public function validPointId(string $msg = 'point_id Cannot be empty!')
    {
        if (empty($this->point_id)) throw new Exception($msg);
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
     * 说明
     * @var string|null 
     * @length 255
     * @typed varchar
     */
    protected $describe;

    /**
     * 设置 说明
     * @param string|null $describe
     */
    public function setDescribe(?string $describe)
    {
        $this->describe = $describe;
    }

    /**
     * 获取 说明
     * @return string|null
     */
    public function getDescribe(): ?string
    {
        return $this->describe;
    }

    /**
     * 效验 说明
     * @param string $msg
     * @throws Exception
     */
    public function validDescribe(string $msg = 'describe Cannot be empty!')
    {
        if (empty($this->describe)) throw new Exception($msg);
    }

    /**
     * TAG
     * @var string|null 
     * @length 50
     * @typed varchar
     */
    protected $tag;

    /**
     * 设置 TAG
     * @param string|null $tag
     */
    public function setTag(?string $tag)
    {
        $this->tag = $tag;
    }

    /**
     * 获取 TAG
     * @return string|null
     */
    public function getTag(): ?string
    {
        return $this->tag;
    }

    /**
     * 效验 TAG
     * @param string $msg
     * @throws Exception
     */
    public function validTag(string $msg = 'tag Cannot be empty!')
    {
        if (empty($this->tag)) throw new Exception($msg);
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
