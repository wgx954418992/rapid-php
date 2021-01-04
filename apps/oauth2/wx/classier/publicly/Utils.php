<?php

namespace oauth2\wx\classier\publicly;

use Exception;
use oauth2\wx\config\PubliclyConfig;
use rapidPHP\modules\common\classier\Http;
use function rapidPHP\B;


class Utils
{

    /**
     * 获取微信扫码登录uuid
     * 应用授权作用域，拥有多个作用域用逗号（,）分隔，网页应用目前仅填写snsapi_login即
     * @param string $appId
     * @param string|null $callUrl
     * @param string $scope
     * 用于保持请求和回调的状态，授权请求后原样带回给第三方。该参数可用于防止csrf攻击（跨站请求伪造攻击），建议第三方带上该参数，可设置为简单的随机数加session进行校验
     * @param string $state
     * @return string
     * @throws Exception
     */
    public function getQRConnectUuid(string $appId, ?string $callUrl, string $scope = 'snsapi_login', string $state = ''): string
    {
        $url = PubliclyConfig::getCodeUrl($appId, $callUrl, $scope, $state, 'qrconnect');

        $httpResponse = Http::getInstance()->getHttpResponse($url);

        if (empty($httpResponse)) throw new Exception('请求失败!');

        $uuid = B()->getRegular('#\/connect\/qrcode\/(.*?)"#i', $httpResponse);

        if (empty($uuid)) throw new Exception('uuid获取失败!');

        return $uuid;
    }
}