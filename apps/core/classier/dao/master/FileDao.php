<?php

namespace apps\core\classier\dao\master;


use apps\core\classier\dao\MasterDao;
use apps\core\classier\model\AppFileModel;
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
     * @param AppFileModel $fileInfo
     * @return bool
     * @throws Exception
     */
    public function addFile(AppFileModel $fileInfo): bool
    {
        $result = parent::add([
            'id' => $fileInfo->getId(),
            'fname' => $fileInfo->getName(),
            'size' => $fileInfo->getSize(),
            'md5' => $fileInfo->getMd5(),
            'mime' => $fileInfo->getMime(),
            'path' => $fileInfo->getPath(),
            'is_delete' => false,
            'created_id' => $fileInfo->getCreatedId(),
            'created_time' => Cal()->getDate(),
        ], $inserId);

        if ($result) $fileInfo->setId($inserId);

        return $result;
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
            ->where('is_delete', false)
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
            ->where('is_delete', false)
            ->where('md5', $md5)
            ->getStatement()
            ->fetch($this->getModelOrClass());

        return $model;
    }

}