<?php


namespace oss\classier\config;


/**
 * Interface IAliYunOSSConfig
 * @package apps\oss\classier\config
 */
interface IAliYunConfig
{

    /**
     * access key id
     * @return string
     */
    public function getAccessKeyId(): string;

    /**
     * secret
     * @return string
     */
    public function getSecret(): string;

    /**
     * endpoint
     * @return string
     */
    public function getEndpoint(): string;

    /**
     * bucket
     * @return string
     */
    public function getBucket(): string;

    /**
     * @return array
     */
    public function getCallback(): array;
}
