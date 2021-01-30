<?php

namespace apps\core\classier\model;

use Exception;
use rapidPHP\modules\core\classier\Model;

/**
 * 全球地区库，采集自腾讯QQ国内+国际版.ADD.JENA.20141221
 * @table app_area
 * rapidPHP auto generate Model 2021-01-25 21:19:26
 */
class AppAreaModel extends Model
{
    
    /**
     * table name
     */
    const NAME = 'app_area';
        
    
    /**
     * 主键
     * @length 
     * @typed int
     */
    private $id;    
    
    /**
     * 父ID
     * @length 
     * @typed int
     */
    private $pid;    
    
    /**
     * 路径
     * @length 255
     * @typed varchar
     */
    private $path;    
    
    /**
     * 层级
     * @length 
     * @typed int
     */
    private $level;    
    
    /**
     * 中文名称
     * @length 255
     * @typed varchar
     */
    private $name;    
    
    /**
     * 英文名称
     * @length 255
     * @typed varchar
     */
    private $name_en;    
    
    /**
     * 中文拼音
     * @length 255
     * @typed varchar
     */
    private $name_pinyin;    
    
    /**
     * 代码
     * @length 50
     * @typed varchar
     */
    private $code;    
    /**
     * 获取 主键
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }
    
    /**
     * 设置 主键
     * @param int|null $id
     */
    public function setId(?int $id)
    {
        $this->id = $id;
    }
    
    /**
     * 效验 主键
     * @param string $msg
     * @throws Exception
     */
    public function validId(string $msg = 'id Cannot be empty!')
    {
        if(empty($this->id)) throw new Exception($msg);
    }
    
    /**
     * 获取 父ID
     * @return int
     */
    public function getPid(): ?int
    {
        return $this->pid;
    }
    
    /**
     * 设置 父ID
     * @param int|null $pid
     */
    public function setPid(?int $pid)
    {
        $this->pid = $pid;
    }
    
    /**
     * 效验 父ID
     * @param string $msg
     * @throws Exception
     */
    public function validPid(string $msg = 'pid Cannot be empty!')
    {
        if(empty($this->pid)) throw new Exception($msg);
    }
    
    /**
     * 获取 路径
     * @return string
     */
    public function getPath(): ?string
    {
        return $this->path;
    }
    
    /**
     * 设置 路径
     * @param string|null $path
     */
    public function setPath(?string $path)
    {
        $this->path = $path;
    }
    
    /**
     * 效验 路径
     * @param string $msg
     * @throws Exception
     */
    public function validPath(string $msg = 'path Cannot be empty!')
    {
        if(empty($this->path)) throw new Exception($msg);
    }
    
    /**
     * 获取 层级
     * @return int
     */
    public function getLevel(): ?int
    {
        return $this->level;
    }
    
    /**
     * 设置 层级
     * @param int|null $level
     */
    public function setLevel(?int $level)
    {
        $this->level = $level;
    }
    
    /**
     * 效验 层级
     * @param string $msg
     * @throws Exception
     */
    public function validLevel(string $msg = 'level Cannot be empty!')
    {
        if(empty($this->level)) throw new Exception($msg);
    }
    
    /**
     * 获取 中文名称
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }
    
    /**
     * 设置 中文名称
     * @param string|null $name
     */
    public function setName(?string $name)
    {
        $this->name = $name;
    }
    
    /**
     * 效验 中文名称
     * @param string $msg
     * @throws Exception
     */
    public function validName(string $msg = 'name Cannot be empty!')
    {
        if(empty($this->name)) throw new Exception($msg);
    }
    
    /**
     * 获取 英文名称
     * @return string
     */
    public function getNameEn(): ?string
    {
        return $this->name_en;
    }
    
    /**
     * 设置 英文名称
     * @param string|null $name_en
     */
    public function setNameEn(?string $name_en)
    {
        $this->name_en = $name_en;
    }
    
    /**
     * 效验 英文名称
     * @param string $msg
     * @throws Exception
     */
    public function validNameEn(string $msg = 'name_en Cannot be empty!')
    {
        if(empty($this->name_en)) throw new Exception($msg);
    }
    
    /**
     * 获取 中文拼音
     * @return string
     */
    public function getNamePinyin(): ?string
    {
        return $this->name_pinyin;
    }
    
    /**
     * 设置 中文拼音
     * @param string|null $name_pinyin
     */
    public function setNamePinyin(?string $name_pinyin)
    {
        $this->name_pinyin = $name_pinyin;
    }
    
    /**
     * 效验 中文拼音
     * @param string $msg
     * @throws Exception
     */
    public function validNamePinyin(string $msg = 'name_pinyin Cannot be empty!')
    {
        if(empty($this->name_pinyin)) throw new Exception($msg);
    }
    
    /**
     * 获取 代码
     * @return string
     */
    public function getCode(): ?string
    {
        return $this->code;
    }
    
    /**
     * 设置 代码
     * @param string|null $code
     */
    public function setCode(?string $code)
    {
        $this->code = $code;
    }
    
    /**
     * 效验 代码
     * @param string $msg
     * @throws Exception
     */
    public function validCode(string $msg = 'code Cannot be empty!')
    {
        if(empty($this->code)) throw new Exception($msg);
    }
}