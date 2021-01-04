<?php


namespace apps\core\classier\service;

use apps\core\classier\config\AcceptConfig;
use apps\core\classier\config\ErrorConfig;
use apps\core\classier\dao\master\FileDao;
use apps\core\classier\model\AppFileModel;
use Exception;
use finfo;
use rapidPHP\modules\common\classier\Instances;
use function rapidPHP\B;

class FileService
{
    /**
     * 单例模式
     */
    use Instances;

    /**
     * 初始化当前
     * @return static
     */
    public static function onNotInstance()
    {
        return new static();
    }

    /**
     * 通过md5获取文件信息
     * @param $md5
     * @return AppFileModel
     * @throws Exception
     */
    public function getFileByMd5($md5): AppFileModel
    {
        if (empty($md5)) throw new Exception('文件md5错误!');

        $fileDao = FileDao::getInstance();

        $fileModel = $fileDao->getFileByMd5($md5);

        if ($fileModel == null) throw new Exception('文件不存在!', ErrorConfig::FILE_NOT);

        return $fileModel;
    }

    /**
     * 获取文件信息
     * @param $fileId
     * @return AppFileModel
     * @throws Exception
     */
    public function getFile($fileId): AppFileModel
    {
        if (empty($fileId)) throw new Exception('文件id错误!');

        $fileDao = FileDao::getInstance();

        $fileModel = $fileDao->getFile($fileId);

        if ($fileModel == null) throw new Exception('文件不存在!', ErrorConfig::FILE_NOT);

        if (!is_file($fileModel->getPath())) throw new Exception('文件服务器错误!', ErrorConfig::FILE_NOT);

        return $fileModel;
    }


    /**
     * 添加文件,如果已经存在则不会添加
     * @param string|int $userId
     * @param $filePath
     * @param $fileName
     * @param null $limitSize
     * @return AppFileModel
     * @throws Exception
     */
    public function addFile($userId, $filePath, $fileName, $limitSize = null): AppFileModel
    {
        if (!is_file($filePath)) throw new Exception('文件错误!');

        if (empty($fileName)) throw new Exception('文件名错误!');

        $fi = new finfo();

        $fileMime = $fi->file($filePath, FILEINFO_MIME_TYPE);

        if (!AcceptConfig::valid($fileMime)) throw new Exception('文件格式错误!' . $fileMime);

        $md5 = md5_file($filePath);

        $fileDao = FileDao::getInstance();

        $md5FileModel = $fileDao->getFileByMd5($md5);

        if (!$md5FileModel == null) return $md5FileModel;

        $fileSize = filesize($filePath);

        if (!is_null($limitSize) && $fileSize > $limitSize) {
            throw new Exception('文件大小超过上传限制大小!');
        }

        $fileModel = new AppFileModel();

        $fileId = B()->onlyIdToInt();

        $fileModel->setId($fileId);

        $fileModel->setName($fileName);

        $fileModel->setMime($fileMime);

        $fileModel->setPath($filePath);

        $fileModel->setMd5($md5);

        $fileModel->setSize($fileSize);

        if (!$fileDao->addFile($userId, $fileModel))
            throw new Exception('添加失败!');

        return $fileModel;
    }
}