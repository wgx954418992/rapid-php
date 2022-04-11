<?php

namespace apps\core\classier\model;

use Exception;
use rapidPHP\modules\core\classier\Model;


/**
 * banner表
 * @table app_banner
 * rapidPHP auto generate Model 2022-04-11 11:39:17
 */

class AppBannerModel extends Model 
{

    /**
     * table name
     */
    const NAME = 'app_banner';

    
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
     * 标题
     * @var string|null 
     * @length 50
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
     * 图片文件Id
     * @var 
     * @length 
     * @typed bigint
     */
    protected $file_id;

    /**
     * 设置 图片文件Id
     * @param $file_id
     */
    public function setFileId($file_id)
    {
        $this->file_id = $file_id;
    }

    /**
     * 获取 图片文件Id
     * @return mixed
     */
    public function getFileId()
    {
        return $this->file_id;
    }

    /**
     * 效验 图片文件Id
     * @param string $msg
     * @throws Exception
     */
    public function validFileId(string $msg = 'file_id Cannot be empty!')
    {
        if (empty($this->file_id)) throw new Exception($msg);
    }

    /**
     * bind id
     * @var 
     * @length 
     * @typed bigint
     */
    protected $bind_id;

    /**
     * 设置 bind id
     * @param $bind_id
     */
    public function setBindId($bind_id)
    {
        $this->bind_id = $bind_id;
    }

    /**
     * 获取 bind id
     * @return mixed
     */
    public function getBindId()
    {
        return $this->bind_id;
    }

    /**
     * 效验 bind id
     * @param string $msg
     * @throws Exception
     */
    public function validBindId(string $msg = 'bind_id Cannot be empty!')
    {
        if (empty($this->bind_id)) throw new Exception($msg);
    }

    /**
     * 类型 1 App首页展示banner 
     * @var int|null 
     * @length 
     * @typed tinyint
     */
    protected $type;

    /**
     * 设置 类型 1 App首页展示banner 
     * @param int|null $type
     */
    public function setType(?int $type)
    {
        $this->type = $type;
    }

    /**
     * 获取 类型 1 App首页展示banner 
     * @return int|null
     */
    public function getType(): ?int
    {
        return $this->type;
    }

    /**
     * 效验 类型 1 App首页展示banner 
     * @param string $msg
     * @throws Exception
     */
    public function validType(string $msg = 'type Cannot be empty!')
    {
        if (empty($this->type)) throw new Exception($msg);
    }

    /**
     * 数据
     * @var 
     * @length 
     * @typed json
     */
    protected $options;

    /**
     * 设置 数据
     * @param $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }

    /**
     * 获取 数据
     * @return mixed
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * 效验 数据
     * @param string $msg
     * @throws Exception
     */
    public function validOptions(string $msg = 'options Cannot be empty!')
    {
        if (empty($this->options)) throw new Exception($msg);
    }

    /**
     * 排序
     * @var int|null 
     * @length 
     * @typed int
     */
    protected $rank;

    /**
     * 设置 排序
     * @param int|null $rank
     */
    public function setRank(?int $rank)
    {
        $this->rank = $rank;
    }

    /**
     * 获取 排序
     * @return int|null
     */
    public function getRank(): ?int
    {
        return $this->rank;
    }

    /**
     * 效验 排序
     * @param string $msg
     * @throws Exception
     */
    public function validRank(string $msg = 'rank Cannot be empty!')
    {
        if (empty($this->rank)) throw new Exception($msg);
    }

    /**
     * 是否删除
     * @var int|null 
     * @length 
     * @typed tinyint
     */
    protected $is_delete;

    /**
     * 设置 是否删除
     * @param int|null $is_delete
     */
    public function setIsDelete(?int $is_delete)
    {
        $this->is_delete = $is_delete;
    }

    /**
     * 获取 是否删除
     * @return int|null
     */
    public function getIsDelete(): ?int
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
