<?php


namespace apps\file\classier\controller;

use apps\core\classier\enum\ErrorCode;
use apps\file\classier\service\file\OssFileManagerService;
use apps\file\classier\service\IFileManagerService;
use apps\oss\classier\service\IOssService;
use Exception;
use rapidPHP\modules\application\classier\Application;
use rapidPHP\modules\core\classier\web\WebController;
use function rapidPHP\DI;

class OutputController extends WebController
{


    /**
     * 获取文件流
     * @route /file/{fileId}(.mp4|)
     * @method get
     * @param int|string $fileId
     */
    public function getFileStream($fileId)
    {
        try {
            Application::getInstance()
                ->logger(Application::LOGGER_ACCESS)
                ->info("-{$this->getRequest()->getIp()} -{$this->getRequest()->getMethod()} -{$this->getRequest()->getUrl(true)}");

            /** @var IFileManagerService $fileManagerService */
            $fileManagerService = DI(IFileManagerService::class);

            $fileModel = $fileManagerService->getFile($fileId);

            if (is_file($fileModel->getPath())) {
                $this->getResponse()->header('Content-Type: ' . $fileModel->getMime());

                $this->getResponse()->sendFile($fileModel->getPath());
            } else {
                $options = [];

                $process = $this->getRequest()->get(IOssService::OSS_PROCESS);

                if (!empty($process)) $options[IOssService::OSS_PROCESS] = $process;

                $this->getResponse()->redirect($fileManagerService->getFileUrl($fileModel, 3600 * 24 * 365, $options));
            }
        } catch (Exception $e) {

            switch ($e->getCode()) {
                case ErrorCode::FILE_NOT:
                    $this->getResponse()->status(404);
                    break;
                case ErrorCode::FILE_NOT_POWER:
                    $this->getResponse()->status(403);
                    break;
            }
        }
    }
}
