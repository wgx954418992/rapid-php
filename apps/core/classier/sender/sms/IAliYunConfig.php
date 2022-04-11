<?php


namespace apps\core\classier\sender\sms;


interface IAliYunConfig
{
    /**
     * @return string|string[]
     */
    public function getSign();

    /**
     * @return string
     */
    public function getRegion(): string;

    /**
     * @return string
     */
    public function getAccessKeyId(): string;

    /**
     * @return string
     */
    public function getAccessKeySecret(): string;

    /**
     * @return array
     */
    public function getTemplateCodeDomestic(): ?array;

    /**
     * @return array
     */
    public function getTemplateCodeAbroad(): ?array;
}
