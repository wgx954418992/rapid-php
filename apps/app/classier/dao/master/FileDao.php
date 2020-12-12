<?php

namespace apps\app\classier\dao\master;


use apps\app\classier\dao\MasterDao;
use apps\app\classier\model\AppFileModel;
use Exception;
use function rapidPHP\Cal;

class FileDao extends MasterDao
{


    /**
     * FileDao constructor.
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct(AppFileModel::class);
    }

    /**
     * 添加文件
     * @param $userId
     * @param AppFileModel $fileInfo
     * @return bool
     * @throws Exception
     */
    public function addFile($userId, AppFileModel $fileInfo): bool
    {
        return parent::add([
            'id' => $fileInfo->getId(),
            'fname' => $fileInfo->getName(),
            'size' => $fileInfo->getSize(),
            'md5' => $fileInfo->getMd5(),
            'mime' => $fileInfo->getMime(),
            'path' => $fileInfo->getPath(),
            'is_delete' => 0,
            'created_id' => $userId == null ? null : $userId,
            'created_time' => Cal()->getDate(),
        ]);
    }

    /**
     * 获取file文件信息
     * @param $fileId
     * @return AppFileModel|null
     * @throws Exception
     */
    public function getFile($fileId): ?AppFileModel
    {
        /** @var AppFileModel $model */
        $model = parent::get()
            ->where('is_delete', 0)
            ->where('id', $fileId)
            ->getStatement()
            ->fetch($this->getModelOrClass());

        return $model;
    }

    /**
     * 通过md5获取文件信息
     * @param $md5
     * @return AppFileModel|null
     * @throws Exception
     */
    public function getFileByMd5($md5): ?AppFileModel
    {
        /** @var AppFileModel $model */
        $model = parent::get()
            ->where('is_delete', 0)
            ->where('md5', $md5)
            ->getStatement()
            ->fetch($this->getModelOrClass());

        return $model;
    }

}