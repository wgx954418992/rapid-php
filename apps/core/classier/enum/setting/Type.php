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
     * 设置OSS名称，oss
     */
    const OSS = 'OSS';

    /**
     * 设置MEDIA名称，media
     */
    const MEDIA = 'MEDIA';

    /**
     * 设置REPORT名称，举报
     */
    const REPORT = 'REPORT';

    /**
     * 设置INTEGRAL名称，积分规则
     */
    const INTEGRAL_RULE = 'INTEGRAL_RULE';
}
