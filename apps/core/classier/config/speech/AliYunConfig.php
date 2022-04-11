<?php


namespace apps\core\classier\config\speech;

use apps\core\classier\config\Configure;

class AliYunConfig
{
    /**
     * Configure
     */
    use Configure;

    /**
     * 阿里云语音交互api accessKeyId
     * @var string|null
     * @config speech.aliyun.access_key_id
     */
    protected $accessKeyId = '';

    /**
     * 阿里云语音交互api accessKeySecret
     * @var string|null
     * @config speech.aliyun.access_key_secret
     */
    protected $accessKeySecret = '';

    /**
     * 阿里云语音交互api appkey
     * @var string|null
     * @config speech.aliyun.app_key
     */
    protected $appKey = '';

    /**
     * 阿里云语音交互api wss
     * @var string|null
     * @config speech.aliyun.wss
     */
    protected $wss;

    /**
     * @return string|null
     */
    public function getAccessKeyId(): ?string
    {
        return $this->accessKeyId;
    }

    /**
     * @param string|null $accessKeyId
     */
    public function setAccessKeyId(?string $accessKeyId): void
    {
        $this->accessKeyId = $accessKeyId;
    }

    /**
     * @return string|null
     */
    public function getAccessKeySecret(): ?string
    {
        return $this->accessKeySecret;
    }

    /**
     * @param string|null $accessKeySecret
     */
    public function setAccessKeySecret(?string $accessKeySecret): void
    {
        $this->accessKeySecret = $accessKeySecret;
    }

    /**
     * @return string|null
     */
    public function getAppKey(): ?string
    {
        return $this->appKey;
    }

    /**
     * @param string|null $appKey
     */
    public function setAppKey(?string $appKey): void
    {
        $this->appKey = $appKey;
    }


    /**
     * @return string|null
     */
    public function getWss(): ?string
    {
        return $this->wss;
    }

    /**
     * @param string|null $wss
     */
    public function setWss(?string $wss): void
    {
        $this->wss = $wss;
    }
}
