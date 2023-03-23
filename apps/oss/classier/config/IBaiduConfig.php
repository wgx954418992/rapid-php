<?php


namespace oss\classier\config;


/**
 * Interface IBaiduConfig
 * @package apps\oss\classier\config
 */
interface IBaiduConfig
{

    /**
     * access key
     * @return string
     */
    public function getAccessKey(): string;

    /**
     * secret key
     * @return string
     */
    public function getSecretKey(): string;

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
