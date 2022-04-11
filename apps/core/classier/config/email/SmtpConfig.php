<?php


namespace apps\core\classier\config\email;

use apps\core\classier\config\Configure;
use apps\core\classier\sender\email\ISmtpConfig;

class SmtpConfig implements ISmtpConfig
{

    /**
     * Configure
     */
    use Configure;

    /**
     * @var string
     * @config email.smtp.server
     */
    protected $server;

    /**
     * port
     * @var int
     * @config email.smtp.port
     */
    protected $port;

    /**
     * username
     * @var string
     * @config email.smtp.username
     */
    protected $username;

    /**
     * password
     * @var string
     * @config email.smtp.password
     */
    protected $password;

    /**
     * is security
     * @var bool
     * @config email.smtp.is_security
     */
    protected $isSecurity;

    /**
     * form
     * @var string
     * @config email.smtp.form
     */
    protected $form;

    /**
     * @return string
     */
    public function getServer(): string
    {
        return $this->server;
    }

    /**
     * @return int
     */
    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return bool
     */
    public function getIsSecurity(): bool
    {
        return $this->isSecurity;
    }

    /**
     * @return string
     */
    public function getForm(): string
    {
        return $this->form;
    }
}
