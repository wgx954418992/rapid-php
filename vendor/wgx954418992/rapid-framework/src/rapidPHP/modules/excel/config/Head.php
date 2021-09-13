<?php

namespace rapidPHP\modules\excel\config;

use PhpOffice\PhpSpreadsheet\Style\Alignment;
use rapidPHP\modules\common\classier\Build;

class Head
{
    /**
     * head 名称
     */
    const HEAD_NAME = 'name';

    /**
     * head 宽度
     */
    const HEAD_WIDTH = 'width';

    /**
     * head 垂直居中方式，默认 Alignment::VERTICAL_CENTER
     */
    const HEAD_VERTICAL = 'vertical';

    /**
     * head 水平居中方式，默认 Alignment::HORIZONTAL_CENTER
     */
    const HEAD_HORIZONTAL = 'horizontal';

    /**
     * 是否wrapText
     */
    const HEAD_WRAP_TEXT = 'wrap_text';

    /**
     * 获取name
     * @param $head
     * @return string
     */
    public static function getName($head)
    {
        return is_array($head) ? (string)Build::getInstance()->getData($head, self::HEAD_NAME) : (string)$head;
    }

    /**
     * 获取宽度
     * @param $head
     * @return int
     */
    public static function getWidth($head)
    {
        if (!is_array($head)) return false;

        if (!array_key_exists(self::HEAD_WIDTH, $head)) return false;

        return (int)$head[self::HEAD_WIDTH];
    }

    /**
     * 获取 垂直居中方式
     * @param $head
     * @return string
     */
    public static function getAlignVertical($head)
    {
        if (!is_array($head)) return Alignment::VERTICAL_CENTER;

        return (string)Build::getInstance()->contrast(Build::getInstance()->getData($head, self::HEAD_VERTICAL), Alignment::VERTICAL_CENTER);
    }

    /**
     * 获取 水平居中方式
     * @param $head
     * @return string
     */
    public static function getAlignHorizontal($head)
    {
        if (!is_array($head)) return Alignment::HORIZONTAL_CENTER;

        return (string)Build::getInstance()
            ->contrast(Build::getInstance()->getData($head, self::HEAD_HORIZONTAL), Alignment::HORIZONTAL_CENTER);
    }

    /**
     * 获取 是否wrapText
     * @param $head
     * @return string
     */
    public static function getWrapText($head)
    {
        if (!is_array($head)) return true;

        return array_key_exists(self::HEAD_WRAP_TEXT, $head) ? $head[self::HEAD_WRAP_TEXT] : true;
    }
}