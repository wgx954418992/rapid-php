<?php

namespace apps\core\classier\model;

use Exception;
use rapidPHP\modules\core\classier\Model;


/**
 * 帮助文章表
 * @table cms_article
 * rapidPHP auto generate Model 2022-04-11 11:39:20
 */

class CmsArticleModel extends Model 
{

    /**
     * table name
     */
    const NAME = 'cms_article';

    
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
     * 栏目id
     * @var 
     * @length 
     * @typed bigint
     */
    protected $column_id;

    /**
     * 设置 栏目id
     * @param $column_id
     */
    public function setColumnId($column_id)
    {
        $this->column_id = $column_id;
    }

    /**
     * 获取 栏目id
     * @return mixed
     */
    public function getColumnId()
    {
        return $this->column_id;
    }

    /**
     * 效验 栏目id
     * @param string $msg
     * @throws Exception
     */
    public function validColumnId(string $msg = 'column_id Cannot be empty!')
    {
        if (empty($this->column_id)) throw new Exception($msg);
    }

    /**
     * 标题
     * @var string|null 
     * @length 255
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
     * 内容
     * @var string|null 
     * @length 4294967295
     * @typed longtext
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
