<?php


namespace apps\core\classier\options;


use rapidPHP\modules\options\classier\Options;

class CMSArticleOptions extends Options
{

    /**
     * cms 文章 可选条件
     */
    const OPTIONS = 1;

    /**
     *  cms 文章 可选条件 栏目信息
     */
    const COLUMN = self::OPTIONS << 1;
}
