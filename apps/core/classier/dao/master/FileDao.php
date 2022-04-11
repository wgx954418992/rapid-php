<?php

namespace apps\core\classier\dao\master;


use apps\core\classier\dao\MasterDao;
use apps\core\classier\model\AppFileModel;
use Exception;
use function rapidPHP\Cal;

class FileDao extends MasterDao
{

    /**
     * file
     */
    public const CACHE_PREFIX = 'app_file';

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
     * @param AppFileModel $fileModel
     * @return bool
     * @throws Exception
     */
    public function addFile(AppFileModel $fileModel): bool
    {
        $result = parent::add([
            'name' => $fileModel->getName(),
            'size' => $fileModel->getSize(),
            'md5' => $fileModel->getMd5(),
            'mime' => $fileModel->getMime(),
            'path' => $fileModel->getPath(),
            'is_delete' => false,
            'created_id' => $fileModel->getCreatedId(),
            'created_time' => Cal()->getDate(),
        ], $inserId);

        if ($result) {
            $fileModel->setId($inserId);

            $this->delCache($this->getCacheId('id', $fileModel->getId()));

            $this->delCache($this->getCacheId('md5', $fileModel->getMd5()));
        }

        return $result;
    }

    /**
     * 修改文件
     * @param AppFileModel $fileModel
     * @return bool
     * @throws Exception
     */
    public function setFile(AppFileModel $fileModel): bool
    {
        $result = parent::set([
            'name' => $fileModel->getName(),
            'size' => $fileModel->getSize(),
            'md5' => $fileModel->getMd5(),
            'mime' => $fileModel->getMime(),
            'path' => $fileModel->getPath(),
            'updated_id' => $fileModel->getUpdatedId(),
            'updated_time' => Cal()->getDate(),
        ])->where('id', $fileModel->getId())
            ->execute();

        if ($result) {
            $this->delCache($this->getCacheId('id', $fileModel->getId()));

            $this->delCache($this->getCacheId('md5', $fileModel->getMd5()));
        }

        return $result;
    }


    /**
     * 获取file文件信息
     * @param $id
     * @return AppFileModel|null
     * @throws Exception
     */
    public function getFile($id): ?AppFileModel
    {
        $cacheId = $this->getCacheId('id', $id);

        return $this->getCacheWithCallback($cacheId, function () use ($id) {
            return parent::get()
                ->where('is_delete', false)
                ->where('id', $id)
                ->getStatement()
                ->fetch($this->getModelOrClass());
        });
    }

    /**
     * 通过md5获取文件信息
     * @param $md5
     * @return AppFileModel|null
     * @throws Exception
     */
    public function getFileByMd5($md5): ?AppFileModel
    {
        $cacheId = $this->getCacheId('md5', $md5);

        return $this->getCacheWithCallback($cacheId, function () use ($md5) {
            return parent::get()
                ->where('is_delete', false)
                ->where('md5', $md5)
                ->getStatement()
                ->fetch($this->getModelOrClass());
        });
    }

}
