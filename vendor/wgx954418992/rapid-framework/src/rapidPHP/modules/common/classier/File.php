<?php

namespace rapidPHP\modules\common\classier;

use Generator;

class File
{

    /**
     * OPTIONS
     */
    const OPTIONS_NONE = 1;

    /**
     * 包含子目录
     */
    const OPTIONS_SUBDIRECTORY = self::OPTIONS_NONE << 1;

    /**
     * 包含 目录
     */
    const OPTIONS_DIR = self::OPTIONS_NONE << 2;

    /**
     * 包含 隐藏目录、隐藏文件
     */
    const OPTIONS_HIDDEN = self::OPTIONS_NONE << 3;

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
        return new static();
    }

    /**
     * 读取目录列表
     * @param $dir :目录
     * @param int $options
     * @return array|Generator 返回生成器，请用foreach读取
     */
    public function readDirList($dir, int $options = self::OPTIONS_SUBDIRECTORY | self::OPTIONS_HIDDEN)
    {
        if (!file_exists($dir)) return [];

        $dir = rtrim($dir, '/*');

        if ($handle = opendir($dir)) {

            while (false !== ($file = readdir($handle))) {

                if ($file == '.' || $file == '..') continue;

                if (($options & self::OPTIONS_HIDDEN) === 0 && substr(basename($file), 0, 1) == '.') {
                    continue;
                }

                $dirPath = $dir . '/' . $file;

                if (is_dir($dirPath)) {
                    yield $dirPath;

                    if (($options & self::OPTIONS_SUBDIRECTORY) === 0) {
                        continue;
                    }

                    $sub = $this->readDirList($dirPath, $options);

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
     * @param int $options
     * @return Generator|void 返回生成器，请用foreach读取
     */
    public function readDirFiles($path, int $options = self::OPTIONS_SUBDIRECTORY | self::OPTIONS_HIDDEN): Generator
    {
        $path = rtrim($path, '/*');

        if (!is_readable($path)) return;

        $dh = opendir($path);

        while (($file = readdir($dh)) !== false) {
            if ($file == '.' || $file == '..') continue;

            if (($options & self::OPTIONS_HIDDEN) === 0 && substr(basename($file), 0, 1) == '.') {
                continue;
            }

            $filePath = $path . DIRECTORY_SEPARATOR . $file;

            if (is_dir($filePath)) {

                if (($options & self::OPTIONS_SUBDIRECTORY) === 0) {
                    continue;
                }

                $sub = $this->readDirFiles($filePath, $options);

                while ($sub->valid()) {
                    yield $sub->current();

                    $sub->next();
                }

                if ($options & self::OPTIONS_DIR) {
                    yield $file => $filePath;
                }
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
     * @return bool
     */
    public function write($filePath, $data, string $mode = 'w+'): bool
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
     * @param $context
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
     * @param $context
     * @return bool|string
     */
    public function getContent($filePath, $context = null)
    {
        if (!file_exists($filePath) || !is_file($filePath) || !is_readable($filePath)) return null;

        return file_get_contents($filePath, null, $context);
    }

    /**
     * 删除目录
     * @param $path
     * @return bool
     */
    public function rmdir($path): bool
    {
        $path = rtrim($path, '/*');

        if (!is_readable($path)) return false;

        $dh = opendir($path);

        while (($file = readdir($dh)) !== false) {
            if ($file == '.' || $file == '..') continue;

            $filePath = $path . DIRECTORY_SEPARATOR . $file;

            if (is_dir($filePath)) {
                if (!$this->rmdir($filePath)) return false;
            } else if (is_file($filePath)) {
                @unlink($filePath);
            }
        }

        closedir($dh);

        @rmdir($path);

        return true;
    }

    /**
     * 获取大于2g文件的文件大小
     * @param $path
     * @return bool|int|string
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
