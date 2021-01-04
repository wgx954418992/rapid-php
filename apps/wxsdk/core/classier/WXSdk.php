<?php

namespace wxsdk\core\classier;

use Exception;
use rapidPHP\modules\cache\classier\CacheInterface;
use rapidPHP\modules\common\classier\AB;
use rapidPHP\modules\common\classier\Http;
use wxsdk\core\config\WXConfig;
use function rapidPHP\AB;
use function rapidPHP\B;

class WXSdk
{

    /**
     * @var string
     */
    private $appId;

    /**
     * @var string
     */
    private $secret;

    /**
     * @var CacheInterface
     */
    private $cacheService;

    /**
     * WXSdk constructor.
     * @param CacheInterface|null $cacheService
     * @param string $appId
     * @param string $appSecret
     */
    public function __construct(?CacheInterface $cacheService, $appId = '', $appSecret = '')
    {
        $this->cacheService = $cacheService;

        $this->appId = $appId;

        $this->secret = $appSecret;
    }

    /**
     * 设置appid
     * @param string $appId
     */
    public function setAppId(string $appId)
    {
        $this->appId = $appId;
    }

    /**
     * 设置appSecret
     * @param string $secret
     */
    public function setSecret(string $secret)
    {
        $this->secret = $secret;
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
     * 获取缓存服务
     * @return CacheInterface|null
     */
    public function getCacheService(): ?CacheInterface
    {
        return $this->cacheService;
    }

    /**
     * 修改缓存服务
     * @param CacheInterface|null $cacheService
     */
    public function setCacheService(?CacheInterface $cacheService)
    {
        $this->cacheService = $cacheService;
    }

    /**
     * 获取缓存值
     * @param $name
     * @return array|int|mixed|string|null
     */
    public function getCacheValue(string $name)
    {
        if ($this->cacheService instanceof CacheInterface) {
            return $this->cacheService->get($name);
        }

        return null;
    }


    /**
     * 添加或者更新缓存
     * @param string $name
     * @param $value
     * @param int $time
     * @return array|int|mixed|string|null
     */
    public function addCacheValue(string $name, $value, $time = 0)
    {
        if ($this->cacheService instanceof CacheInterface) {
            return $this->cacheService->add($name, $value, $time);
        }

        return false;
    }

    /**
     * 获取http请求
     * @param $url
     * @param array $post
     * @param array $options
     * @return AB|string
     * @throws Exception
     */
    protected function sendHttpResponse($url, $post = [], $options = [])
    {
        $res = Http::getInstance()->getHttpResponse($url, !empty($post) ? json_encode($post) : null, 60, [], $options);

        if (empty($res)) throw new Exception('获取数据失败!');

        if (substr($res, 0, 1) != '{') return $res;

        $data = B()->jsonDecode($res);

        if (empty($data)) throw new Exception('解析数据失败!');

        return AB($data);
    }

    /**
     * 获取AccessToken
     * @return array|bool|null|string
     * @throws Exception
     */
    public function getAccessToken()
    {
        $accessFileName = md5($this->getAppId()) . '_access_token';

        $accessToken = $this->getCacheValue($accessFileName);

        if ($accessToken) return $accessToken;

        $data = $this->sendHttpResponse(WXConfig::getAccessTokenUrl($this->getAppId(), $this->getSecret()));

        $accessToken = $data->toString('access_token');

        if (empty($accessToken)) throw new Exception($data->toString('errmsg'));

        $this->addCacheValue($accessFileName, $accessToken, $data->toInt('expires_in'));

        return $accessToken;
    }
}