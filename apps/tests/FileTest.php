<?php

namespace apps\tests;

use apps\core\classier\model\AppFileModel;
use apps\file\classier\service\IFileManagerService;
use Exception;
use function rapidPHP\DI;

class FileTest extends BaseTest
{

    /**
     * 测试添加webp
     * @return AppFileModel|null
     * @throws Exception
     */
    public function testAddWebp(&$url = null)
    {
        $file = new AppFileModel([
            'path' => __DIR__ . '/video.webp'
        ]);

        /** @var IFileManagerService $fileManagerService */
        $fileManagerService = DI(IFileManagerService::class);

        $fileModel = $fileManagerService->upload($file);

        $this->assertNotEmpty($fileModel);

        $url = $fileManagerService->getFileUrl($fileModel);

        $this->assertNotEmpty($url);

        return $fileModel;
    }

    /**
     * 测试添加jpg
     * @return AppFileModel|null
     * @throws Exception
     */
    public function testAddJpg(&$url = null)
    {
        $file = new AppFileModel([
            'path' => __DIR__ . '/video.jpg'
        ]);

        /** @var IFileManagerService $fileManagerService */
        $fileManagerService = DI(IFileManagerService::class);

        $fileModel = $fileManagerService->upload($file);

        $this->assertNotEmpty($fileModel);

        $url = $fileManagerService->getFileUrl($fileModel);

        $this->assertNotEmpty($url);

        return $fileModel;
    }

    /**
     * 测试添加视频
     * @return AppFileModel|null
     * @throws Exception
     */
    public function testAddVideo(&$url = null)
    {
        $file = new AppFileModel([
            'path' => __DIR__ . '/video.mp4'
        ]);

        /** @var IFileManagerService $fileManagerService */
        $fileManagerService = DI(IFileManagerService::class);

        $fileModel = $fileManagerService->upload($file);

        $this->assertNotEmpty($fileModel);

        $url = $fileManagerService->getFileUrl($fileModel);

        $this->assertNotEmpty($url);

        return $fileModel;
    }
}
