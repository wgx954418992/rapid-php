<?php

namespace wxsdk\publicly\config;

/**
 * 该类是微信公众平台接口配置信息
 * Class PubliclyConfig
 * @package wxsdk\publicly\config
 */
class PubliclyConfig
{
    /**
     * 获取jsApi的ticket
     * @param $accessToken
     * @return string
     */
    public static function getJSApiTicketUrl($accessToken): string
    {
        return "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token={$accessToken}";
    }

    /**
     * 获取用户信息(用于获取关注的用户信息)
     * @param $accessToken
     * @param $openId
     * @return string
     */
    public static function getUserInfoUrl($accessToken, $openId): string
    {
        return "https://api.weixin.qq.com/cgi-bin/user/info?access_token={$accessToken}&openid={$openId}&language=zh_CN";
    }

    /**
     * 生成获取服务器文件的请求地址
     * @param $accessToken
     * @param $serverId
     * @return string
     */
    public static function getLoadServerUrl($accessToken, $serverId): string
    {
        return "http://file.api.weixin.qq.com/cgi-bin/media/get?access_token={$accessToken}&media_id={$serverId}";
    }

    /**
     * 生成发送模板消息请求地址
     * @param $accessToken
     * @return string
     */
    public static function getSendTemplateMsgUrl($accessToken): string
    {
        return "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token={$accessToken}";
    }

    /**
     * 生成获取用户列表接口地址
     * @param $accessToken
     * @param null $nextOpenId 下一个openId
     * @return string
     */
    public static function getUserListUrl($accessToken, $nextOpenId = null): string
    {
        return "https://api.weixin.qq.com/cgi-bin/user/get?access_token={$accessToken}&next_openid={$nextOpenId}";
    }

}