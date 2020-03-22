<?php


namespace rapidPHP\config\plugin\oauth2;


class WXOAuth2Config
{
    /**
     * 获取微信服务号登录接口url (仅支持服务号平台)
     * @param $appId
     * @param $callUrl
     * 应用授权作用域，snsapi_base （不弹出授权页面，直接跳转，只能获取用户openid）
     * snsapi_userinfo （弹出授权页面，可通过openid拿到昵称、性别、所在地。并且， 即使在未关注的情况下，只要用户授权，也能获取其信息 ）
     * @param string $scope
     * 重定向后会带上state参数，开发者可以填写a-zA-Z0-9的参数值，最多128字节
     * @param string $state
     * @return string
     */
    public static function getCodeUrl($appId, $callUrl, $scope = 'snsapi_userinfo', $state = '')
    {
        return "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$appId}&redirect_uri=" . urlencode($callUrl) .
            "&response_type=code&scope={$scope}&state={$state}#wechat_redirect";
    }

    /**
     * 获取微信扫码登录code (仅支持开放平台)
     * @param $appId
     * @param $callUrl
     * 应用授权作用域，拥有多个作用域用逗号（,）分隔，网页应用目前仅填写snsapi_login即
     * @param string $scope
     * 用于保持请求和回调的状态，授权请求后原样带回给第三方。该参数可用于防止csrf攻击（跨站请求伪造攻击），建议第三方带上该参数，可设置为简单的随机数加session进行校验
     * @param string $state
     * @return string
     */
    public static function getQRConnectCodeUrl($appId, $callUrl, $scope = 'snsapi_login', $state = '')
    {
        return "https://open.weixin.qq.com/connect/qrconnect?appid={$appId}&redirect_uri=" . urlencode($callUrl) .
            "&response_type=code&scope={$scope}&state={$state}#wechat_redirect";
    }

    /**
     * 获取网页授权accessToken url（注意跟普通accessToken不一样）(支持服务号登录，跟微信开放平台登录)
     * @param $appId
     * @param $secret
     * @param $code
     * @return string
     */
    public static function getAccessTokenUrl($appId, $secret, $code)
    {
        return "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$appId}&secret={$secret}&code={$code}&grant_type=authorization_code";
    }

    /**
     * 获取用户信息(支持服务号登录，跟微信开放平台登录)
     * @param $accessToken
     * @param $openId
     * @return string
     */
    public static function getUserInfoUrl($accessToken, $openId)
    {
        return "https://api.weixin.qq.com/sns/userinfo?access_token={$accessToken}&openid={$openId}&lang=zh_CN";
    }

    /**
     * 通过code获取小程序的open信息 (仅支持小程序)
     * @param $appId
     * @param $secret
     * @param $code
     * @return string
     */
    public static function getMiniOpenInfoByCode($appId, $secret, $code)
    {
        return "https://api.weixin.qq.com/sns/jscode2session?appid={$appId}&secret={$secret}&js_code={$code}&grant_type=authorization_code";
    }

}