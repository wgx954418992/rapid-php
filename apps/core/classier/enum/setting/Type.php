<?php


namespace apps\core\classier\enum\setting;


use enum\classier\Enum;

class Type extends Enum
{

    /**
     * 设置type名称，文件
     */
    const FILE = 'FILE';

    /**
     * 设置type名称，app版本
     */
    const APP_VERSION = 'APP_VERSION';

    /**
     * 设置type名称，app下载链接
     */
    const APP_DOWNLOAD = 'APP_DOWNLOAD';
}
