<?php
namespace application\model;

use rapidPHP\library\AB;

/**
 * 市场表
 */
class AppMarketModel extends AB
{
    /**
     * 数据库表结构
     * @var array
     */
    public static $table = [
        'name' => 'app_market',
        'comment' => '市场表',
        'column' => [
            'marketId' => ['type' => 'bigint', 'length' => 0, 'comment' => '市场Id'],
            'areaId' => ['type' => 'bigint', 'length' => 0, 'comment' => '地区Id'],
            'name' => ['type' => 'varchar', 'length' => 50, 'comment' => '市场名称'],
            'rank' => ['type' => 'int', 'length' => 0, 'comment' => '排序'],
            'location' => ['type' => 'varchar', 'length' => 50, 'comment' => '坐标'],
            'isDelete' => ['type' => 'int', 'length' => 0, 'comment' => '是否删除'],
            'createdUserId' => ['type' => 'bigint', 'length' => 0, 'comment' => '创建人Id'],
            'createdTime' => ['type' => 'datetime', 'length' => 0, 'comment' => '创建时间'],
            'updatedUserId' => ['type' => 'bigint', 'length' => 0, 'comment' => '修改人Id'],
            'updatedTime' => ['type' => 'datetime', 'length' => 0, 'comment' => '修改时间'],
        ]
    ];

    /**
     * AppMarketModel constructor.
     * @param array|null $data
     */
    public function __construct(array $data = null)
    {
        parent::__construct($data);
    }
    
    /**
     * 获取 市场Id
     * @return mixed
     */
    public function getMarketId()
    {
        return $this->getValue('marketId');
    }
    
    /**
     * 设置 市场Id
     * @param $marketId
     * @return AppMarketModel
     */
    public function setMarketId($marketId)
    {
        return $this->setValue('marketId', $marketId);
    }
    
    /**
     * 获取 地区Id
     * @return mixed
     */
    public function getAreaId()
    {
        return $this->getValue('areaId');
    }
    
    /**
     * 设置 地区Id
     * @param $areaId
     * @return AppMarketModel
     */
    public function setAreaId($areaId)
    {
        return $this->setValue('areaId', $areaId);
    }
    
    /**
     * 获取 市场名称
     * @return mixed
     */
    public function getName()
    {
        return $this->getValue('name');
    }
    
    /**
     * 设置 市场名称
     * @param $name
     * @return AppMarketModel
     */
    public function setName($name)
    {
        return $this->setValue('name', $name);
    }
    
    /**
     * 获取 排序
     * @return int
     */
    public function getRank(): ?int
    {
        return $this->getValue('rank');
    }
    
    /**
     * 设置 排序
     * @param int $rank
     * @return AppMarketModel
     */
    public function setRank(?int $rank)
    {
        return $this->setValue('rank', $rank);
    }
    
    /**
     * 获取 坐标
     * @return mixed
     */
    public function getLocation()
    {
        return $this->getValue('location');
    }
    
    /**
     * 设置 坐标
     * @param $location
     * @return AppMarketModel
     */
    public function setLocation($location)
    {
        return $this->setValue('location', $location);
    }
    
    /**
     * 获取 是否删除
     * @return int
     */
    public function getIsDelete(): ?int
    {
        return $this->getValue('isDelete');
    }
    
    /**
     * 设置 是否删除
     * @param int $isDelete
     * @return AppMarketModel
     */
    public function setIsDelete(?int $isDelete)
    {
        return $this->setValue('isDelete', $isDelete);
    }
    
    /**
     * 获取 创建人Id
     * @return mixed
     */
    public function getCreatedUserId()
    {
        return $this->getValue('createdUserId');
    }
    
    /**
     * 设置 创建人Id
     * @param $createdUserId
     * @return AppMarketModel
     */
    public function setCreatedUserId($createdUserId)
    {
        return $this->setValue('createdUserId', $createdUserId);
    }
    
    /**
     * 获取 创建时间
     * @return mixed
     */
    public function getCreatedTime()
    {
        return $this->getValue('createdTime');
    }
    
    /**
     * 设置 创建时间
     * @param $createdTime
     * @return AppMarketModel
     */
    public function setCreatedTime($createdTime)
    {
        return $this->setValue('createdTime', $createdTime);
    }
    
    /**
     * 获取 修改人Id
     * @return mixed
     */
    public function getUpdatedUserId()
    {
        return $this->getValue('updatedUserId');
    }
    
    /**
     * 设置 修改人Id
     * @param $updatedUserId
     * @return AppMarketModel
     */
    public function setUpdatedUserId($updatedUserId)
    {
        return $this->setValue('updatedUserId', $updatedUserId);
    }
    
    /**
     * 获取 修改时间
     * @return mixed
     */
    public function getUpdatedTime()
    {
        return $this->getValue('updatedTime');
    }
    
    /**
     * 设置 修改时间
     * @param $updatedTime
     * @return AppMarketModel
     */
    public function setUpdatedTime($updatedTime)
    {
        return $this->setValue('updatedTime', $updatedTime);
    }
}