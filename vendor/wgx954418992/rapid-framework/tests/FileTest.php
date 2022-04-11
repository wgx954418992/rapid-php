<?php


use PHPUnit\Framework\TestCase;
use rapidPHP\modules\common\classier\File;
use rapidPHP\modules\core\classier\Model;
use rapidPHP\modules\database\sql\classier\SQLDB;


class FileTest extends TestCase
{

    /**
     * 测试读取目录
     */
    public function testReadDir()
    {
        $excludeHiddenFile = 0;

        $files = File::getInstance()->readDirList(dirname(__DIR__), File::OPTIONS_NONE);

        foreach ($files as $file) {
            echo $file . PHP_EOL;

            $excludeHiddenFile++;
        }

        echo PHP_EOL . PHP_EOL . PHP_EOL;

        $includeHiddenFile = 0;

        $files = File::getInstance()->readDirList(dirname(__DIR__), File::OPTIONS_HIDDEN);

        foreach ($files as $file) {
            echo $file . PHP_EOL;

            $includeHiddenFile++;
        }

        $this->assertEquals($excludeHiddenFile + $includeHiddenFile, 8);
    }

    /**
     * 测试读取文件
     */
    public function testReadFiles()
    {
        if (is_file(__DIR__ . '/.DS_Store')) unlink(__DIR__ . '/.DS_Store');

        $excludeHiddenFile = 0;

        $files = File::getInstance()->readDirFiles(__DIR__, File::OPTIONS_SUBDIRECTORY);

        foreach ($files as $file) {
            echo $file . PHP_EOL;

            $excludeHiddenFile++;
        }

        echo PHP_EOL . PHP_EOL . PHP_EOL;

        $includeHiddenFile = 0;

        $files = File::getInstance()->readDirFiles(__DIR__, File::OPTIONS_SUBDIRECTORY | File::OPTIONS_HIDDEN);

        foreach ($files as $file) {
            echo $file . PHP_EOL;

            $includeHiddenFile++;
        }

        $this->assertEquals($excludeHiddenFile + $includeHiddenFile, 7);
    }
}
