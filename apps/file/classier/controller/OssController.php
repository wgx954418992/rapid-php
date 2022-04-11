<?php


namespace apps\file\classier\controller;

use apps\core\classier\config\AcceptConfig;
use apps\core\classier\model\AppFileModel;
use apps\file\classier\config\FileConfig;
use apps\file\classier\model\oss\aliyun\CallbackModel as AliYunCallbackModel;
use apps\file\classier\service\file\OssFileManagerService;
use Exception;
use rapidPHP\modules\common\classier\RESTFulApi;
use rapidPHP\modules\core\classier\web\WebController;

class OssController extends WebController
{

    /**
     * 阿里云oss 上传完成回调
     * @route /oss/aliyun/callback
     * @typed api
     * @param AliYunCallbackModel $model
     * @return RESTFulApi
     * @throws Exception
     */
    public function callbackByAliYun(AliYunCallbackModel $model)
    {
        if (!AcceptConfig::valid((string)$model->getMimeType(), array_merge(AcceptConfig::IMAGE, AcceptConfig::VIDEO))) {
            throw new Exception('不支持mime格式' . $model->getMimeType());
        }

        $fileModel = new AppFileModel();

        $fileModel->setMime($model->getMimeType());

        $fileModel->setPath($model->getObject());

        $fileModel->setMd5($model->getEtag());

        $fileModel->setName(basename($model->getObject()));

        $fileModel->setSize($model->getSize());

        $fileModel->setOptions([
            'width' => $model->getImageInfoWidth(),
            'height' => $model->getImageInfoHeight(),
        ]);

        /** @var OssFileManagerService $fileManagerService */
        $fileManagerService = OssFileManagerService::getInstance();

        $fileModel = $fileManagerService->addFile($fileModel);

        return RESTFulApi::success([
            'file_id' => $fileModel->getId(),
            'url' => FileConfig::getFileUrl($fileModel->getId()),
            'file' => $fileModel,
        ]);
    }

}
