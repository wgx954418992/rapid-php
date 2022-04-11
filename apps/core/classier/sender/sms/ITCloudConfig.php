<?php


namespace apps\core\classier\sender\sms;


interface ITCloudConfig
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
    public function getSecretId(): string;

    /**
     * @return string
     */
    public function getSecretKey(): string;

    /**
     * @return string
     */
    public function getAppId(): string;

    /**
     * @return string
     */
    public function getExtendCode(): ?string;

    /**
     * @return string
     */
    public function getSenderId(): ?string;

    /**
     * @return string
     */
    public function getSessionContext(): ?string;

    /**
     * 模板Code domestic
     * @return  array
     */
    public function getTemplateCodeDomestic(): ?array;

    /**
     * 模板Code abroad
     * @return  array
     */
    public function getTemplateCodeAbroad(): ?array;
}
