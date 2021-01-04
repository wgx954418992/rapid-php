<?php


namespace apps\core\classier\config;


class AcceptConfig
{

    /**
     * 图片文件
     * @var int[]
     */
    public static $IMAGE = [
        'image/jpg' => '.jpg',
        'image/jpeg' => '.jpeg',
        'image/png' => '.png',
        'image/bmp' => '.bmp',
    ];

    /**
     * pdf文件
     * @var int[]
     */
    public static $PDF = [
        'application/pdf' => '.pdf',
    ];

    /**
     * WORD
     * @var int[]
     */
    public static $WORD = [
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => [
            '.docx'
        ],
        'application/msword' => [
            '.wps',
            '.wpt',
            '.doc',
            '.dot',
        ],
        'application/CDFV2' => [
            '.doc',
        ],
    ];

    /**
     * Excel
     * @var int[]
     */
    public static $EXCEL = [
        'application/vnd.ms-excel' => [
            '.xla',
            '.xlc',
            '.xlm',
            '.xls',
            '.xls',
            '.xlt',
            '.xlw',
            '.xlsx',
        ],
    ];

    /**
     * PPT
     * @var int[]
     */
    public static $PPT = [
        'application/vnd.ms-powerpoint' => [
            '.pot',
            '.pps',
            '.ppt',
            '.pptx',
        ],
    ];


    /**
     * 效验
     * @param string $fileMime
     * @param null $rule
     * @return bool
     */
    public static function valid(string $fileMime, $rule = null): bool
    {
        if (empty($fileMime)) return false;

        $fileMime = strtolower($fileMime);

        $rule = is_null($rule) ? array_merge(self::$IMAGE, self::$PDF, self::$WORD, self::$EXCEL, self::$PPT) : $rule;

        $rule = array_change_key_case($rule, CASE_LOWER);

        return array_key_exists($fileMime, $rule);
    }
}