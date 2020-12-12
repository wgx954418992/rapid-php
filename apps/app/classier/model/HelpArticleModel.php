<?php

namespace apps\app\classier\model;

use Exception;
use rapidPHP\modules\core\classier\Model;

/**
 * 帮助文章表
 * @table help_article
 * rapidPHP auto generate Model 2020-12-13 00:03:18
 */
class HelpArticleModel extends Model
{
    
    /**
     * table name
     */
    const NAME = 'help_article';
        
    
    /**
     * id
     * @length 32
     * @typed varchar
     */
    public $id;    
    
    /**
     * 帮助栏目id
     * @length 32
     * @typed varchar
     */
    public $help_id;    
    
    /**
     * 标题
     * @length 50
     * @typed varchar
     */
    public $title;    
    
    /**
     * 内容
     * @length 4294967295
     * @typed longtext
     */
    public $content;    
    
    /**
     * 排序
     * @length 
     * @typed int
     */
    public $rank;    
    
    /**
     * 是否删除
     * @length 
     * @typed bit
     */
    public $is_delete;    
    
    /**
     * 创建人Id
     * @length 
     * @typed bigint
     */
    public $created_id;    
    
    /**
     * 创建时间
     * @length 
     * @typed datetime
     */
    public $created_time;    
    
    /**
     * 修改人Id
     * @length 
     * @typed bigint
     */
    public $updated_id;    
    
    /**
     * 修改时间
     * @length 
     * @typed datetime
     */
    public $updated_time;    
    /**
     * 获取 id
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }
    
    /**
     * 设置 id
     * @param string|null $id
     */
    public function setId(?string $id)
    {
        $this->id = $id;
    }
    
    /**
     * 效验 id
     * @param string $msg
     * @throws Exception
     */
    public function validId(string $msg = 'id Cannot be empty!')
    {
        if(empty($this->id)) throw new Exception($msg);
    }
    
    /**
     * 获取 帮助栏目id
     * @return string
     */
    public function getHelpId(): ?string
    {
        return $this->help_id;
    }
    
    /**
     * 设置 帮助栏目id
     * @param string|null $help_id
     */
    public function setHelpId(?string $help_id)
    {
        $this->help_id = $help_id;
    }
    
    /**
     * 效验 帮助栏目id
     * @param string $msg
     * @throws Exception
     */
    public function validHelpId(string $msg = 'help_id Cannot be empty!')
    {
        if(empty($this->help_id)) throw new Exception($msg);
    }
    
    /**
     * 获取 标题
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }
    
    /**
     * 设置 标题
     * @param string|null $title
     */
    public function setTitle(?string $title)
    {
        $this->title = $title;
    }
    
    /**
     * 效验 标题
     * @param string $msg
     * @throws Exception
     */
    public function validTitle(string $msg = 'title Cannot be empty!')
    {
        if(empty($this->title)) throw new Exception($msg);
    }
    
    /**
     * 获取 内容
     * @return string
     */
    public function getContent(): ?string
    {
        return $this->content;
    }
    
    /**
     * 设置 内容
     * @param string|null $content
     */
    public function setContent(?string $content)
    {
        $this->content = $content;
    }
    
    /**
     * 效验 内容
     * @param string $msg
     * @throws Exception
     */
    public function validContent(string $msg = 'content Cannot be empty!')
    {
        if(empty($this->content)) throw new Exception($msg);
    }
    
    /**
     * 获取 排序
     * @return int
     */
    public function getRank(): ?int
    {
        return $this->rank;
    }
    
    /**
     * 设置 排序
     * @param int|null $rank
     */
    public function setRank(?int $rank)
    {
        $this->rank = $rank;
    }
    
    /**
     * 效验 排序
     * @param string $msg
     * @throws Exception
     */
    public function validRank(string $msg = 'rank Cannot be empty!')
    {
        if(empty($this->rank)) throw new Exception($msg);
    }
    
    /**
     * 获取 是否删除
     * @return bool
     */
    public function getIsDelete(): ?bool
    {
        return $this->is_delete;
    }
    
    /**
     * 设置 是否删除
     * @param bool|null $is_delete
     */
    public function setIsDelete(?bool $is_delete)
    {
        $this->is_delete = $is_delete;
    }
    
    /**
     * 效验 是否删除
     * @param string $msg
     * @throws Exception
     */
    public function validIsDelete(string $msg = 'is_delete Cannot be empty!')
    {
        if(empty($this->is_delete)) throw new Exception($msg);
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
     * 设置 创建人Id
     * @param $created_id
     */
    public function setCreatedId($created_id)
    {
        $this->created_id = $created_id;
    }
    
    /**
     * 效验 创建人Id
     * @param string $msg
     * @throws Exception
     */
    public function validCreatedId(string $msg = 'created_id Cannot be empty!')
    {
        if(empty($this->created_id)) throw new Exception($msg);
    }
    
    /**
     * 获取 创建时间
     * @return string
     */
    public function getCreatedTime(): ?string
    {
        return $this->created_time;
    }
    
    /**
     * 设置 创建时间
     * @param string|null $created_time
     */
    public function setCreatedTime(?string $created_time)
    {
        $this->created_time = $created_time;
    }
    
    /**
     * 效验 创建时间
     * @param string $msg
     * @throws Exception
     */
    public function validCreatedTime(string $msg = 'created_time Cannot be empty!')
    {
        if(empty($this->created_time)) throw new Exception($msg);
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
     * 设置 修改人Id
     * @param $updated_id
     */
    public function setUpdatedId($updated_id)
    {
        $this->updated_id = $updated_id;
    }
    
    /**
     * 效验 修改人Id
     * @param string $msg
     * @throws Exception
     */
    public function validUpdatedId(string $msg = 'updated_id Cannot be empty!')
    {
        if(empty($this->updated_id)) throw new Exception($msg);
    }
    
    /**
     * 获取 修改时间
     * @return string
     */
    public function getUpdatedTime(): ?string
    {
        return $this->updated_time;
    }
    
    /**
     * 设置 修改时间
     * @param string|null $updated_time
     */
    public function setUpdatedTime(?string $updated_time)
    {
        $this->updated_time = $updated_time;
    }
    
    /**
     * 效验 修改时间
     * @param string $msg
     * @throws Exception
     */
    public function validUpdatedTime(string $msg = 'updated_time Cannot be empty!')
    {
        if(empty($this->updated_time)) throw new Exception($msg);
    }
}