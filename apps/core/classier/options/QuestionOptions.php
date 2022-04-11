<?php


namespace apps\core\classier\options;


use rapidPHP\modules\options\classier\Options;

class QuestionOptions extends Options
{

    /**
     * 课程信息 可选条件
     */
    const OPTIONS = 1;

    /**
     * 题信息 可选条件 课程信息
     */
    const COURSE = self::OPTIONS << 1;
}
