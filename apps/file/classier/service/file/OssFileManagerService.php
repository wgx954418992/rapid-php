<?php


namespace apps\file\classier\service\file;


use apps\core\classier\model\AppFileModel;
use apps\core\classier\service\CacheFactoryService;
use apps\core\classier\service\SettingService;
use apps\file\classier\service\IFileManagerService;
use apps\oss\classier\service\IOssService;
use Exception;
use finfo;
use oss\classier\model\UploadModel;
use OSS\Core\OssException;
use rapidPHP\modules\common\classier\Instances;
use rapidPHP\modules\common\classier\RESTFulApi;
use rapidPHP\modules\common\classier\Uri;
use rapidPHP\modules\reflection\classier\Utils;
use function rapidPHP\AB;
use function rapidPHP\B;
use function rapidPHP\DI;

class OssFileManagerService extends IFileManagerService
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
     * 添加文件,如果已经存在则不会添加
     * @param AppFileModel $fileModel
     * @return AppFileModel|null
     * @throws Exception
     */
    public function addFile(AppFileModel $fileModel)
    {
        if (empty($fileModel->getPath())) throw new Exception('对象错误!');

        if (empty($fileModel->getName())) throw new Exception('文件名错误!');

        if (empty($fileModel->getMd5())) throw new Exception('文件指纹错误!');

        /** @var IOssService $ossService */
        $ossService = DI(IOssService::class);

        if (!$ossService->existObject($fileModel->getPath())) {
            throw new Exception($fileModel->getPath() . ',对象不存在!');
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

        if (is_null($fileModel->getSize())) {
            $fileModel->setSize(filesize($fileModel->getPath()));
        }

        if (is_null($fileModel->getName())) {
            $fileModel->setName(basename($fileModel->getPath()));
        }

        if (empty($fileModel->getMime())) {
            $fi = new finfo();

            $fileMime = $fi->file($fileModel->getPath(), FILEINFO_MIME_TYPE);

            $fileModel->setMime($fileMime);
        }

        if (empty($fileModel->getMd5())) {
            $fileModel->setMd5(md5_file($fileModel->getPath()));
        }

        $object = SettingService::getOssStoragePath(strtoupper($fileModel->getMd5()));

        $uploadModel = new UploadModel();

        $uploadModel->setObject($object);

        $uploadModel->setPath($fileModel->getPath());

        $uploadModel->setMime($fileModel->getMime());

        $uploadModel->setSize($fileModel->getSize());

        $uploadModel->setUseCallback(true);

        /** @var IOssService $ossService */
        $ossService = DI(IOssService::class);

        $body = $ossService->uploadFile($uploadModel);

        if (!$body) throw new Exception('上传图片失败!');

        if (is_string($body) && B()->isJson($body)) {
            $data = AB(json_decode($body, true));

            if ($data->toInt('code') != RESTFulApi::CODE_SUCCESS) throw new Exception('body 错误!' . $data->toString('msg'));

            /** @var AppFileModel $fileModel */
            $fileModel = Utils::getInstance()
                ->toObject(AppFileModel::class, $data->toAB('data')->toArray('file'));

            if ($fileModel == null) throw new Exception('解析body 失败！');

            return $fileModel;
        } else {
            $newFileModel = new AppFileModel();

            $newFileModel->setMime($uploadModel->getMime());

            $newFileModel->setPath($uploadModel->getObject());

            $newFileModel->setMd5($fileModel->getMd5());

            $newFileModel->setName($fileModel->getName());

            $newFileModel->setSize($uploadModel->getSize());

            /** @var OssFileManagerService $fileManagerService */
            $fileManagerService = OssFileManagerService::getInstance();

            return $fileManagerService->addFile($newFileModel);
        }
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
        try {

            /** @var IOssService $ossService */
            $ossService = DI(IOssService::class);

            $cacheId = str_replace('\\', '_', get_class($ossService)) . "oss_{$fileModel->getPath()}_{$expires}_" . Uri::getInstance()->toQuery($options, true, true, '_');

            $cacheService = CacheFactoryService::getICache();

            if (!empty($cacheService->get($cacheId))) {
                return $cacheService->get($cacheId);
            }

            $url = $ossService->getObjectSignUrl($fileModel->getPath(), $expires, $options);

            $cacheService->add($cacheId, $url, $expires);

            return $url;
        } catch (Exception $e) {
            return '';
        }
    }

    /**
     * 通过文件id 获取文件url
     * @param $id
     * @param int $expires
     * @param array|null $options
     * @return string
     */
    public function getFileUrlById($id, int $expires = 3600 * 24 * 365, ?array $options = []): string
    {
        try {
            $fileModel = $this->getFile($id);

            return $this->getFileUrl($fileModel, $expires, $options);
        } catch (Exception $e) {
            return '';
        }
    }
}
