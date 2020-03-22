<?php
namespace application\model;

use rapidPHP\library\AB;

/**
 * 帮助表
 */
class AppReportModel extends AB
{
    /**
     * 数据库表结构
     * @var array
     */
    public static $table = [
        'name' => 'app_report',
        'comment' => '帮助表',
        'column' => [
            'reportId' => ['type' => 'bigint', 'length' => 0, 'comment' => '举报Id'],
            'userId' => ['type' => 'bigint', 'length' => 0, 'comment' => '用户id'],
            'title' => ['type' => 'varchar', 'length' => 50, 'comment' => '举报类型 title'],
            'content' => ['type' => 'longtext', 'length' => 4294967295, 'comment' => '内容'],
            'contact' => ['type' => 'varchar', 'length' => 50, 'comment' => '联系方式'],
            'status' => ['type' => 'int', 'length' => 0, 'comment' => '状态 1 举报成功 2 已处理 '],
            'isDelete' => ['type' => 'int', 'length' => 0, 'comment' => '是否删除'],
            'createdUserId' => ['type' => 'bigint', 'length' => 0, 'comment' => '创建人Id'],
            'createdTime' => ['type' => 'datetime', 'length' => 0, 'comment' => '创建时间'],
            'updatedUserId' => ['type' => 'bigint', 'length' => 0, 'comment' => '修改人Id'],
            'updatedTime' => ['type' => 'datetime', 'length' => 0, 'comment' => '修改时间'],
        ]
    ];

    /**
     * AppReportModel constructor.
     * @param array|null $data
     */
    public function __construct(array $data = null)
    {
        parent::__construct($data);
    }
    
    /**
     * 获取 举报Id
     * @return mixed
     */
    public function getReportId()
    {
        return $this->getValue('reportId');
    }
    
    /**
     * 设置 举报Id
     * @param $reportId
     * @return AppReportModel
     */
    public function setReportId($reportId)
    {
        return $this->setValue('reportId', $reportId);
    }
    
    /**
     * 获取 用户id
     * @return mixed
     */
    public function getUserId()
    {
        return $this->getValue('userId');
    }
    
    /**
     * 设置 用户id
     * @param $userId
     * @return AppReportModel
     */
    public function setUserId($userId)
    {
        return $this->setValue('userId', $userId);
    }
    
    /**
     * 获取 举报类型 title
     * @return mixed
     */
    public function getTitle()
    {
        return $this->getValue('title');
    }
    
    /**
     * 设置 举报类型 title
     * @param $title
     * @return AppReportModel
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
     * @return AppReportModel
     */
    public function setContent($content)
    {
        return $this->setValue('content', $content);
    }
    
    /**
     * 获取 联系方式
     * @return mixed
     */
    public function getContact()
    {
        return $this->getValue('contact');
    }
    
    /**
     * 设置 联系方式
     * @param $contact
     * @return AppReportModel
     */
    public function setContact($contact)
    {
        return $this->setValue('contact', $contact);
    }
    
    /**
     * 获取 状态 1 举报成功 2 已处理 
     * @return int
     */
    public function getStatus(): ?int
    {
        return $this->getValue('status');
    }
    
    /**
     * 设置 状态 1 举报成功 2 已处理 
     * @param int $status
     * @return AppReportModel
     */
    public function setStatus(?int $status)
    {
        return $this->setValue('status', $status);
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
     * @return AppReportModel
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
     * @return AppReportModel
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
     * @return AppReportModel
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
     * @return AppReportModel
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
     * @return AppReportModel
     */
    public function setUpdatedTime($updatedTime)
    {
        return $this->setValue('updatedTime', $updatedTime);
    }
}