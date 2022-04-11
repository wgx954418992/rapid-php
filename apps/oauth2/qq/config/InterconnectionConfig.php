<?php


namespace oauth2\qq\config;


class InterconnectionConfig
{

    /**
     * 获取qq互联授权登录接口url
     * @param $appId
     * @param $callUrl
     * 应用授权作用域，get_user_info,get_vip_info,get_vip_rich_info,list_album,upload_pic,add_album,list_photo
     * @param string $scope
     * client端的状态值。用于第三方应用防止CSRF攻击，成功授权后回调时会原样带回。请务必严格按照流程检查用户与state参数状态的绑定。
     * @param string $state
     * @return string
     */
    public static function getCode2Url($appId, $callUrl, string $state = '', string $scope = ''): string
    {
        return "https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id={$appId}&redirect_uri=" .
            urlencode($callUrl) . "&state={$state}&scope={$scope}";
    }

    /**
     * 获取网页授权accessToken url（注意跟普通accessToken不一样）
     * @param $appId
     * @param $secret
     * @param $code
     * @param $callUrl
     * @return string
     */
    public static function getAccessTokenUrl($appId, $secret, $code, $callUrl): string
    {
        return "https://graph.qq.com/oauth2.0/token?grant_type=authorization_code&client_id={$appId}&client_secret={$secret}&code={$code}&redirect_uri=" . urlencode($callUrl);
    }

    /**
     * 获取openId地址
     * @param $accessToken
     * @param string $isUnionId
     * @return string
     */
    public static function getOpenIdUrl($accessToken, string $isUnionId = '1'): string
    {
        return "https://graph.qq.com/oauth2.0/me?access_token={$accessToken}&unionid={$isUnionId}";
    }

    /**
     * 获取用户信息地址
     * @param $appId
     * @param $accessToken
     * @param $openId
     * @return string
     */
    public static function getUserInfoUrl($appId, $accessToken, $openId): string
    {
        return "https://graph.qq.com/user/get_user_info?access_token={$accessToken}&oauth_consumer_key={$appId}&openid={$openId}";
    }
}
