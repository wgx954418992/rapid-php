<?php

namespace rapidPHP\library;

use Generator;
use rapid\library\rapid;

class File
{

    private static $instance;

    public static function getInstance()
    {
        return self::$instance instanceof self ? self::$instance : self::$instance = new self();
    }

    /**
     * 读取目录列表
     * @param $dir :目录
     * @param bool $isNext 是否读取目录的目录
     * @return array|Generator 返回生成器，请用foreach读取
     */
    public function readDirList($dir, $isNext = true)
    {
        if (!file_exists($dir)) return [];

        $dir = rtrim($dir, '/*');

        if ($handle = opendir($dir)) {

            while (false !== ($file = readdir($handle))) {

                if (substr($file, 0, 1) == '.') continue;

                $dirPath = $dir . '/' . $file;

                if (is_dir($dirPath)) {
                    yield $dirPath;

                    if (!$isNext) continue;

                    $sub = $this->readDirList($dirPath);

                    while ($sub->valid()) {
                        yield $sub->current();

                        $sub->next();
                    }
                }
            }

            closedir($handle);
        }
    }

    /**
     * 利用生成器读取目录文件
     * @param $path :路径
     * @param bool $isDir 是否包含目录
     * @return Generator|void 返回生成器，请用foreach读取
     */
    public function readDirFiles($path, $isDir = false)
    {
        $path = rtrim($path, '/*');

        if (!is_readable($path)) return;

        $dh = opendir($path);

        while (($file = readdir($dh)) !== false) {
            if (substr($file, 0, 1) == '.') continue;

            $filePath = $path . DIRECTORY_SEPARATOR . $file;

            if (is_dir($filePath)) {
                $sub = $this->readDirFiles($filePath, $isDir);

                while ($sub->valid()) {
                    yield $sub->current();

                    $sub->next();
                }

                if ($isDir) yield $filePath;
            } else {
                yield $filePath;
            }
        }

        closedir($dh);
    }


    /**
     * 写到文件
     * @param $filePath
     * @param $data
     * @param string $mode
     * @return bool|int
     */
    public function write($filePath, $data, $mode = 'w+')
    {
        if ($open = fopen($filePath, $mode)) {

            fwrite($open, $data);

            fclose($open);

            return true;
        }

        return false;
    }


    /**
     * 读取文件内容
     * @param $filePath
     * @param null $context
     * @return bool|string
     */
    public function getContentOrHttp($filePath, $context = null)
    {
        if (is_file($filePath)) return $this->getContent($context);

        if (V()->website($filePath)) return B()->getHttpResponse($filePath);

        return false;
    }

    /**
     * 读取文件内容
     * @param $filePath
     * @param null $context
     * @return bool|string
     */
    public function getContent($filePath, $context = null)
    {
        if (!file_exists($filePath) || !is_file($filePath) || !is_readable($filePath)) return null;

        return file_get_contents($filePath, null, $context);
    }

}
