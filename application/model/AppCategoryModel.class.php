<?php
namespace application\model;

use rapidPHP\library\AB;

/**
 * 产品分类表
 */
class AppCategoryModel extends AB
{
    /**
     * 数据库表结构
     * @var array
     */
    public static $table = [
        'name' => 'app_category',
        'comment' => '产品分类表',
        'column' => [
            'categoryId' => ['type' => 'bigint', 'length' => 0, 'comment' => '分类Id'],
            'name' => ['type' => 'varchar', 'length' => 50, 'comment' => '分类名称'],
            'isSystem' => ['type' => 'int', 'length' => 0, 'comment' => '是否系统'],
            'isDelete' => ['type' => 'int', 'length' => 0, 'comment' => '是否删除'],
            'createdUserId' => ['type' => 'bigint', 'length' => 0, 'comment' => '创建人Id'],
            'createdTime' => ['type' => 'datetime', 'length' => 0, 'comment' => '创建时间'],
            'updatedUserId' => ['type' => 'bigint', 'length' => 0, 'comment' => '修改人Id'],
            'updatedTime' => ['type' => 'datetime', 'length' => 0, 'comment' => '修改时间'],
        ]
    ];

    /**
     * AppCategoryModel constructor.
     * @param array|null $data
     */
    public function __construct(array $data = null)
    {
        parent::__construct($data);
    }
    
    /**
     * 获取 分类Id
     * @return mixed
     */
    public function getCategoryId()
    {
        return $this->getValue('categoryId');
    }
    
    /**
     * 设置 分类Id
     * @param $categoryId
     * @return AppCategoryModel
     */
    public function setCategoryId($categoryId)
    {
        return $this->setValue('categoryId', $categoryId);
    }
    
    /**
     * 获取 分类名称
     * @return mixed
     */
    public function getName()
    {
        return $this->getValue('name');
    }
    
    /**
     * 设置 分类名称
     * @param $name
     * @return AppCategoryModel
     */
    public function setName($name)
    {
        return $this->setValue('name', $name);
    }
    
    /**
     * 获取 是否系统
     * @return int
     */
    public function getIsSystem(): ?int
    {
        return $this->getValue('isSystem');
    }
    
    /**
     * 设置 是否系统
     * @param int $isSystem
     * @return AppCategoryModel
     */
    public function setIsSystem(?int $isSystem)
    {
        return $this->setValue('isSystem', $isSystem);
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
     * @return AppCategoryModel
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
     * @return AppCategoryModel
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
     * @return AppCategoryModel
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
     * @return AppCategoryModel
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
     * @return AppCategoryModel
     */
    public function setUpdatedTime($updatedTime)
    {
        return $this->setValue('updatedTime', $updatedTime);
    }
}