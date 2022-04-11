<?php


namespace apps\admin\classier\options;


use rapidPHP\modules\options\classier\Options;

class AdminOptions extends Options
{

    /**
     * options 开始
     */
    const OPTIONS = 1;

    /**
     * options 获取创建者
     */
    const OPTIONS_CREATOR = self::OPTIONS << 1;

    /**
     * options 获取子账号数量
     */
    const OPTIONS_CHILD_COUNT = self::OPTIONS << 2;

    /**
     * options 获取管理员权限list
     */
    const OPTIONS_ACCESS_LIST = self::OPTIONS << 3;
}
