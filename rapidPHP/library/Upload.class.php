<?php

namespace rapidPHP\library;

use Exception;
use rapid\library\rapid;

class Upload
{

    private static $limits = ['image/png' => 'png', 'image/jpg' => 'jpg', 'image/gif' => 'gif', 'image/jpeg' => 'jpeg'], $size;


    public function __construct($limits = [], $size = null)
    {
        $this->setLimit($limits);

        $this->setSize($size === null ? 1024 * 1024 * 2 : $size);
    }

    /**
     * 设置上传文件类型
     * @param $limit
     * @return $this
     */
    public function setLimit($limit)
    {
        foreach ($limit as $key => $value) {
            self::$limits[$key] = $value;
        }

        return $this;
    }

    /**
     * 删除上传文件限制
     * @param $name
     * @return $this
     */
    public function deleteLimit($name)
    {
        if (isset(self::$limits[$name])) unset(self::$limits[$name]);

        return $this;
    }

    /**
     * 获取上传文件类型限制
     * @return array
     */
    public function getLimit()
    {
        return self::$limits;
    }

    /**
     * 设置上传文件大小
     * @param $size
     * @return $this
     */
    public function setSize($size)
    {
        self::$size = $size;

        return $this;
    }

    /**
     * 获取上传文件大小
     * @return int
     */
    public function getSize()
    {
        return self::$size;
    }

    /**
     * 创建目录
     * @param $path {路径}
     * @param int $mode
     * @param bool $recursive
     * @param null $context
     * @return bool
     */
    public function mkdir($path, $mode = 0777, $recursive = true, $context = null)
    {
        if (!is_dir($path)) return mkdir($path, $mode, $recursive, $context);

        return true;
    }

    /**
     * 根据用户传入的生成文件地址
     * @param $path
     * @param null $name
     * @param null $ext
     * @return string
     */
    public function makeFilePath($path, $name = null, $ext = null)
    {
        if ($name === null && $ext != null) {

            return $path . time() . '.' . $ext;
        } else if ($name != null && $ext === null) {

            return $path . $name;
        }

        return $path;
    }

    /**
     * 上传文件
     * @param $file {$_FILES[$name]} 文件key
     * @param $path {上传路径 or 上传文件名}
     * @param null $fileName {$文件名}
     * @param null $ext {$文件后缀}
     * @return int
     * @throws Exception
     */
    public function upload($file, $path, $fileName = null, $ext = null)
    {
        if (empty($path)) throw new Exception('路径错误!');

        if (empty($file)) throw new Exception('文件错误!');

        $size = (int)B()->getData($file,'size');

        $type = B()->getData($file,'type');

        $tmp = B()->getData($file,'tmp_name');

        if (empty($size) || empty($type) || empty($tmp)) throw new Exception('文件参数有问题');

        if ($size > self::getSize()) throw new Exception('文件大小错误');

        if (!$typeName = B()->getData(self::getLimit(), $type)) throw new Exception('文件类型错误');

        if (!$this->mkdir($path)) throw new Exception('创建目录失败');

        $filePath = $this->makeFilePath($path, $fileName, $ext ? $ext : $typeName);

        if (!@move_uploaded_file($tmp, $filePath)) throw new Exception('上传失败');

        return $filePath;
    }

}