<?php


namespace apps\file\classier\service;


use apps\core\classier\dao\master\FileDao;
use apps\core\classier\dao\MasterDao;
use apps\core\classier\enum\ErrorCode;
use apps\core\classier\model\AppFileModel;
use Exception;

abstract class IFileManagerService
{

    /**
     * 通过md5获取文件信息
     * @param $md5
     * @return AppFileModel
     * @throws Exception
     */
    public function getFileByMd5($md5)
    {
        if (empty($md5)) throw new Exception('文件md5错误!');

        $fileDao = FileDao::getInstance();

        $fileModel = $fileDao->getFileByMd5($md5);

        if ($fileModel == null) throw new Exception('文件不存在!', ErrorCode::FILE_NOT);

        return $fileModel;
    }

    /**
     * 获取文件信息
     * @param $fileId
     * @return AppFileModel
     * @throws Exception
     */
    public function getFile($fileId)
    {
        if (empty($fileId)) throw new Exception('文件id错误!', ErrorCode::FILE_NOT);

        /** @var FileDao $fileDao */
        $fileDao = FileDao::getInstance();

        $fileModel = $fileDao->getFile($fileId);

        if ($fileModel == null) throw new Exception('文件不存在!', ErrorCode::FILE_NOT);

        return $fileModel;
    }

    /**
     * 添加文件,如果已经存在则不会添加
     * @param AppFileModel $fileModel
     * @return AppFileModel|null
     * @throws Exception
     */
    public function addFile(AppFileModel $fileModel)
    {
        if (empty($fileModel->getPath())) throw new Exception('path错误!');

        if (empty($fileModel->getName())) throw new Exception('name错误!');

        if (empty($fileModel->getMime())) throw new Exception('mime错误!');

        if (empty($fileModel->getMd5())) throw new Exception('md5错误!');

        /** @var FileDao $fileDao */
        $fileDao = FileDao::getInstance();

        $isThing = MasterDao::getSQLDB()->isInThing();

        if (!$isThing) MasterDao::getSQLDB()->beginTransaction();

        try {
            $md5FileModel = $fileDao->getFileByMd5($fileModel->getMd5());

            if (!$md5FileModel == null) return $md5FileModel;

            $fileDao->addFile($fileModel);

            if (!$isThing && !MasterDao::getSQLDB()->commit()) throw new Exception('添加失败!');

            return $fileModel;
        } catch (Exception $e) {
            if (!$isThing) MasterDao::getSQLDB()->rollBack();

            throw $e;
        }
    }


    /**
     * upload
     * @param AppFileModel $fileModel
     * @return mixed
     */
    abstract public function upload(AppFileModel $fileModel): AppFileModel;


    /**
     * 获取文件url
     * @param AppFileModel $fileModel
     * @param int $expires
     * @param array|null $options
     * @return string
     */
    abstract public function getFileUrl(AppFileModel $fileModel, int $expires = 3600 * 24 * 365, ?array $options = []): string;

    /**
     * 通过文件id 获取文件url
     * @param $id
     * @param int $expires
     * @param array|null $options
     * @return string
     */
    abstract public function getFileUrlById($id, int $expires = 3600 * 24 * 365, ?array $options = []): string;
}
