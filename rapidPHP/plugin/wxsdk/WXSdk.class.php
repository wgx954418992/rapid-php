<?php

namespace rapidPHP\plugin\wxsdk;

use Exception;
use rapidPHP\config\plugin\WXConfig;
use rapidPHP\library\cache\CacheInterface;
use rapidPHP\library\cache\CacheService;

class WXSdk
{

    /**
     * @var CacheInterface
     */
    private $cacheService;

    public function __construct(CacheInterface $cacheService = null)
    {
        if ($cacheService == null) $cacheService = new CacheService();

        $this->cacheService = $cacheService;
    }

    /**
     * 获取缓存服务
     * @return CacheInterface
     */
    public function getCacheService(): CacheInterface
    {
        return $this->cacheService;
    }

    /**
     * 修改缓存服务
     * @param CacheInterface $cacheService
     * @return self
     */
    public function setCacheService(CacheInterface $cacheService): self
    {
        $this->cacheService = $cacheService;

        return $this;
    }

    /**
     * 获取http请求
     * @param $url
     * @return array|string|null
     * @throws Exception
     */
    protected function getHRToAB($url)
    {
        $res = B()->getHttpResponse($url);

        if (empty($res)) throw new Exception('获取数据失败!');

        if (substr($res, 0, 1) != '{') return $res;

        $data = B()->jsonDecode($res);

        if (empty($data)) throw new Exception('解析数据失败!');

        return $data;
    }

    /**
     * 获取AccessToken
     * @param $appId
     * @param $secret
     * @return array|bool|null|string
     * @throws Exception
     */
    public function getAccessToken($appId, $secret)
    {
        $accessFileName = md5($appId) . '_access_token';

        $accessToken = $this->cacheService->get($accessFileName);

        if ($accessToken) return $accessToken;

        $data = $this->getHRToAB(WXConfig::getAccessTokenUrl($appId, $secret));

        $accessToken = B()->getData($data, 'access_token');

        if (empty($accessToken)) throw new Exception(B()->getData($data, 'errmsg'));

        $this->cacheService->add($accessFileName, $accessToken, B()->getData($data, 'expires_in'));

        return $accessToken;
    }

    /**
     * 获取微信公众平台Sdk
     * @param $appId
     * @param $secret
     * @return Publicly
     */
    public function getPubliclySdk($appId, $secret)
    {
        return new Publicly($appId, $secret, $this->getCacheService());
    }

    /**
     * 获取微信小程序
     * @param $appId
     * @param $secret
     * @return Mini
     */
    public function getMiniSdk($appId, $secret)
    {
        return new Mini($appId, $secret, $this->getCacheService());
    }

}