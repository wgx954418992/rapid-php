<?php

namespace apps\core\classier\config;

use function rapidPHP\Cal;

class EmailConfig
{

    /**
     * 发送邮件服务器
     */
    const SERVER = 'smtp.qq.com';

    /**
     * 用户名
     */
    const USERNAME = 'xxx@qq.com';

    /**
     * 密码
     */
    const PASSWORD = 'xxx';

    /**
     * 服务器端口
     */
    const PORT = 587;

    /**
     * 发送者
     */
    const FORM = 'xxx@qq.com';

    /**
     * 发送邮件时间限制
     */
    const LIMIT_TIME = 60;

    /**
     * 验证码有效时间
     */
    const VALIDA_TIME = 60 * 5;

    /***
     * title
     */
    const EMAIL_TITLE = 'title';

    /**
     * body
     */
    const EMAIL_BODY = 'body';

    /**
     * attachments
     */
    const EMAIL_ATTACHMENTS = 'attachments';

    /**
     * 发送右键模板类型,完善资料
     */
    const TEMPLATE_TYPE_PERFECT = 'perfect';

    /**
     * 模板类型 国内（暂时不区分）
     * @return array
     */
    public function getTemplateTypeDomestic(): array
    {
        return [
            self::TEMPLATE_TYPE_PERFECT => [
                self::EMAIL_TITLE => '完善资料邮箱验证通知',
                self::EMAIL_BODY => '<h5>您正在完善资料，您的验证码为{code},' . Cal()->formatSecond(self::VALIDA_TIME) . '有效</h5>',
            ]
        ];
    }

    /**
     * 通过type获取参数
     * @param $type
     * @param string $language
     * @return bool|string|mixed
     */
    public function getTemplateCodeByType($type, $language = 'zh')
    {
        $types = $this->getTemplateTypeDomestic();

        if (array_key_exists($type, $types)) return $types[$type];

        return false;
    }
}