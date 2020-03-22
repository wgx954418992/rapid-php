<?php

namespace rapidPHP\config\plugin\wxsdk;

/**
 * 该类是微信公众平台接口配置信息
 * Class PubliclyConfig
 * @package rapidPHP\config\plugin\wxsdk
 */
class PubliclyConfig
{
    /**
     * 获取jsApi的ticket
     * @param $accessToken
     * @return string
     */
    public static function getJSApiTicketUrl($accessToken)
    {
        return "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token={$accessToken}";
    }

    /**
     * 生成获取服务器文件的请求地址
     * @param $accessToken
     * @param $serverId
     * @return string
     */
    public static function getLoadServerUrl($accessToken, $serverId)
    {
        return "http://file.api.weixin.qq.com/cgi-bin/media/get?access_token={$accessToken}&media_id={$serverId}";
    }

}