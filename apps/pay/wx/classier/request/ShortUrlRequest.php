<?php

namespace pay\wx\classier\request;

use rapidPHP\modules\server\config\HttpConfig;

/**
 * 转换短链接
 * 该接口主要用于扫码原生支付模式一中的二维码链接转成短链接(weixin://wxpay/s/XXXXXX)，
 * 减小二维码数据量，提升扫描速度和精确度。
 * Class ShortUrlRequest
 * @package pay\wx\classier\request
 */
class ShortUrlRequest extends BaseRequest
{

    /**
     * son extends
     */
    const URL = 'https://api.mch.weixin.qq.com/tools/shorturl';

    /**
     * method son extends
     */
    const METHOD = HttpConfig::METHOD_POST;

    /**
     * 设置需要转换的URL，签名用原串，传输需URL encode
     * @var string|null
     */
    private $long_url;

    /**
     * @return string|null
     */
    public function getLongUrl(): ?string
    {
        return $this->long_url;
    }

    /**
     * @param string|null $long_url
     */
    public function setLongUrl(?string $long_url): void
    {
        $this->long_url = $long_url;
    }
}