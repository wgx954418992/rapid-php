<?php
namespace application\model;

use rapidPHP\library\AB;

/**
 * 附件表
 */
class CommentFileModel extends AB
{
    /**
     * 数据库表结构
     * @var array
     */
    public static $table = [
        'name' => 'comment_file',
        'comment' => '附件表',
        'column' => [
            'CFId' => ['type' => 'bigint', 'length' => 0, 'comment' => '评论文件关联Id'],
            'commentId' => ['type' => 'bigint', 'length' => 0, 'comment' => '评论Id'],
            'fileId' => ['type' => 'bigint', 'length' => 0, 'comment' => '文件Id'],
            'isDelete' => ['type' => 'int', 'length' => 0, 'comment' => '是否删除'],
            'createdUserId' => ['type' => 'bigint', 'length' => 0, 'comment' => '创建人Id'],
            'createdTime' => ['type' => 'datetime', 'length' => 0, 'comment' => '创建时间'],
            'updatedUserId' => ['type' => 'bigint', 'length' => 0, 'comment' => '修改人Id'],
            'updatedTime' => ['type' => 'datetime', 'length' => 0, 'comment' => '修改时间'],
        ]
    ];

    /**
     * CommentFileModel constructor.
     * @param array|null $data
     */
    public function __construct(array $data = null)
    {
        parent::__construct($data);
    }
    
    /**
     * 获取 评论文件关联Id
     * @return mixed
     */
    public function getCFId()
    {
        return $this->getValue('CFId');
    }
    
    /**
     * 设置 评论文件关联Id
     * @param $CFId
     * @return CommentFileModel
     */
    public function setCFId($CFId)
    {
        return $this->setValue('CFId', $CFId);
    }
    
    /**
     * 获取 评论Id
     * @return mixed
     */
    public function getCommentId()
    {
        return $this->getValue('commentId');
    }
    
    /**
     * 设置 评论Id
     * @param $commentId
     * @return CommentFileModel
     */
    public function setCommentId($commentId)
    {
        return $this->setValue('commentId', $commentId);
    }
    
    /**
     * 获取 文件Id
     * @return mixed
     */
    public function getFileId()
    {
        return $this->getValue('fileId');
    }
    
    /**
     * 设置 文件Id
     * @param $fileId
     * @return CommentFileModel
     */
    public function setFileId($fileId)
    {
        return $this->setValue('fileId', $fileId);
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
     * @return CommentFileModel
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
     * @return CommentFileModel
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
     * @return CommentFileModel
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
     * @return CommentFileModel
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
     * @return CommentFileModel
     */
    public function setUpdatedTime($updatedTime)
    {
        return $this->setValue('updatedTime', $updatedTime);
    }
}