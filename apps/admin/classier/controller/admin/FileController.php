<?php


namespace apps\admin\classier\controller\admin;

use apps\admin\classier\context\PathContext;
use apps\app\classier\context\UserContext;
use apps\core\classier\config\ErrorConfig;
use apps\core\classier\context\PathContextInterface;
use apps\core\classier\service\FileService;
use apps\core\classier\service\SettingService;
use Exception;
use rapidPHP\modules\common\classier\RESTFulApi;
use function rapidPHP\B;

/**
 * Class FileController
 * @route /admin
 * @package apps\admin\classier\controller\admin
 */
class FileController extends ValidaAdminController
{

    /**
     * 获取文件流
     * @route /file/{fileId}
     * @method get
     * @param int|string $fileId
     * @param $download
     */
    public function getFileStream($fileId, $download)
    {
        try {
            $fileInfo = FileService::getInstance()->getFile($fileId);

            $this->getResponse()->printFile($fileInfo->getPath(), [
                'mime' => $fileInfo->getMime(),
                'download' => $download,
                'filename' => $fileInfo->getName(),
                'cache-expire' => 3600 * 24 * 365,
            ]);

        } catch (Exception $e) {
            switch ($e->getCode()) {
                case ErrorConfig::FILE_NOT:
                    $this->getResponse()->status(404);
                    break;
                case ErrorConfig::FILE_NOT_POWER:
                    $this->getResponse()->status(403);
                    break;
            }
        }
    }

    /**
     * 上传文件
     * @route /file/upload
     * @method post
     * @typed api
     * @param PathContextInterface $pathContext
     * @param UserContext $userContext
     * @param array $file file
     * @return RESTFulApi
     * @throws Exception
     */
    public function uploadFile(PathContextInterface $pathContext, UserContext $userContext, array $file)
    {
        $error = (int)B()->getData($file, 'error');

        switch ($error) {
            case 1:
                throw new Exception('上传文件太大了!');
            case 2:
                throw new Exception('上传文件太大了(MAX_FILE_SIZE)!');
            case 3:
                throw new Exception('文件只有部分被上传!');
            case 4:
                throw new Exception('没有文件被上传!');
            case 6:
                throw new Exception('找不到临时文件夹!');
            case 7:
                throw new Exception('文件写入失败!');
        }

        $tmpFile = B()->getData($file, 'tmp_name');

        $fileName = B()->getData($file, 'name');

        if (empty($tmpFile) || !is_file($tmpFile)) throw new Exception('文件错误!');

        $filePath = SettingService::getStoragePath(md5_file($tmpFile));

        if (!@move_uploaded_file($tmpFile, $filePath)) throw new Exception('上传失败');

        if (empty($fileName)) $fileName = basename($filePath);

        $currentUser = $userContext->getCurrentUser();

        $fileModel = FileService::getInstance()->addFile($currentUser ? $currentUser->getId() : null, $filePath, $fileName);

        $result = [
            'filename' => $fileModel->getName(),
            'file_id' => $fileModel->getId(),
            'url' => $pathContext->getFileUrl($fileModel->getId())
        ];

        return RESTFulApi::success($result);
    }
}