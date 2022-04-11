<?php


namespace apps\core\classier\sender\email\impl;


use apps\core\classier\sender\email\IEmailSender;
use apps\core\classier\sender\email\ISmtpConfig;
use Exception;
use rapidPHP\modules\common\classier\Mail;

class SmtpSender implements IEmailSender
{

    /**
     * @var ISmtpConfig
     */
    protected $config;

    /**
     * SmtpSender constructor.
     * @param ISmtpConfig $config
     */
    public function __construct(ISmtpConfig $config)
    {
        $this->config = $config;
    }

    /**
     * 发送邮件
     * @param string $title
     * @param string $body
     * @param $email
     * @param null $attachments
     * @return bool
     * @throws Exception
     */
    public function send(string $title, string $body, $email, $attachments = null): bool
    {
        $mail = new Mail();

        $mail->setServer($this->config->getServer(), $this->config->getUsername(), $this->config->getPassword(), $this->config->getPort(), $this->config->getIsSecurity());

        $mail->setFrom($this->config->getForm());

        if (!is_array($email)) $email = [$email];

        foreach ($email as $value) {
            $mail->setReceiver($value);
        }

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
}
