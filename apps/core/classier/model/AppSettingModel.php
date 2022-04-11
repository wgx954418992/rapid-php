<?php

namespace apps\core\classier\model;

use Exception;
use rapidPHP\modules\core\classier\Model;


/**
 * 系统设置表
 * @table app_setting
 * rapidPHP auto generate Model 2022-04-11 11:39:19
 */

class AppSettingModel extends Model 
{

    /**
     * table name
     */
    const NAME = 'app_setting';

    
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
     * 类型
     * @var string|null 
     * @length 50
     * @typed varchar
     */
    protected $type;

    /**
     * 设置 类型
     * @param string|null $type
     */
    public function setType(?string $type)
    {
        $this->type = $type;
    }

    /**
     * 获取 类型
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * 效验 类型
     * @param string $msg
     * @throws Exception
     */
    public function validType(string $msg = 'type Cannot be empty!')
    {
        if (empty($this->type)) throw new Exception($msg);
    }

    /**
     * 属性
     * @var string|null 
     * @length 50
     * @typed varchar
     */
    protected $attribute;

    /**
     * 设置 属性
     * @param string|null $attribute
     */
    public function setAttribute(?string $attribute)
    {
        $this->attribute = $attribute;
    }

    /**
     * 获取 属性
     * @return string|null
     */
    public function getAttribute(): ?string
    {
        return $this->attribute;
    }

    /**
     * 效验 属性
     * @param string $msg
     * @throws Exception
     */
    public function validAttribute(string $msg = 'attribute Cannot be empty!')
    {
        if (empty($this->attribute)) throw new Exception($msg);
    }

    /**
     * 内容
     * @var string|null 
     * @length 1024
     * @typed varchar
     */
    protected $content;

    /**
     * 设置 内容
     * @param string|null $content
     */
    public function setContent(?string $content)
    {
        $this->content = $content;
    }

    /**
     * 获取 内容
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * 效验 内容
     * @param string $msg
     * @throws Exception
     */
    public function validContent(string $msg = 'content Cannot be empty!')
    {
        if (empty($this->content)) throw new Exception($msg);
    }

    /**
     * 备注
     * @var string|null 
     * @length 50
     * @typed varchar
     */
    protected $remarks;

    /**
     * 设置 备注
     * @param string|null $remarks
     */
    public function setRemarks(?string $remarks)
    {
        $this->remarks = $remarks;
    }

    /**
     * 获取 备注
     * @return string|null
     */
    public function getRemarks(): ?string
    {
        return $this->remarks;
    }

    /**
     * 效验 备注
     * @param string $msg
     * @throws Exception
     */
    public function validRemarks(string $msg = 'remarks Cannot be empty!')
    {
        if (empty($this->remarks)) throw new Exception($msg);
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
