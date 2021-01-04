<?php

namespace wxsdk\mini\config;


/**
 * 该类是微信小程序配置信息
 * Class MiniConfig
 * @package wxsdk\mini\config
 */
class MiniConfig
{

    /**
     * 获取发送订阅消息url
     * @param $accessToken
     * @return string
     */
    public static function getSendSubScribeMsgUrl($accessToken): string
    {
        return "https://api.weixin.qq.com/cgi-bin/message/subscribe/send?access_token={$accessToken}";
    }

    /**
     * 获取小程序二维码
     * @param $accessToken
     * @return string
     */
    public static function getProgramQCodeUrl($accessToken): string
    {
        return "https://api.weixin.qq.com/wxa/getwxacodeunlimit?access_token={$accessToken}";
    }
}