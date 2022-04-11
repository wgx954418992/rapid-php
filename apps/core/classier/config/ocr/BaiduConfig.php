<?php


namespace apps\core\classier\config\ocr;


use apps\core\classier\config\Configure;

class BaiduConfig
{
    /**
     * Configure
     */
    use Configure;

    /**
     * appid
     * @var string|null
     * @config ocr.baidu.appid
     */
    protected $appid = '';

    /**
     * appkey
     * @var string|null
     * @config ocr.baidu.app_key
     */
    protected $appKey = '';

    /**
     * secret
     * @var string|null
     * @config ocr.baidu.secret
     */
    protected $secret = '';

    /**
     * @return string|null
     */
    public function getAppid(): ?string
    {
        return $this->appid;
    }

    /**
     * @param string|null $appid
     */
    public function setAppid(?string $appid): void
    {
        $this->appid = $appid;
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
    public function getSecret(): ?string
    {
        return $this->secret;
    }

    /**
     * @param string|null $secret
     */
    public function setSecret(?string $secret): void
    {
        $this->secret = $secret;
    }
}
