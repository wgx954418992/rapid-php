<?php

namespace rapidPHP\plugin\wxsdk;


use Exception;
use rapidPHP\config\plugin\wxsdk\MiniConfig;
use rapidPHP\library\AB;

class Mini extends WXSdk
{

    /**
     * @var string
     */
    private $appId, $secret;

    /**
     * 实例化设置appid
     * Publicly constructor.
     * @param string $appId
     * @param string $appSecret
     */
    public function __construct($appId = '', $appSecret = '')
    {
        $this->setAppId($appId)->setSecret($appSecret);
    }

    /**
     * 设置appid
     * @param string $appId
     * @return $this
     */
    public function setAppId(string $appId)
    {
        $this->appId = $appId;

        return $this;
    }

    /**
     * 设置appSecret
     * @param string $secret
     * @return $this
     */
    public function setSecret(string $secret)
    {
        $this->secret = $secret;

        return $this;
    }

    /**
     * 获取appId
     * @return string
     */
    public function getAppId(): string
    {
        return $this->appId;
    }

    /**
     * 获取secret
     * @return string
     */
    public function getSecret(): string
    {
        return $this->secret;
    }

    /**
     * 发送订阅消息
     * @param $templateId
     * @param $openId
     * @param $page
     * @param $data
     * @return bool
     * @throws Exception
     */
    public function sendSubScribeMsg($templateId, $openId, $page, $data)
    {
        if (empty($templateId)) throw new Exception('模板id错误');

        if (empty($openId)) throw new Exception('openId错误');

        if (empty($page)) throw new Exception('page 错误');

        $accessToken = $this->getAccessToken($this->getAppId(), $this->getSecret());

        $url = MiniConfig::getSendSubScribeMsgUrl($accessToken);

        $data = ['access_token' => $accessToken, 'touser' => $openId, 'template_id' => $templateId,
            'page' => $page, 'data' => $data];

        $res = B()->getHttpResponse($url, json_encode($data), 60, [],
            [CURLOPT_HTTPHEADER => ['Content-type' => 'application/json']]);

        $data = B()->jsonDecode($res);

        if (empty($data)) throw new Exception('解析数据失败!');

        $AB = new AB($data);

        if (!$AB->hasValue('errcode', 0))
            throw new Exception($AB->getString('errmsg'));

        return true;
    }

    /**
     * 生成程序码
     * 接口 B：适用于需要的码数量极多的业务场景
     * 生成小程序码，可接受页面参数较短，生成个数不受限。
     * @param $scene
     * 最大32个可见字符，只支持数字，大小写英文以及部分特殊字符：!#$&'()*+,/:;=?@-._~，
     * 其它字符请自行编码为合法字符（因不支持%，中文无法使用 urlencode 处理，请使用其他编码方式）
     * @param string $page
     * 必须是已经发布的小程序存在的页面（否则报错），例如 pages/index/index,
     * 根路径前不要填加 /,不能携带参数（参数请放在scene字段里），如果不填写这个字段，默认跳主页面
     * @param int $width
     * 二维码的宽度，单位 px，最小 280px，最大 1280px
     * @param bool $autoColor
     * 自动配置线条颜色，如果颜色依然是黑色，则说明不建议配置主色调，默认 false
     * @param array $lineColor
     * auto_color 为 false 时生效，使用 rgb 设置颜色 例如 {"r":"xxx","g":"xxx","b":"xxx"} 十进制表示
     * @param bool $isHyaline
     * 是否需要透明底色，为 true 时，生成透明底色的小程序
     * @return bool|string
     * @throws Exception
     */
    public function getProgramQCodeMax($scene, $page = '', $width = 400, $autoColor = false, $lineColor = ['r' => 0, 'g' => 0, 'b' => '0'], $isHyaline = false)
    {
        if (empty($scene)) throw new Exception('场景错误!');

        if ($width > 1280) throw new Exception('宽度超出最大值!');

        $accessToken = $this->getAccessToken($this->getAppId(), $this->getSecret());

        $url = MiniConfig::getProgramQCodeMaxUrl($accessToken);

        if (substr($page, 0, 1) === '/') $page = substr($page, 1);

        $data = ['scene' => $scene, 'page' => $page, 'width' => $width, 'auto_color' => $autoColor,
            'line_color' => $lineColor, 'is_hyaline' => $isHyaline];

        $res = B()->getHttpResponse($url, json_encode($data), 60, [],
            [CURLOPT_HTTPHEADER => ['Content-type' => 'application/json']]);

        if (substr($res, 0, 1) === '{') {
            $result = B()->jsonDecode($res);

            throw new Exception(B()->getData($result, 'errmsg'));
        }

        return $res;
    }
}