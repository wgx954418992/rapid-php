<?php


namespace apps\file\classier\controller;

use apps\core\classier\config\AcceptConfig;
use apps\core\classier\model\AppFileModel;
use apps\core\classier\service\SettingService;
use apps\file\classier\config\FileConfig;
use apps\file\classier\context\UserContext;
use apps\file\classier\model\PHPFileModel;
use apps\file\classier\service\IFileManagerService;
use apps\file\classier\service\MediaService;
use Exception;
use rapidPHP\modules\common\classier\Math;
use rapidPHP\modules\common\classier\RESTFulApi;
use rapidPHP\modules\core\classier\web\WebController;
use function rapidPHP\DI;


class UploadController extends WebController
{

    /**
     * 图片限制的大小（阿里云oss 超过20m的图片无法处理）
     */
    const IMAGE_LIMIT_SIZE = 1024 * 1024 * 20;

    /**
     * 视频限制的大小
     */
    const VIDEO_LIMIT_SIZE = 1024 * 1024 * 200;

    /**
     * 上传文件
     * @route /file/upload
     * @method post
     * @method get
     * @param PHPFileModel $file file
     * @param UserContext|null $userContext
     * @return RESTFulApi
     * @throws Exception
     */
    public function upload(PHPFileModel $file, UserContext $userContext = null)
    {
        if (!$file->isValid()) throw new Exception('文件无效');

        $errorInfo = $file->getErrorInfo();

        if ($errorInfo != null) throw new Exception($errorInfo);

        if (AcceptConfig::valid($file->getFileMime(), AcceptConfig::IMAGE)) {

            if ($file->getSize() > self::IMAGE_LIMIT_SIZE) {
                throw new Exception('图片不能超过' . Math::getTextBySize(self::IMAGE_LIMIT_SIZE));
            }

            if ($file->getFileMime() != AcceptConfig::IMAGE_MIME_WEBP) {
                $tmpFilepath = MediaService::getInstance()->toWebp($file->getTmpName());

                if (!$tmpFilepath) throw new Exception('转换webp失败!');

                $file->setTmpName($tmpFilepath);
            }
        } else if (AcceptConfig::valid($file->getFileMime(), AcceptConfig::VIDEO)) {
            if ($file->getSize() > self::VIDEO_LIMIT_SIZE) {
                throw new Exception('视频不能超过' . Math::getTextBySize(self::VIDEO_LIMIT_SIZE));
            }

            $duration = MediaService::getInstance()->getDuration($file->getTmpName());

            if ($duration > SettingService::getVideoLD()) throw new Exception('视频时长超出限制!');
        } else {
            throw new Exception('文件格式错误！' . $file->getFileMime());
        }

        $fileModel = new AppFileModel();

        $fileModel->setPath($file->getTmpName());

        $fileModel->setMd5($file->getHash('MD5'));

        $fileModel->setMime($file->getFileMime());

        $fileModel->setSize($file->getSize());

        $fileModel->setName($file->getName());

        $fileModel->setCreatedId($userContext ? $userContext->getId() : null);

        $fileModel->setUpdatedId($userContext ? $userContext->getId() : null);

        /** @var IFileManagerService $fileManagerService */
        $fileManagerService = DI(IFileManagerService::class);

        $fileModel = $fileManagerService->upload($fileModel);

        return RESTFulApi::success([
            'filename' => $fileModel->getName(),
            'file_id' => $fileModel->getId(),
            'mime' => $fileModel->getMime(),
            'url' => FileConfig::getFileUrl($fileModel->getId())
        ]);
    }
}
