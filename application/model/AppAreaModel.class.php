<?php
namespace application\model;

use rapidPHP\library\AB;

/**
 * 地区表
 */
class AppAreaModel extends AB
{
    /**
     * 数据库表结构
     * @var array
     */
    public static $table = [
        'name' => 'app_area',
        'comment' => '地区表',
        'column' => [
            'areaId' => ['type' => 'int', 'length' => 0, 'comment' => '区域主键'],
            'name' => ['type' => 'varchar', 'length' => 40, 'comment' => '区域名称'],
            'pinyin' => ['type' => 'varchar', 'length' => 100, 'comment' => '拼音'],
            'pid' => ['type' => 'int', 'length' => 0, 'comment' => '区域上级标识'],
            'level' => ['type' => 'int', 'length' => 0, 'comment' => '区域等级'],
            'cityCode' => ['type' => 'varchar', 'length' => 20, 'comment' => '区域编码'],
            'postCode' => ['type' => 'varchar', 'length' => 20, 'comment' => '邮政编码'],
            'longitude' => ['type' => 'float', 'length' => 0, 'comment' => '东经'],
            'latitude' => ['type' => 'float', 'length' => 0, 'comment' => '北纬'],
        ]
    ];

    /**
     * AppAreaModel constructor.
     * @param array|null $data
     */
    public function __construct(array $data = null)
    {
        parent::__construct($data);
    }
    
    /**
     * 获取 区域主键
     * @return int
     */
    public function getAreaId(): ?int
    {
        return $this->getValue('areaId');
    }
    
    /**
     * 设置 区域主键
     * @param int $areaId
     * @return AppAreaModel
     */
    public function setAreaId(?int $areaId)
    {
        return $this->setValue('areaId', $areaId);
    }
    
    /**
     * 获取 区域名称
     * @return mixed
     */
    public function getName()
    {
        return $this->getValue('name');
    }
    
    /**
     * 设置 区域名称
     * @param $name
     * @return AppAreaModel
     */
    public function setName($name)
    {
        return $this->setValue('name', $name);
    }
    
    /**
     * 获取 拼音
     * @return mixed
     */
    public function getPinyin()
    {
        return $this->getValue('pinyin');
    }
    
    /**
     * 设置 拼音
     * @param $pinyin
     * @return AppAreaModel
     */
    public function setPinyin($pinyin)
    {
        return $this->setValue('pinyin', $pinyin);
    }
    
    /**
     * 获取 区域上级标识
     * @return int
     */
    public function getPid(): ?int
    {
        return $this->getValue('pid');
    }
    
    /**
     * 设置 区域上级标识
     * @param int $pid
     * @return AppAreaModel
     */
    public function setPid(?int $pid)
    {
        return $this->setValue('pid', $pid);
    }
    
    /**
     * 获取 区域等级
     * @return int
     */
    public function getLevel(): ?int
    {
        return $this->getValue('level');
    }
    
    /**
     * 设置 区域等级
     * @param int $level
     * @return AppAreaModel
     */
    public function setLevel(?int $level)
    {
        return $this->setValue('level', $level);
    }
    
    /**
     * 获取 区域编码
     * @return mixed
     */
    public function getCityCode()
    {
        return $this->getValue('cityCode');
    }
    
    /**
     * 设置 区域编码
     * @param $cityCode
     * @return AppAreaModel
     */
    public function setCityCode($cityCode)
    {
        return $this->setValue('cityCode', $cityCode);
    }
    
    /**
     * 获取 邮政编码
     * @return mixed
     */
    public function getPostCode()
    {
        return $this->getValue('postCode');
    }
    
    /**
     * 设置 邮政编码
     * @param $postCode
     * @return AppAreaModel
     */
    public function setPostCode($postCode)
    {
        return $this->setValue('postCode', $postCode);
    }
    
    /**
     * 获取 东经
     * @return float
     */
    public function getLongitude(): ?float
    {
        return $this->getValue('longitude');
    }
    
    /**
     * 设置 东经
     * @param float $longitude
     * @return AppAreaModel
     */
    public function setLongitude(?float $longitude)
    {
        return $this->setValue('longitude', $longitude);
    }
    
    /**
     * 获取 北纬
     * @return float
     */
    public function getLatitude(): ?float
    {
        return $this->getValue('latitude');
    }
    
    /**
     * 设置 北纬
     * @param float $latitude
     * @return AppAreaModel
     */
    public function setLatitude(?float $latitude)
    {
        return $this->setValue('latitude', $latitude);
    }
}