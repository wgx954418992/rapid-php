<?php


namespace apps\core\classier\sender\email;

interface IEmailSender
{

    /**
     * 发送接口
     * @param string $title
     * @param string $body
     * @param $email
     * @param null $attachments
     * @return bool
     */
    public function send(string $title, string $body, $email, $attachments = null): bool;
}
