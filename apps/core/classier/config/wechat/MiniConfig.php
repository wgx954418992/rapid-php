<?php


namespace apps\core\classier\config\wechat;

use apps\core\classier\config\Configure;

class MiniConfig
{

    /**
     * Configure
     */
    use Configure;

    /**
     * appid
     * @var string
     * @config wechat.mini.appid
     */
    protected $appid = '';

    /**
     * secret
     * @var string
     * @config wechat.mini.secret
     */
    protected $secret = '';

    /**
     * @return string
     */
    public function getAppid(): string
    {
        return $this->appid;
    }

    /**
     * @return string
     */
    public function getSecret(): string
    {
        return $this->secret;
    }
}
