<?php

namespace apps\core\classier\model;

use Exception;
use rapidPHP\modules\core\classier\Model;


/**
 * 地区表
 * @table app_area
 * rapidPHP auto generate Model 2022-04-11 11:39:17
 */

class AppAreaModel extends Model 
{

    /**
     * table name
     */
    const NAME = 'app_area';

    
    /**
     * 区域主键
     * @var 
     * @length 
     * @typed bigint
     */
    protected $id;

    /**
     * 设置 区域主键
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * 获取 区域主键
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * 效验 区域主键
     * @param string $msg
     * @throws Exception
     */
    public function validId(string $msg = 'id Cannot be empty!')
    {
        if (empty($this->id)) throw new Exception($msg);
    }

    /**
     * 区域名称
     * @var string|null 
     * @length 40
     * @typed varchar
     */
    protected $name;

    /**
     * 设置 区域名称
     * @param string|null $name
     */
    public function setName(?string $name)
    {
        $this->name = $name;
    }

    /**
     * 获取 区域名称
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * 效验 区域名称
     * @param string $msg
     * @throws Exception
     */
    public function validName(string $msg = 'name Cannot be empty!')
    {
        if (empty($this->name)) throw new Exception($msg);
    }

    /**
     * 拼音
     * @var string|null 
     * @length 100
     * @typed varchar
     */
    protected $pinyin;

    /**
     * 设置 拼音
     * @param string|null $pinyin
     */
    public function setPinyin(?string $pinyin)
    {
        $this->pinyin = $pinyin;
    }

    /**
     * 获取 拼音
     * @return string|null
     */
    public function getPinyin(): ?string
    {
        return $this->pinyin;
    }

    /**
     * 效验 拼音
     * @param string $msg
     * @throws Exception
     */
    public function validPinyin(string $msg = 'pinyin Cannot be empty!')
    {
        if (empty($this->pinyin)) throw new Exception($msg);
    }

    /**
     * 区域上级标识
     * @var 
     * @length 
     * @typed bigint
     */
    protected $pid;

    /**
     * 设置 区域上级标识
     * @param $pid
     */
    public function setPid($pid)
    {
        $this->pid = $pid;
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
     * 效验 区域上级标识
     * @param string $msg
     * @throws Exception
     */
    public function validPid(string $msg = 'pid Cannot be empty!')
    {
        if (empty($this->pid)) throw new Exception($msg);
    }

    /**
     * 区域等级
     * @var int|null 
     * @length 
     * @typed tinyint
     */
    protected $level;

    /**
     * 设置 区域等级
     * @param int|null $level
     */
    public function setLevel(?int $level)
    {
        $this->level = $level;
    }

    /**
     * 获取 区域等级
     * @return int|null
     */
    public function getLevel(): ?int
    {
        return $this->level;
    }

    /**
     * 效验 区域等级
     * @param string $msg
     * @throws Exception
     */
    public function validLevel(string $msg = 'level Cannot be empty!')
    {
        if (empty($this->level)) throw new Exception($msg);
    }

    /**
     * 区域编码
     * @var string|null 
     * @length 20
     * @typed varchar
     */
    protected $city_code;

    /**
     * 设置 区域编码
     * @param string|null $city_code
     */
    public function setCityCode(?string $city_code)
    {
        $this->city_code = $city_code;
    }

    /**
     * 获取 区域编码
     * @return string|null
     */
    public function getCityCode(): ?string
    {
        return $this->city_code;
    }

    /**
     * 效验 区域编码
     * @param string $msg
     * @throws Exception
     */
    public function validCityCode(string $msg = 'city_code Cannot be empty!')
    {
        if (empty($this->city_code)) throw new Exception($msg);
    }

    /**
     * 邮政编码
     * @var string|null 
     * @length 20
     * @typed varchar
     */
    protected $post_code;

    /**
     * 设置 邮政编码
     * @param string|null $post_code
     */
    public function setPostCode(?string $post_code)
    {
        $this->post_code = $post_code;
    }

    /**
     * 获取 邮政编码
     * @return string|null
     */
    public function getPostCode(): ?string
    {
        return $this->post_code;
    }

    /**
     * 效验 邮政编码
     * @param string $msg
     * @throws Exception
     */
    public function validPostCode(string $msg = 'post_code Cannot be empty!')
    {
        if (empty($this->post_code)) throw new Exception($msg);
    }

    /**
     * 东经
     * @var float|null 
     * @length 
     * @typed float
     */
    protected $longitude;

    /**
     * 设置 东经
     * @param float|null $longitude
     */
    public function setLongitude(?float $longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * 获取 东经
     * @return float|null
     */
    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    /**
     * 效验 东经
     * @param string $msg
     * @throws Exception
     */
    public function validLongitude(string $msg = 'longitude Cannot be empty!')
    {
        if (empty($this->longitude)) throw new Exception($msg);
    }

    /**
     * 北纬
     * @var float|null 
     * @length 
     * @typed float
     */
    protected $latitude;

    /**
     * 设置 北纬
     * @param float|null $latitude
     */
    public function setLatitude(?float $latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * 获取 北纬
     * @return float|null
     */
    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    /**
     * 效验 北纬
     * @param string $msg
     * @throws Exception
     */
    public function validLatitude(string $msg = 'latitude Cannot be empty!')
    {
        if (empty($this->latitude)) throw new Exception($msg);
    }

}
