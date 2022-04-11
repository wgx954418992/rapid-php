<?php


namespace apps\core\classier\options;


use rapidPHP\modules\options\classier\Options;

class CourseOptions extends Options
{

    /**
     * 课程信息 可选条件
     */
    const OPTIONS = 1;

    /**
     * 课程信息 可选条件 专业
     */
    const MAJOR = self::OPTIONS << 1;

    /**
     * 课程信息 可选条件 具体专业
     */
    const SPECIFIC_MAJOR = self::OPTIONS << 2;
}
