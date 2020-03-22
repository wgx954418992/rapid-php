<?php
namespace application\model;

use rapidPHP\library\AB;

/**
 * 评论表
 */
class AppCommentModel extends AB
{
    /**
     * 数据库表结构
     * @var array
     */
    public static $table = [
        'name' => 'app_comment',
        'comment' => '评论表',
        'column' => [
            'commentId' => ['type' => 'bigint', 'length' => 0, 'comment' => '评论Id'],
            'parentId' => ['type' => 'bigint', 'length' => 0, 'comment' => '父Id'],
            'userId' => ['type' => 'bigint', 'length' => 0, 'comment' => '用户Id'],
            'bindId' => ['type' => 'varchar', 'length' => 32, 'comment' => '绑定的Id(可以是店铺评价，订单评价)'],
            'type' => ['type' => 'int', 'length' => 0, 'comment' => '类型 1 店铺 2订单评价'],
            'score' => ['type' => 'int', 'length' => 0, 'comment' => '分数'],
            'context' => ['type' => 'varchar', 'length' => 256, 'comment' => '内容'],
            'isAnonymous' => ['type' => 'int', 'length' => 0, 'comment' => '是否匿名评论'],
            'isDelete' => ['type' => 'int', 'length' => 0, 'comment' => '是否删除'],
            'createdUserId' => ['type' => 'bigint', 'length' => 0, 'comment' => '创建人Id'],
            'createdTime' => ['type' => 'datetime', 'length' => 0, 'comment' => '创建时间'],
            'updatedUserId' => ['type' => 'bigint', 'length' => 0, 'comment' => '修改人Id'],
            'updatedTime' => ['type' => 'datetime', 'length' => 0, 'comment' => '修改时间'],
        ]
    ];

    /**
     * AppCommentModel constructor.
     * @param array|null $data
     */
    public function __construct(array $data = null)
    {
        parent::__construct($data);
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
     * @return AppCommentModel
     */
    public function setCommentId($commentId)
    {
        return $this->setValue('commentId', $commentId);
    }
    
    /**
     * 获取 父Id
     * @return mixed
     */
    public function getParentId()
    {
        return $this->getValue('parentId');
    }
    
    /**
     * 设置 父Id
     * @param $parentId
     * @return AppCommentModel
     */
    public function setParentId($parentId)
    {
        return $this->setValue('parentId', $parentId);
    }
    
    /**
     * 获取 用户Id
     * @return mixed
     */
    public function getUserId()
    {
        return $this->getValue('userId');
    }
    
    /**
     * 设置 用户Id
     * @param $userId
     * @return AppCommentModel
     */
    public function setUserId($userId)
    {
        return $this->setValue('userId', $userId);
    }
    
    /**
     * 获取 绑定的Id(可以是店铺评价，订单评价)
     * @return mixed
     */
    public function getBindId()
    {
        return $this->getValue('bindId');
    }
    
    /**
     * 设置 绑定的Id(可以是店铺评价，订单评价)
     * @param $bindId
     * @return AppCommentModel
     */
    public function setBindId($bindId)
    {
        return $this->setValue('bindId', $bindId);
    }
    
    /**
     * 获取 类型 1 店铺 2订单评价
     * @return int
     */
    public function getType(): ?int
    {
        return $this->getValue('type');
    }
    
    /**
     * 设置 类型 1 店铺 2订单评价
     * @param int $type
     * @return AppCommentModel
     */
    public function setType(?int $type)
    {
        return $this->setValue('type', $type);
    }
    
    /**
     * 获取 分数
     * @return int
     */
    public function getScore(): ?int
    {
        return $this->getValue('score');
    }
    
    /**
     * 设置 分数
     * @param int $score
     * @return AppCommentModel
     */
    public function setScore(?int $score)
    {
        return $this->setValue('score', $score);
    }
    
    /**
     * 获取 内容
     * @return mixed
     */
    public function getContext()
    {
        return $this->getValue('context');
    }
    
    /**
     * 设置 内容
     * @param $context
     * @return AppCommentModel
     */
    public function setContext($context)
    {
        return $this->setValue('context', $context);
    }
    
    /**
     * 获取 是否匿名评论
     * @return int
     */
    public function getIsAnonymous(): ?int
    {
        return $this->getValue('isAnonymous');
    }
    
    /**
     * 设置 是否匿名评论
     * @param int $isAnonymous
     * @return AppCommentModel
     */
    public function setIsAnonymous(?int $isAnonymous)
    {
        return $this->setValue('isAnonymous', $isAnonymous);
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
     * @return AppCommentModel
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
     * @return AppCommentModel
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
     * @return AppCommentModel
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
     * @return AppCommentModel
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
     * @return AppCommentModel
     */
    public function setUpdatedTime($updatedTime)
    {
        return $this->setValue('updatedTime', $updatedTime);
    }
}