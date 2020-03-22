<?php
namespace application\model;

use rapidPHP\library\AB;

/**
 * 文件表
 */
class AppFileModel extends AB
{
    /**
     * 数据库表结构
     * @var array
     */
    public static $table = [
        'name' => 'app_file',
        'comment' => '文件表',
        'column' => [
            'fileId' => ['type' => 'bigint', 'length' => 0, 'comment' => '主键'],
            'name' => ['type' => 'varchar', 'length' => 1024, 'comment' => '文件名'],
            'size' => ['type' => 'bigint', 'length' => 0, 'comment' => '文件大小'],
            'md5' => ['type' => 'varchar', 'length' => 32, 'comment' => '文件sha1效验值'],
            'mime' => ['type' => 'varchar', 'length' => 20, 'comment' => '文件MIME'],
            'path' => ['type' => 'varchar', 'length' => 1024, 'comment' => '文件路径'],
            'isDelete' => ['type' => 'int', 'length' => 0, 'comment' => '是否删除'],
            'createdUserId' => ['type' => 'bigint', 'length' => 0, 'comment' => '创建人Id'],
            'createdTime' => ['type' => 'datetime', 'length' => 0, 'comment' => '创建时间'],
            'updatedUserId' => ['type' => 'bigint', 'length' => 0, 'comment' => '修改人Id'],
            'updatedTime' => ['type' => 'datetime', 'length' => 0, 'comment' => '修改时间'],
        ]
    ];

    /**
     * AppFileModel constructor.
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
    public function getFileId()
    {
        return $this->getValue('fileId');
    }
    
    /**
     * 设置 主键
     * @param $fileId
     * @return AppFileModel
     */
    public function setFileId($fileId)
    {
        return $this->setValue('fileId', $fileId);
    }
    
    /**
     * 获取 文件名
     * @return mixed
     */
    public function getName()
    {
        return $this->getValue('name');
    }
    
    /**
     * 设置 文件名
     * @param $name
     * @return AppFileModel
     */
    public function setName($name)
    {
        return $this->setValue('name', $name);
    }
    
    /**
     * 获取 文件大小
     * @return mixed
     */
    public function getSize()
    {
        return $this->getValue('size');
    }
    
    /**
     * 设置 文件大小
     * @param $size
     * @return AppFileModel
     */
    public function setSize($size)
    {
        return $this->setValue('size', $size);
    }
    
    /**
     * 获取 文件sha1效验值
     * @return mixed
     */
    public function getMd5()
    {
        return $this->getValue('md5');
    }
    
    /**
     * 设置 文件sha1效验值
     * @param $md5
     * @return AppFileModel
     */
    public function setMd5($md5)
    {
        return $this->setValue('md5', $md5);
    }
    
    /**
     * 获取 文件MIME
     * @return mixed
     */
    public function getMime()
    {
        return $this->getValue('mime');
    }
    
    /**
     * 设置 文件MIME
     * @param $mime
     * @return AppFileModel
     */
    public function setMime($mime)
    {
        return $this->setValue('mime', $mime);
    }
    
    /**
     * 获取 文件路径
     * @return mixed
     */
    public function getPath()
    {
        return $this->getValue('path');
    }
    
    /**
     * 设置 文件路径
     * @param $path
     * @return AppFileModel
     */
    public function setPath($path)
    {
        return $this->setValue('path', $path);
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
     * @return AppFileModel
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
     * @return AppFileModel
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
     * @return AppFileModel
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
     * @return AppFileModel
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
     * @return AppFileModel
     */
    public function setUpdatedTime($updatedTime)
    {
        return $this->setValue('updatedTime', $updatedTime);
    }
}