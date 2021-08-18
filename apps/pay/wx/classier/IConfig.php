<?php

namespace pay\wx\classier;


interface IConfig
{

    /**
     * @return string
     */
    public function getAppId(): string;

    /**
     * @return string
     */
    public function getSecret(): string;

    /**
     * @return string
     */
    public function getMchId(): string;

    /**
     * @return string
     */
    public function getSignType(): string;

    /**
     * @return string
     */
    public function getKey(): string;

    /**
     * @return string|null
     */
    public function getSslCertPath(): ?string;

    /**
     * @return string|null
     */
    public function getSslKeyPath(): ?string;

    /**
     * @return string|null
     */
    public function getCurlProxyHost(): ?string;


    /**
     * @return int|null
     */
    public function getCurlProxyPort(): ?int;


    /**
     * @return string|null
     */
    public function getNotifyUrl(): ?string;
}
