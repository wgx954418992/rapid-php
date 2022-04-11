<?php

namespace wxsdk\mini\classier;


use Exception;
use rapidPHP\modules\common\classier\AB;
use wxsdk\core\classier\WXSdk;
use wxsdk\mini\config\MiniConfig;

class Mini extends WXSdk
{

    /**
     * 发送订阅消息
     * @param $templateId
     * @param $openId
     * @param $page
     * @param $data
     * @return bool
     * @throws Exception
     */
    public function sendSubScribeMsg($templateId, $openId, $page, $data): bool
    {
        if (empty($templateId)) throw new Exception('模板id错误');

        if (empty($openId)) throw new Exception('openId错误');

        $accessToken = $this->getAccessToken();

        $post = [
            'access_token' => $accessToken,
            'touser' => $openId,
            'template_id' => $templateId,
            'page' => $page,
            'data' => $data
        ];

        $data = parent::sendHttpResponse(MiniConfig::getSendSubScribeMsgUrl($accessToken), $post, [
            CURLOPT_HTTPHEADER => ['Content-type' => 'application/json']
        ]);

        if (!$data->hasValue('errcode', 0)) throw new Exception($data->toString('errmsg'));

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
     * @param bool|array $autoColor
     * 自动配置线条颜色，如果颜色依然是黑色，则说明不建议配置主色调，默认 false
     * @param array|bool $lineColor
     * auto_color 为 false 时生效，使用 rgb 设置颜色 例如 {"r":"xxx","g":"xxx","b":"xxx"} 十进制表示
     * @param bool $isHyaline
     * 是否需要透明底色，为 true 时，生成透明底色的小程序
     * @return AB|string
     * @throws Exception
     */
    public function getProgramQCode($scene, string $page = '', int $width = 400, $autoColor = false, $lineColor = ['r' => 0, 'g' => 0, 'b' => '0'], bool $isHyaline = false)
    {
        if (empty($scene)) throw new Exception('场景错误!');

        if ($width > 1280) throw new Exception('宽度超出最大值!');

        if (substr($page, 0, 1) === '/') $page = substr($page, 1);

        $accessToken = $this->getAccessToken();

        $post = [
            'scene' => $scene,
            'page' => $page,
            'width' => $width,
            'auto_color' => $autoColor,
            'line_color' => $lineColor,
            'is_hyaline' => $isHyaline
        ];

        $data = parent::sendHttpResponse(MiniConfig::getProgramQCodeUrl($accessToken), $post, [
            CURLOPT_HTTPHEADER => ['Content-type' => 'application/json']
        ]);

        if ($data instanceof AB) throw new Exception($data->toString('errmsg'));

        return $data;
    }
}
