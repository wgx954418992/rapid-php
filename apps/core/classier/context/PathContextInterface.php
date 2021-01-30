<?php

namespace apps\core\classier\context;

interface PathContextInterface
{

    /**
     * 获取文件url地址
     * @param $fileId
     * @return string
     */
    public function getFileUrl($fileId): string;
}