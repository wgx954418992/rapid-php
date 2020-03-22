<?php
namespace application\model;

use rapidPHP\library\AB;

/**
 * 系统设置表
 */
class AppSettingModel extends AB
{
    /**
     * 数据库表结构
     * @var array
     */
    public static $table = [
        'name' => 'app_setting',
        'comment' => '系统设置表',
        'column' => [
            'settingId' => ['type' => 'bigint', 'length' => 0, 'comment' => '主键'],
            'type' => ['type' => 'varchar', 'length' => 50, 'comment' => '类型'],
            'attribute' => ['type' => 'varchar', 'length' => 15, 'comment' => '属性'],
            'value' => ['type' => 'varchar', 'length' => 1024, 'comment' => '值'],
            'remarks' => ['type' => 'varchar', 'length' => 50, 'comment' => '备注'],
            'isDelete' => ['type' => 'int', 'length' => 0, 'comment' => '是否删除'],
            'createdUserId' => ['type' => 'bigint', 'length' => 0, 'comment' => '创建人Id'],
            'createdTime' => ['type' => 'datetime', 'length' => 0, 'comment' => '创建时间'],
            'updatedUserId' => ['type' => 'bigint', 'length' => 0, 'comment' => '修改人Id'],
            'updatedTime' => ['type' => 'datetime', 'length' => 0, 'comment' => '修改时间'],
        ]
    ];

    /**
     * AppSettingModel constructor.
     * @param array|null $data
     */
    public function __construct(array $data = null)
    {
        parent::__construct($data);
    }
    
    /**
     * 获取 主键
     * @return mixed
     */
    public function getSettingId()
    {
        return $this->getValue('settingId');
    }
    
    /**
     * 设置 主键
     * @param $settingId
     * @return AppSettingModel
     */
    public function setSettingId($settingId)
    {
        return $this->setValue('settingId', $settingId);
    }
    
    /**
     * 获取 类型
     * @return mixed
     */
    public function getType()
    {
        return $this->getValue('type');
    }
    
    /**
     * 设置 类型
     * @param $type
     * @return AppSettingModel
     */
    public function setType($type)
    {
        return $this->setValue('type', $type);
    }
    
    /**
     * 获取 属性
     * @return mixed
     */
    public function getAttribute()
    {
        return $this->getValue('attribute');
    }
    
    /**
     * 设置 属性
     * @param $attribute
     * @return AppSettingModel
     */
    public function setAttribute($attribute)
    {
        return $this->setValue('attribute', $attribute);
    }
    
    /**
     * 获取 值
     * @return mixed
     */
    public function getValue()
    {
        return $this->getValue('value');
    }
    
    /**
     * 设置 值
     * @param $value
     * @return AppSettingModel
     */
    public function setValue($value)
    {
        return $this->setValue('value', $value);
    }
    
    /**
     * 获取 备注
     * @return mixed
     */
    public function getRemarks()
    {
        return $this->getValue('remarks');
    }
    
    /**
     * 设置 备注
     * @param $remarks
     * @return AppSettingModel
     */
    public function setRemarks($remarks)
    {
        return $this->setValue('remarks', $remarks);
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
     * @return AppSettingModel
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
     * @return AppSettingModel
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
     * @return AppSettingModel
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
     * @return AppSettingModel
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
     * @return AppSettingModel
     */
    public function setUpdatedTime($updatedTime)
    {
        return $this->setValue('updatedTime', $updatedTime);
    }
}