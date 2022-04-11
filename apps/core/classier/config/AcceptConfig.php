<?php


namespace apps\core\classier\config;


class AcceptConfig
{

    /**
     * IMAGE mime webp
     */
    const IMAGE_MIME_WEBP = 'image/webp';

    /**
     * Video mime mov
     */
    const VIDEO_MIME_MOV = 'video/quicktime';

    /**
     * 图片文件
     * @var int[]
     */
    const IMAGE = [
        'image/jpg' => '.jpg',
        'image/jpeg' => '.jpeg',
        'image/png' => '.png',
        self::IMAGE_MIME_WEBP => '.webp',
    ];

    /**
     * 视频文件
     * @var int[]
     */
    const VIDEO = [
        'video/mpeg' => '.mp4',
        'video/mp4' => '.mp4',
        'video/quicktime' => '.mov',
    ];

    /**
     * pdf文件
     * @var int[]
     */
    const PDF = [
        'application/pdf' => '.pdf',
    ];

    /**
     * WORD
     * @var int[]
     */
    const WORD = [
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
    const EXCEL = [
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
    const PPT = [
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

        $rule = is_null($rule) ? array_merge(self::IMAGE, self::VIDEO, self::PDF, self::WORD, self::EXCEL, self::PPT) : $rule;

        $rule = array_change_key_case($rule, CASE_LOWER);

        return array_key_exists($fileMime, $rule);
    }
}