<?php
namespace application\model;

use rapidPHP\library\AB;

/**
 * banner表
 */
class AppBannerModel extends AB
{
    /**
     * 数据库表结构
     * @var array
     */
    public static $table = [
        'name' => 'app_banner',
        'comment' => 'banner表',
        'column' => [
            'bannerId' => ['type' => 'bigint', 'length' => 0, 'comment' => 'bannerId'],
            'title' => ['type' => 'varchar', 'length' => 50, 'comment' => '标题'],
            'fileId' => ['type' => 'bigint', 'length' => 0, 'comment' => '图片文件Id'],
            'type' => ['type' => 'int', 'length' => 0, 'comment' => '1跳转 2 提示'],
            'data' => ['type' => 'json', 'length' => 0, 'comment' => '数据'],
            'rank' => ['type' => 'int', 'length' => 0, 'comment' => '排序'],
            'isDelete' => ['type' => 'int', 'length' => 0, 'comment' => '是否删除'],
            'createdUserId' => ['type' => 'bigint', 'length' => 0, 'comment' => '创建人Id'],
            'createdTime' => ['type' => 'datetime', 'length' => 0, 'comment' => '创建时间'],
            'updatedUserId' => ['type' => 'bigint', 'length' => 0, 'comment' => '修改人Id'],
            'updatedTime' => ['type' => 'datetime', 'length' => 0, 'comment' => '修改时间'],
        ]
    ];

    /**
     * AppBannerModel constructor.
     * @param array|null $data
     */
    public function __construct(array $data = null)
    {
        parent::__construct($data);
    }
    
    /**
     * 获取 bannerId
     * @return mixed
     */
    public function getBannerId()
    {
        return $this->getValue('bannerId');
    }
    
    /**
     * 设置 bannerId
     * @param $bannerId
     * @return AppBannerModel
     */
    public function setBannerId($bannerId)
    {
        return $this->setValue('bannerId', $bannerId);
    }
    
    /**
     * 获取 标题
     * @return mixed
     */
    public function getTitle()
    {
        return $this->getValue('title');
    }
    
    /**
     * 设置 标题
     * @param $title
     * @return AppBannerModel
     */
    public function setTitle($title)
    {
        return $this->setValue('title', $title);
    }
    
    /**
     * 获取 图片文件Id
     * @return mixed
     */
    public function getFileId()
    {
        return $this->getValue('fileId');
    }
    
    /**
     * 设置 图片文件Id
     * @param $fileId
     * @return AppBannerModel
     */
    public function setFileId($fileId)
    {
        return $this->setValue('fileId', $fileId);
    }
    
    /**
     * 获取 1跳转 2 提示
     * @return int
     */
    public function getType(): ?int
    {
        return $this->getValue('type');
    }
    
    /**
     * 设置 1跳转 2 提示
     * @param int $type
     * @return AppBannerModel
     */
    public function setType(?int $type)
    {
        return $this->setValue('type', $type);
    }
    
    /**
     * 获取 数据
     * @return array
     */
    public function getData(): ?array
    {
        return $this->getValue('data');
    }
    
    /**
     * 设置 数据
     * @param array $data
     * @return AppBannerModel
     */
    public function setData(?array $data)
    {
        return $this->setValue('data', $data);
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
     * @return AppBannerModel
     */
    public function setRank(?int $rank)
    {
        return $this->setValue('rank', $rank);
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
     * @return AppBannerModel
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
     * @return AppBannerModel
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
     * @return AppBannerModel
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
     * @return AppBannerModel
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
     * @return AppBannerModel
     */
    public function setUpdatedTime($updatedTime)
    {
        return $this->setValue('updatedTime', $updatedTime);
    }
}