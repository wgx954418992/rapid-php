<?php


namespace apps\core\classier\enum\setting\attribute;


use apps\core\classier\enum\setting\IAttribute;

class Report extends IAttribute
{

    /**
     * 设置type名称，每个用户每天举报多少次
     */
    const TODAY_COUNT = 'TODAY_COUNT';
}
