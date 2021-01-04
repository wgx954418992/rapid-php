<?php


namespace oauth2\wx\config;


class MiniConfig
{


    /**
     * 小程序 js code 获取 session url
     * @param $appId
     * @param $secret
     * @param $JSCode
     * @return string
     */
    public static function JSCodeToSessionUrl($appId, $secret, $JSCode): string
    {
        return "https://api.weixin.qq.com/sns/jscode2session?appid={$appId}&secret={$secret}&js_code={$JSCode}&grant_type=authorization_code";
    }

}