<?php


namespace apps\core\classier\enum\notify;


use enum\classier\Enum;
use rapidPHP\modules\common\classier\Build;

class Event extends Enum
{

    /**
     * 事件 关注
     */
    const FOLLOW = 'FOLLOW';

    /**
     * 事件 用户等级更改
     */
    const USER_LEVEL_CHANGE = 'USER_LEVEL_CHANGE';

    /**
     * 事件 官方发布
     */
    const OFFICIAL_MSG = 'OFFICIAL_MSG';

    /**
     * 事件 系统消息
     */
    const SYSTEM_MSG = 'SYSTEM_MSG';

    /**
     * 事件模板
     */
    const TITLE_TEMPLATES = [
        self::FOLLOW => '${display_name}关注了您!',
    ];

    /**
     * 获取事件 title
     * @param $event
     * @param $args
     * @return string|string[]
     */
    public static function getTitle($event, $args)
    {
        if (!isset(self::TITLE_TEMPLATES[$event])) return '';

        $template = self::TITLE_TEMPLATES[$event];

        $vars = Build::getInstance()->getRegularAll('/\${(.*?)}/i', $template);

        if (!empty($vars)) {

            foreach ($vars as $var) {

                $value = Build::getInstance()->getData($args, $var);

                $template = str_replace("\${{$var}}", $value, $template);
            }
        }

        return $template;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        switch ($this->constValue) {
            case self::FOLLOW:
                return '关注';
            case self::USER_LEVEL_CHANGE:
                return '用户等级更改';
            case self::OFFICIAL_MSG:
                return '官方发布';
            case self::SYSTEM_MSG:
                return '系统消息';
            default:
                return '未知';
        }
    }

}
