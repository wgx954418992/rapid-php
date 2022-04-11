<?php


namespace apps\file\classier\service\file;


use apps\core\classier\model\AppFileModel;
use apps\core\classier\service\SettingService;
use apps\file\classier\config\FileConfig;
use apps\file\classier\service\IFileManagerService;
use Exception;
use finfo;
use rapidPHP\modules\common\classier\Instances;

class LocalFileManagerService extends IFileManagerService
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
     * 从本地添加文件
     * @param AppFileModel $fileModel
     * @return AppFileModel|null
     * @throws Exception
     */
    public function addFile(AppFileModel $fileModel)
    {
        if (!is_file($fileModel->getPath())) throw new Exception('文件错误!');

        if (empty($fileModel->getName())) throw new Exception('文件名错误!');

        if (empty($fileModel->getMd5())) {
            $fileModel->setMd5(md5_file($fileModel->getPath()));
        }

        if (empty($fileModel->getMime())) {
            $fi = new finfo();

            $mime = $fi->file($fileModel->getPath(), FILEINFO_MIME_TYPE);

            $fileModel->setMime($mime);
        }

        return parent::addFile($fileModel);
    }

    /**
     * 上传接口
     * @param AppFileModel $fileModel
     * @return AppFileModel
     * @throws Exception
     */
    public function upload(AppFileModel $fileModel): AppFileModel
    {
        if (!is_file($fileModel->getPath())) throw new Exception('文件不存在!');

        if (empty($fileModel->getMime())) {
            $fi = new finfo();

            $fileMime = $fi->file($fileModel->getPath(), FILEINFO_MIME_TYPE);

            $fileModel->setMime($fileMime);
        }

        if (empty($fileModel->getMd5())) {
            $fileModel->setMd5(md5_file($fileModel->getPath()));
        }

        $savePath = SettingService::getStoragePath(strtoupper($fileModel->getMd5()));

        if (!is_dir(dirname($savePath)) && !mkdir(dirname($savePath), 0777, true)) throw new Exception(dirname($savePath) . '创建目录失败!');

        if (is_uploaded_file($fileModel->getPath())) {

            if (!@move_uploaded_file($fileModel->getPath(), $savePath)) {
                throw new Exception('上传失败!');
            }
        } else if (!rename($fileModel->getPath(), $savePath)) {
            throw new Exception('上传失败(R)!');
        }

        $fileModel->setPath($savePath);

        return $this->addFile($fileModel);
    }


    /**
     * 获取文件url
     * @param AppFileModel $fileModel
     * @param int $expires
     * @param array|null $options
     * @return string
     */
    public function getFileUrl(AppFileModel $fileModel, int $expires = 3600 * 24 * 365, ?array $options = []): string
    {
        return FileConfig::getFileUrl($fileModel->getId());
    }

    /**
     * 通过文件id获取文件url
     * @param $id
     * @param int $expires
     * @param array|null $options
     * @return string
     */
    public function getFileUrlById($id, int $expires = 3600 * 24 * 365, ?array $options = []): string
    {
        return FileConfig::getFileUrl($id);

    }
}
