<?php

namespace rapidPHP\plugin\wxsdk;

use Exception;
use rapidPHP\config\plugin\WXConfig;
use rapidPHP\library\AB;

class  WXSdk
{

    /**
     * 缓存json文件
     * @param $name
     * @param $data
     * @param int $time
     * @return bool|int
     * @throws Exception
     */
    protected function addCache($name, $data, $time = null)
    {
        $cachePath = ROOT_RUNTIME . 'plugin/wx/json/';

        if (!is_dir($cachePath) && !mkdir($cachePath, 0777, true))
            throw new Exception('创建缓存目录失败!');

        $cacheFile = $cachePath . $name . '.json';

        $cache = ['data' => $data];

        if (is_int($time)) $cache['time'] = time() + $time;

        return F()->write($cacheFile, json_encode($cache));
    }

    /**
     * 获取缓存的json文件
     * @param $name
     * @return array
     */
    protected function getCache($name)
    {
        $cacheFile = ROOT_RUNTIME . 'plugin/wx/json/' . $name . '.json';

        if (!is_file($cacheFile)) return [];

        $cache = B()->jsonDecode(file_get_contents($cacheFile));

        if (!is_array($cache)) return [];

        $time = isset($cache['time']) ? $cache['time'] : null;

        $data = B()->getData($cache, 'data');

        return is_int($time) ? time() <= $time ? $data : [] : $data;
    }

    /**
     * 获取http请求
     * @param $url
     * @return AB|string|null
     * @throws Exception
     */
    protected function getHRToAB($url)
    {
        $res = B()->getHttpResponse($url);

        if (empty($res)) throw new Exception('获取数据失败!');

        if (substr($res, 0, 1) != '{') return $res;

        $data = B()->jsonDecode($res);

        if (empty($data)) throw new Exception('解析数据失败!');

        return new AB($data);
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

        $accessToken = $this->getCache($accessFileName);

        if ($accessToken) return $accessToken;

        $data = $this->getHRToAB(WXConfig::getAccessTokenUrl($appId, $secret));

        $accessToken = $data->getString('access_token');

        if (empty($accessToken)) throw new Exception($data->getString('errmsg'));

        $this->addCache($accessFileName, $accessToken, $data->getInt('expires_in'));

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
        return new Publicly($appId, $secret);
    }

    /**
     * 获取微信小程序
     * @param $appId
     * @param $secret
     * @return Mini
     */
    public function getMiniSdk($appId, $secret)
    {
        return new Mini($appId, $secret);
    }
}