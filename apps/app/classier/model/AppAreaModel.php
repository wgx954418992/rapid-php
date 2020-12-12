<?php

namespace apps\app\classier\model;

use Exception;
use rapidPHP\modules\core\classier\Model;

/**
 * 地区表
 * @table app_area
 * rapidPHP auto generate Model 2020-12-13 00:03:16
 */
class AppAreaModel extends Model
{
    
    /**
     * table name
     */
    const NAME = 'app_area';
        
    
    /**
     * 区域主键
     * @length 
     * @typed bigint
     */
    public $id;    
    
    /**
     * 区域名称
     * @length 40
     * @typed varchar
     */
    public $name;    
    
    /**
     * 拼音
     * @length 100
     * @typed varchar
     */
    public $pinyin;    
    
    /**
     * 区域上级标识
     * @length 
     * @typed bigint
     */
    public $pid;    
    
    /**
     * 区域等级
     * @length 
     * @typed int
     */
    public $level;    
    
    /**
     * 区域编码
     * @length 20
     * @typed varchar
     */
    public $city_code;    
    
    /**
     * 邮政编码
     * @length 20
     * @typed varchar
     */
    public $post_code;    
    
    /**
     * 东经
     * @length 
     * @typed float
     */
    public $longitude;    
    
    /**
     * 北纬
     * @length 
     * @typed float
     */
    public $latitude;    
    /**
     * 获取 区域主键
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * 设置 区域主键
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
    /**
     * 效验 区域主键
     * @param string $msg
     * @throws Exception
     */
    public function validId(string $msg = 'id Cannot be empty!')
    {
        if(empty($this->id)) throw new Exception($msg);
    }
    
    /**
     * 获取 区域名称
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }
    
    /**
     * 设置 区域名称
     * @param string|null $name
     */
    public function setName(?string $name)
    {
        $this->name = $name;
    }
    
    /**
     * 效验 区域名称
     * @param string $msg
     * @throws Exception
     */
    public function validName(string $msg = 'name Cannot be empty!')
    {
        if(empty($this->name)) throw new Exception($msg);
    }
    
    /**
     * 获取 拼音
     * @return string
     */
    public function getPinyin(): ?string
    {
        return $this->pinyin;
    }
    
    /**
     * 设置 拼音
     * @param string|null $pinyin
     */
    public function setPinyin(?string $pinyin)
    {
        $this->pinyin = $pinyin;
    }
    
    /**
     * 效验 拼音
     * @param string $msg
     * @throws Exception
     */
    public function validPinyin(string $msg = 'pinyin Cannot be empty!')
    {
        if(empty($this->pinyin)) throw new Exception($msg);
    }
    
    /**
     * 获取 区域上级标识
     * @return mixed
     */
    public function getPid()
    {
        return $this->pid;
    }
    
    /**
     * 设置 区域上级标识
     * @param $pid
     */
    public function setPid($pid)
    {
        $this->pid = $pid;
    }
    
    /**
     * 效验 区域上级标识
     * @param string $msg
     * @throws Exception
     */
    public function validPid(string $msg = 'pid Cannot be empty!')
    {
        if(empty($this->pid)) throw new Exception($msg);
    }
    
    /**
     * 获取 区域等级
     * @return int
     */
    public function getLevel(): ?int
    {
        return $this->level;
    }
    
    /**
     * 设置 区域等级
     * @param int|null $level
     */
    public function setLevel(?int $level)
    {
        $this->level = $level;
    }
    
    /**
     * 效验 区域等级
     * @param string $msg
     * @throws Exception
     */
    public function validLevel(string $msg = 'level Cannot be empty!')
    {
        if(empty($this->level)) throw new Exception($msg);
    }
    
    /**
     * 获取 区域编码
     * @return string
     */
    public function getCityCode(): ?string
    {
        return $this->city_code;
    }
    
    /**
     * 设置 区域编码
     * @param string|null $city_code
     */
    public function setCityCode(?string $city_code)
    {
        $this->city_code = $city_code;
    }
    
    /**
     * 效验 区域编码
     * @param string $msg
     * @throws Exception
     */
    public function validCityCode(string $msg = 'city_code Cannot be empty!')
    {
        if(empty($this->city_code)) throw new Exception($msg);
    }
    
    /**
     * 获取 邮政编码
     * @return string
     */
    public function getPostCode(): ?string
    {
        return $this->post_code;
    }
    
    /**
     * 设置 邮政编码
     * @param string|null $post_code
     */
    public function setPostCode(?string $post_code)
    {
        $this->post_code = $post_code;
    }
    
    /**
     * 效验 邮政编码
     * @param string $msg
     * @throws Exception
     */
    public function validPostCode(string $msg = 'post_code Cannot be empty!')
    {
        if(empty($this->post_code)) throw new Exception($msg);
    }
    
    /**
     * 获取 东经
     * @return float
     */
    public function getLongitude(): ?float
    {
        return $this->longitude;
    }
    
    /**
     * 设置 东经
     * @param float|null $longitude
     */
    public function setLongitude(?float $longitude)
    {
        $this->longitude = $longitude;
    }
    
    /**
     * 效验 东经
     * @param string $msg
     * @throws Exception
     */
    public function validLongitude(string $msg = 'longitude Cannot be empty!')
    {
        if(empty($this->longitude)) throw new Exception($msg);
    }
    
    /**
     * 获取 北纬
     * @return float
     */
    public function getLatitude(): ?float
    {
        return $this->latitude;
    }
    
    /**
     * 设置 北纬
     * @param float|null $latitude
     */
    public function setLatitude(?float $latitude)
    {
        $this->latitude = $latitude;
    }
    
    /**
     * 效验 北纬
     * @param string $msg
     * @throws Exception
     */
    public function validLatitude(string $msg = 'latitude Cannot be empty!')
    {
        if(empty($this->latitude)) throw new Exception($msg);
    }
}