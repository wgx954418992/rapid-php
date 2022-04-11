<?php


namespace apps\core\classier\sender\email;

interface ISmtpConfig
{
    /**
     * @return string
     */
    public function getServer(): string;

    /**
     * @return int
     */
    public function getPort(): int;

    /**
     * @return string
     */
    public function getUsername(): string;

    /**
     * @return string
     */
    public function getPassword(): string;

    /**
     * @return bool
     */
    public function getIsSecurity(): bool;


    /**
     * @return string
     */
    public function getForm(): string;
}
