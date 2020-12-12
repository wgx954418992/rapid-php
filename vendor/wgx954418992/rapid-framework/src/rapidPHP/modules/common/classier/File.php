<?php

namespace rapidPHP\modules\common\classier;

use Generator;

class File
{

    /**
     * 采用单例模式
     */
    use Instances;

    /**
     * 实例不存在
     * @return static
     */
    public static function onNotInstance()
    {
        return new static(...func_get_args());
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
    public function readDirFiles($path, $isDir = false): Generator
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

                if ($isDir) yield $file => $filePath;
            } else {
                yield $file => $filePath;
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

        if (Verify::getInstance()->website($filePath)) {
            return Http::getInstance()->getHttpResponse($filePath);
        }

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

    /**
     * 获取大于2g文件的文件大小
     * @param $path
     * @return bool|false|int|string
     */
    public function getMaxFileSize($path)
    {
        if (!file_exists($path)) return false;

        $size = filesize($path);

        if (!($file = fopen($path, 'rb'))) return false;

        //Check if it really is a small file (< 2 GB)
        if ($size >= 0) {
            //It really is a small file

            if (fseek($file, 0, SEEK_END) === 0) {
                fclose($file);

                return $size;
            }
        }

        //Quickly jump the first 2 GB with fseek. After that fseek is not working on 32 bit php (it uses int internally)
        $size = PHP_INT_MAX - 1;

        if (fseek($file, PHP_INT_MAX - 1) !== 0) {
            fclose($file);

            return false;
        }

        $read = null;

        $length = 1024 * 1024;

        //Read the file until end
        while (!feof($file)) {
            $read = fread($file, $length);

            $size = bcadd($size, $length);
        }

        $size = bcsub($size, $length);

        $size = bcadd($size, strlen($read));

        fclose($file);

        return $size;
    }
}
