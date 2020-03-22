<?php
namespace application\model;

use rapidPHP\library\AB;

/**
 * 帮助表
 */
class AppHelpModel extends AB
{
    /**
     * 数据库表结构
     * @var array
     */
    public static $table = [
        'name' => 'app_help',
        'comment' => '帮助表',
        'column' => [
            'helpId' => ['type' => 'bigint', 'length' => 0, 'comment' => '帮助Id'],
            'title' => ['type' => 'varchar', 'length' => 50, 'comment' => '标题'],
            'content' => ['type' => 'longtext', 'length' => 4294967295, 'comment' => '内容'],
            'rank' => ['type' => 'int', 'length' => 0, 'comment' => '排序'],
            'isDelete' => ['type' => 'int', 'length' => 0, 'comment' => '是否删除'],
            'createdUserId' => ['type' => 'bigint', 'length' => 0, 'comment' => '创建人Id'],
            'createdTime' => ['type' => 'datetime', 'length' => 0, 'comment' => '创建时间'],
            'updatedUserId' => ['type' => 'bigint', 'length' => 0, 'comment' => '修改人Id'],
            'updatedTime' => ['type' => 'datetime', 'length' => 0, 'comment' => '修改时间'],
        ]
    ];

    /**
     * AppHelpModel constructor.
     * @param array|null $data
     */
    public function __construct(array $data = null)
    {
        parent::__construct($data);
    }
    
    /**
     * 获取 帮助Id
     * @return mixed
     */
    public function getHelpId()
    {
        return $this->getValue('helpId');
    }
    
    /**
     * 设置 帮助Id
     * @param $helpId
     * @return AppHelpModel
     */
    public function setHelpId($helpId)
    {
        return $this->setValue('helpId', $helpId);
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
     * @return AppHelpModel
     */
    public function setTitle($title)
    {
        return $this->setValue('title', $title);
    }
    
    /**
     * 获取 内容
     * @return mixed
     */
    public function getContent()
    {
        return $this->getValue('content');
    }
    
    /**
     * 设置 内容
     * @param $content
     * @return AppHelpModel
     */
    public function setContent($content)
    {
        return $this->setValue('content', $content);
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
     * @return AppHelpModel
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
     * @return AppHelpModel
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
     * @return AppHelpModel
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
     * @return AppHelpModel
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
     * @return AppHelpModel
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
     * @return AppHelpModel
     */
    public function setUpdatedTime($updatedTime)
    {
        return $this->setValue('updatedTime', $updatedTime);
    }
}