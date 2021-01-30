<?php

namespace apps\core\classier\service;

use apps\core\classier\config\EmailConfig;
use apps\core\classier\dao\master\CodeDao;
use apps\core\classier\wrapper\UserWrapper;
use Exception;
use rapidPHP\modules\common\classier\Instances;
use rapidPHP\modules\common\classier\Mail;
use rapidPHP\modules\common\classier\Verify;
use function rapidPHP\B;

class EmailService extends CodeService
{
    /**
     * @var EmailConfig
     */
    private $emailConfig;

    /**
     * 单列模式
     */
    use Instances;

    /**
     * @return static
     */
    public static function onNotInstance()
    {
        return new static();
    }

    /**
     * EmailService constructor.
     */
    public function __construct()
    {
        $this->emailConfig = new EmailConfig();
    }

    /**
     * 通过类型获取模板内容
     * @param $templateId
     * @param $language
     * @return bool|mixed|string|string[]
     * @throws Exception
     */
    public function getTemplateContentByType($templateId, $language = 'zh')
    {
        if (!$templateContent = $this->emailConfig->getTemplateCodeByType($templateId, $language))
            throw new Exception('模板错误!');

        return $templateContent;
    }

    /**
     * 发送邮件
     * @param $email
     * @param $title
     * @param $body
     * @param array|string $attachments
     * @return true
     * @throws Exception
     */
    public static function send($email, $title, $body, $attachments = null): bool
    {
        $mail = new Mail();

        $mail->setServer(EmailConfig::SERVER, EmailConfig::USERNAME, EmailConfig::PASSWORD, EmailConfig::PORT);

        $mail->setFrom(EmailConfig::FORM);

        $mail->setReceiver($email);

        if (is_file($attachments)) {
            $mail->addAttachment($attachments, basename($attachments));
        } else if (is_array($attachments)) {
            foreach ($attachments as $name => $attachment) {
                $mail->addAttachment($attachment, $name);
            }
        }

        $mail->setMail($title, $body);

        if (!$mail->sendMail()) throw new Exception($mail->getError());

        return true;
    }

    /***
     * 发送验证码
     * @param UserWrapper|null $userModel
     * @param $receiver
     * @param $templateId
     * @param int $limitTime
     * @return bool
     * @throws Exception
     */
    public function sendVerificationCode(?UserWrapper $userModel, $receiver, $templateId, $limitTime = EmailConfig::LIMIT_TIME): bool
    {
        if (!Verify::getInstance()->email($receiver)) throw new Exception('邮箱错误!');

        $this->checkLastSendTime($receiver, $templateId, $limitTime);

        $code = B()->randoms(4, '1234567890');

        $param = ['code' => $code];

        $templateContent = $this->getTemplateContentByType($templateId);

        $title = B()->getData($templateContent, EmailConfig::EMAIL_TITLE);

        $body = B()->getData($templateContent, EmailConfig::EMAIL_BODY);

        $attachments = B()->getData($templateContent, EmailConfig::EMAIL_ATTACHMENTS);

        foreach ($param as $name => $value) {
            $body = str_replace("{{$name}}", $value, $body);
        }

        $this->send($receiver, $title, $body, $attachments);

        /** @var CodeDao $codeDao */
        $codeDao = CodeDao::getInstance();

        if (!$codeDao->addVerifyCode($templateId, $receiver, $code))
            throw new Exception("发送失败!");

        return true;
    }

    /**
     * 效验验证码
     * @param $templateId
     * @param $receiver
     * @param $code
     * @param float|int $validaTime
     * @return bool
     * @throws Exception
     */
    public function checkVerificationCode($templateId, $receiver, $code, $validaTime = EmailConfig::VALIDA_TIME): bool
    {
        if (empty($receiver)) throw new Exception("邮箱错误!");

        return parent::checkVerificationCode($templateId, $receiver, $code, $validaTime);
    }
}