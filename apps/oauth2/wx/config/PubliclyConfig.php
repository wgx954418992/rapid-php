<?php


namespace oauth2\wx\config;

/**
 * 公众号url配置参数
 * Class PubliclyConfig
 * @package oauth2\wx\config
 */
class PubliclyConfig
{

    /**
     * 获取微信服务号登录接口url
     * @param string $appId
     * @param string $callUrl
     * @param string $scope
     * 应用授权作用域，拥有多个作用域用逗号（,）分隔
     * snsapi_base （不弹出授权页面，直接跳转，只能获取用户openid）
     * snsapi_userinfo （弹出授权页面，可通过openid拿到昵称、性别、所在地。并且， 即使在未关注的情况下，只要用户授权，也能获取其信息 ）
     * snsapi_login 网页应用
     * @param string $state
     * 用于保持请求和回调的状态，授权请求后原样带回给第三方。该参数可用于防止csrf攻击（跨站请求伪造攻击），建议第三方带上该参数，可设置为简单的随机数加session进行校验
     * @param string $type
     * authorize 一般用于微信客户端h5上面登录
     * qrconnect 一般用于微信pc网页扫码登录
     * @return string
     */
    public static function getCodeUrl(string $appId, string $callUrl, string $scope = 'snsapi_userinfo', string $state = '', string $type = 'authorize'): string
    {
        return "https://open.weixin.qq.com/connect/oauth2/{$type}?appid={$appId}&redirect_uri=" . urlencode($callUrl) .
            "&response_type=code&scope={$scope}&state={$state}#wechat_redirect";
    }

    /**
     * 获取网页授权accessToken url（注意跟普通accessToken不一样）
     * @param $appId
     * @param $secret
     * @param $code
     * @return string
     */
    public static function getAccessTokenUrl($appId, $secret, $code): string
    {
        return "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$appId}&secret={$secret}&code={$code}&grant_type=authorization_code";
    }

    /**
     * 获取用户信息
     * @param $accessToken
     * @param $openId
     * @return string
     */
    public static function getUserInfoUrl($accessToken, $openId): string
    {
        return "https://api.weixin.qq.com/sns/userinfo?access_token={$accessToken}&openid={$openId}&language=zh_CN";
    }
}