<?php
namespace application\model;

use rapidPHP\library\AB;

/**
 * 验证码表
 */
class AppCodeModel extends AB
{
    /**
     * 数据库表结构
     * @var array
     */
    public static $table = [
        'name' => 'app_code',
        'comment' => '验证码表',
        'column' => [
            'codeId' => ['type' => 'bigint', 'length' => 0, 'comment' => 'code Id'],
            'templateId' => ['type' => 'bigint', 'length' => 0, 'comment' => '模板Id'],
            'bindId' => ['type' => 'varchar', 'length' => 50, 'comment' => '手机号或者其他'],
            'code' => ['type' => 'varchar', 'length' => 23, 'comment' => '验证码'],
            'content' => ['type' => 'varchar', 'length' => 256, 'comment' => '短信内容'],
            'sendTime' => ['type' => 'int', 'length' => 0, 'comment' => '发送时间'],
            'checkTime' => ['type' => 'int', 'length' => 0, 'comment' => '效验时间'],
            'isDelete' => ['type' => 'int', 'length' => 0, 'comment' => '是否删除'],
            'createdUserId' => ['type' => 'bigint', 'length' => 0, 'comment' => '创建人Id'],
            'createdTime' => ['type' => 'datetime', 'length' => 0, 'comment' => '创建时间'],
            'updatedUserId' => ['type' => 'bigint', 'length' => 0, 'comment' => '修改人Id'],
            'updatedTime' => ['type' => 'datetime', 'length' => 0, 'comment' => '修改时间'],
        ]
    ];

    /**
     * AppCodeModel constructor.
     * @param array|null $data
     */
    public function __construct(array $data = null)
    {
        parent::__construct($data);
    }
    
    /**
     * 获取 code Id
     * @return mixed
     */
    public function getCodeId()
    {
        return $this->getValue('codeId');
    }
    
    /**
     * 设置 code Id
     * @param $codeId
     * @return AppCodeModel
     */
    public function setCodeId($codeId)
    {
        return $this->setValue('codeId', $codeId);
    }
    
    /**
     * 获取 模板Id
     * @return mixed
     */
    public function getTemplateId()
    {
        return $this->getValue('templateId');
    }
    
    /**
     * 设置 模板Id
     * @param $templateId
     * @return AppCodeModel
     */
    public function setTemplateId($templateId)
    {
        return $this->setValue('templateId', $templateId);
    }
    
    /**
     * 获取 手机号或者其他
     * @return mixed
     */
    public function getBindId()
    {
        return $this->getValue('bindId');
    }
    
    /**
     * 设置 手机号或者其他
     * @param $bindId
     * @return AppCodeModel
     */
    public function setBindId($bindId)
    {
        return $this->setValue('bindId', $bindId);
    }
    
    /**
     * 获取 验证码
     * @return mixed
     */
    public function getCode()
    {
        return $this->getValue('code');
    }
    
    /**
     * 设置 验证码
     * @param $code
     * @return AppCodeModel
     */
    public function setCode($code)
    {
        return $this->setValue('code', $code);
    }
    
    /**
     * 获取 短信内容
     * @return mixed
     */
    public function getContent()
    {
        return $this->getValue('content');
    }
    
    /**
     * 设置 短信内容
     * @param $content
     * @return AppCodeModel
     */
    public function setContent($content)
    {
        return $this->setValue('content', $content);
    }
    
    /**
     * 获取 发送时间
     * @return int
     */
    public function getSendTime(): ?int
    {
        return $this->getValue('sendTime');
    }
    
    /**
     * 设置 发送时间
     * @param int $sendTime
     * @return AppCodeModel
     */
    public function setSendTime(?int $sendTime)
    {
        return $this->setValue('sendTime', $sendTime);
    }
    
    /**
     * 获取 效验时间
     * @return int
     */
    public function getCheckTime(): ?int
    {
        return $this->getValue('checkTime');
    }
    
    /**
     * 设置 效验时间
     * @param int $checkTime
     * @return AppCodeModel
     */
    public function setCheckTime(?int $checkTime)
    {
        return $this->setValue('checkTime', $checkTime);
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
     * @return AppCodeModel
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
     * @return AppCodeModel
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
     * @return AppCodeModel
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
     * @return AppCodeModel
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
     * @return AppCodeModel
     */
    public function setUpdatedTime($updatedTime)
    {
        return $this->setValue('updatedTime', $updatedTime);
    }
}