<?php

namespace apps\core\classier\service;

use apps\core\classier\bean\ResourceListCondition;
use apps\core\classier\dao\master\ResourceDao;
use apps\core\classier\enum\resource\FileType;
use apps\core\classier\model\AppResourceModel;
use apps\core\classier\wrapper\resource\ImageOptions;
use apps\core\classier\wrapper\resource\VideoOptions;
use apps\core\classier\wrapper\ResourceWrapper;
use apps\file\classier\config\FileConfig;
use apps\file\classier\service\file\OssFileManagerService;
use apps\file\classier\service\IFileManagerService;
use apps\file\classier\service\MediaService;
use Exception;
use rapidPHP\modules\common\classier\Instances;
use function rapidPHP\DI;

class ResourceService
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
     * 获取资源列表
     * @param ResourceListCondition $condition
     * @return ResourceWrapper[]|null
     * @throws Exception
     */
    public function getResources(ResourceListCondition $condition): ?array
    {
        if (empty($condition->getBindId())) throw new Exception('bindId 错误!');

        /** @var ResourceDao $resourceDao */
        $resourceDao = ResourceDao::getInstance();

        $list = $resourceDao->getResources($condition);

        foreach ($list as $item) {
            $item->setUrl(FileConfig::getFileUrl($item->getFileId()));

            switch ($item->getFileType()) {
                case FileType::PIC:
                    $item->optionsToImageOptions();
                    break;
                case FileType::VIDEO:
                    $options = $item->optionsToVideoOptions();

                    if ($options instanceof VideoOptions) {
                        $options->setCoverUrl(FileConfig::getFileUrl($options->getCoverFid()));
                    }
                    break;
            }

        }

        return $list;
    }


    /**
     * 获取资源
     * @param ResourceListCondition $condition
     * @return ResourceWrapper|null
     * @throws Exception
     * @tshrows Exception
     */
    public function getResource(ResourceListCondition $condition)
    {
        $condition->setPage(1);

        $condition->setSize(1);

        $list = $this->getResources($condition);

        if (empty($list)) return null;

        return $list[0];
    }


    /**
     * 获取资源
     * @param $resourceId
     * @return ResourceWrapper
     * @throws Exception
     */
    public function getResourceById($resourceId)
    {
        if (empty($resourceId)) throw new Exception('资源id 错误!');

        /** @var ResourceDao $resourceDao */
        $resourceDao = ResourceDao::getInstance();

        $resourceModel = $resourceDao->getResource($resourceId);

        if ($resourceModel == null) throw new Exception('资源不存在!');

        return $resourceModel;
    }

    /**
     * 添加资源
     * @param ResourceWrapper $resourceModel
     * @throws Exception
     */
    public function addResource(ResourceWrapper $resourceModel)
    {
        if (empty($resourceModel->getFileId())) throw new Exception('资源文件id 错误!');

        if (empty($resourceModel->getFileType())) throw new Exception('资源文件类型 错误!');

        if (empty($resourceModel->getBindId())) throw new Exception('资源绑定id 错误!');

        if (empty($resourceModel->getBindType())) throw new Exception('资源绑定类型 错误!');

        if (empty($resourceModel->getOwnerId())) throw new Exception('资源所有者 错误!');

        /** @var IFileManagerService $fileManagerService */
        $fileManagerService = DI(IFileManagerService::class);

        $fileModel = $fileManagerService->getFile($resourceModel->getFileId());

        if (is_file($fileModel->getPath())) {
            $filepath = $fileModel->getPath();
        } else {
            $filepath = OssFileManagerService::getInstance()
                ->getFileUrl($fileModel);
        }

        switch ($resourceModel->getFileType()) {
            case FileType::PIC:

                /** @var ImageOptions $videoOptions */
                $imageOptions = $resourceModel->optionsToImageOptions();

                if (!($imageOptions instanceof ImageOptions)) $imageOptions = new ImageOptions();

                $property = MediaService::getInstance()
                    ->getProperty($filepath);

                if (!$property) throw new Exception('资源错误!');

                $dimensions = $property->getDimensions();

                $imageOptions->setWidth($dimensions->getWidth());

                $imageOptions->setHeight($dimensions->getHeight());

                if ($imageOptions->getWidth() <= 0) throw new Exception('图片宽度错误！');

                if ($imageOptions->getHeight() <= 0) throw new Exception('图片高度错误！');

                $resourceModel->setOptions($imageOptions);
                break;
            case FileType::VIDEO:

                /** @var VideoOptions $videoOptions */
                $videoOptions = $resourceModel->optionsToVideoOptions();

                if (!($videoOptions instanceof VideoOptions)) $videoOptions = new VideoOptions();

                $duration = MediaService::getInstance()->getDuration($filepath);

                $videoOptions->setDuration($duration);

                if ($videoOptions->getDuration() < 1) throw new Exception('视频时间不能少于1秒!');

                if ($videoOptions->getDuration() > SettingService::getVideoLD()) throw new Exception('视频时间超出限制!');

                if (empty($videoOptions->getCoverFid())) {
                    $coverFileModel = MediaService::getInstance()
                        ->getCoverFileModel($filepath, 0, $resourceModel->getCreatedId());

                    if (is_file($coverFileModel->getPath())) {
                        $coverFilepath = $fileModel->getPath();
                    } else {
                        $coverFilepath = OssFileManagerService::getInstance()
                            ->getFileUrl($coverFileModel);
                    }

                    $videoOptions->setCoverFid($coverFileModel->getId());

                    $videoOptions->setCoverUrl(FileConfig::getFileUrl($coverFileModel->getId()));

                    $coverDimensions = MediaService::getInstance()
                        ->getProperty($coverFilepath)
                        ->getDimensions();

                    $videoOptions->setWidth($coverDimensions->getWidth());

                    $videoOptions->setHeight($coverDimensions->getHeight());
                }

                if ($videoOptions->getWidth() <= 0) throw new Exception('视频宽度错误！');

                if ($videoOptions->getHeight() <= 0) throw new Exception('视频高度错误！');

                $resourceModel->setOptions($videoOptions);

                break;
            default:
                throw new Exception('绑定类型错误!');
        }

        /** @var ResourceDao $resourceDao */
        $resourceDao = ResourceDao::getInstance();

        if (!$resourceDao->addResource($resourceModel)) throw new Exception('添加资源失败!');
    }


    /**
     * 通过bind id 删除全部资源
     * @param $informationId
     * @param null $actionId
     * @throws Exception
     */
    public function delAllResourceByBindId($informationId, $actionId = null)
    {
        if (empty($informationId)) throw new Exception('资源id 错误!');

        /** @var ResourceDao $resourceDao */
        $resourceDao = ResourceDao::getInstance();

        if (!$resourceDao->delAllResourceByBindId($informationId, $actionId)) throw new Exception('删除资源失败!');
    }

    /**
     * 删除资源
     * @param AppResourceModel $resourceModel
     * @throws Exception
     */
    public function delResource(AppResourceModel $resourceModel)
    {
        if (empty($resourceModel->getId())) throw new Exception('资源id 错误!');

        /** @var ResourceDao $resourceDao */
        $resourceDao = ResourceDao::getInstance();

        if (!$resourceDao->delResource($resourceModel, $resourceModel->getUpdatedId())) throw new Exception('删除资源失败!');
    }
}
