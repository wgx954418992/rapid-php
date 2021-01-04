<?php

namespace wxsdk\core\config;

class WXConfig
{

    /**
     * 获取accessToken (不是用户授权的accessToken)
     * @param $appId
     * @param $secret
     * @return string
     */
    public static function getAccessTokenUrl($appId, $secret): string
    {
        return "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appId}&secret={$secret}";
    }
}