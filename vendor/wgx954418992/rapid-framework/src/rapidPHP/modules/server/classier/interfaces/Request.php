<?php

namespace rapidPHP\modules\server\classier\interfaces;

use rapidPHP\modules\common\classier\Build;
use rapidPHP\modules\common\classier\Uri;
use rapidPHP\modules\server\config\SessionConfig;
use rapidPHP\modules\server\config\HttpConfig;

abstract class Request
{
    /**
     * Http请求的GET参数，相当于PHP中的$_GET，格式为数组
     * 为防止HASH攻击，GET参数最大不允许超过128个
     * @var array
     */
    private $get;

    /**
     * POST与Header加起来的尺寸不得超过package_max_length的设置，否则会认为是恶意请求
     * POST参数的个数最大不超过128个
     * @var array HTTP POST参数，格式为数组
     */
    private $post;

    /**
     * files
     * @var array
     */
    private $files;

    /**
     * HTTP请求携带的COOKIE信息，与PHP的$_COOKIE相同，格式为数组。
     * @var array
     */
    private $cookie;

    /**
     * Http请求的头部信息。类型为数组，所有key的首字母均为大写，并且 以 - 连接符分割。如：Accept-Language，User-Agent
     * @var array
     */
    private $header;

    /**
     * Http请求相关的服务器信息，相当于PHP的$_SERVER数组。包含了Http请求的方法，URL路径，客户端IP等信息。key全部为大写
     * @var array
     */
    private $serverInfo;

    /**
     * 获取非urlencode-form表单的POST原始数据
     * @var string
     */
    private $rawContent;

    /**
     * 获取非urlencode-form表单的POST处理后的数据
     * @var array
     */
    private $raw;

    /**
     * @var SessionConfig|null
     */
    private $sessionConfig;

    /**
     * sessionId
     * @var string|null
     */
    private $sessionId;

    /**
     * 获取重命名的server，key全部转大写
     * @param $server
     * @return array
     */
    public static function getRenameServerInfo($server)
    {
        return array_change_key_case(is_null($server) ? [] : $server, CASE_UPPER);
    }

    /**
     * Request constructor.
     * @param $get
     * @param $post
     * @param $files
     * @param $cookie
     * @param $sessionId
     * @param $header
     * @param $serverInfo
     * @param $rawContent
     * @param SessionConfig|null $sessionConfig
     */
    public function __construct(
        $get,
        $post,
        $files,
        $cookie,
        $header,
        $serverInfo,
        $rawContent,
        ?SessionConfig $sessionConfig,
        ?string $sessionId
    )
    {
        $this->get = is_null($get) ? [] : $get;

        $this->post = is_null($post) ? [] : $post;

        $this->files = is_null($files) ? [] : $files;

        $this->cookie = is_null($cookie) ? [] : $cookie;

        $this->header = is_null($header) ? [] : $header;

        $this->serverInfo = is_null($serverInfo) ? [] : $serverInfo;

        $this->rawContent = $rawContent;

        $this->sessionConfig = $sessionConfig;

        $this->sessionId = $sessionId;
    }

    /**
     * @return string|null
     */
    public function getSessionId(): ?string
    {
        return $this->sessionId;
    }

    /**
     * @return SessionConfig|null
     */
    public function getSessionConfig(): ?SessionConfig
    {
        return $this->sessionConfig;
    }

    /**
     * 获取get参数
     * @param $name
     * @return mixed|null
     */
    public function get($name = null)
    {
        if (is_null($name)) return $this->get;

        return Build::getInstance()->getData($this->get, $name);
    }

    /**
     * 获取post参数
     * @param $name
     * @return mixed|null
     */
    public function post($name = null)
    {
        if (is_null($name)) return $this->post;

        return Build::getInstance()->getData($this->post, $name);
    }

    /**
     * 获取cookie参数
     * @param $name
     * @return mixed|null
     */
    public function cookie($name = null)
    {
        if (is_null($name)) return $this->cookie;

        return Build::getInstance()->getData($this->cookie, $name);
    }

    /**
     * 获取session参数
     * @param $name
     * @return mixed|null
     */
    public function session($name = null)
    {
        $sessionConfig = $this->sessionConfig;

        if ($sessionConfig == null) return $name ? null : [];

        if (empty($this->sessionId)) return $name ? null : [];

        $cacheService = $sessionConfig->getService();

        if ($cacheService == null) return $name ? null : [];

        $cacheKey = 'session_' . $this->getSessionId();

        $cacheData = $cacheService->get($cacheKey);

        if (!is_array($cacheData)) return $name ? null : [];

        foreach ($cacheData as $index => $datum) {
            if (is_string($datum)) $datum = unserialize($datum);

            if (!is_null($name) && $name == $index) return $datum;

            $cacheData[$index] = $datum;
        }

        return $cacheData;
    }

    /**
     * 获取put参数
     * @param $name
     * @return mixed|string|null
     */
    public function put($name = null)
    {
        if (is_null($this->raw)) parse_str($this->rawContent, $this->raw);

        if (is_null($name)) return $this->raw;

        return Build::getInstance()->getData($this->raw, $name);
    }

    /**
     * 获取文件
     * @param $name
     * @return array|null|string
     */
    public function file($name = null)
    {
        if (is_null($name)) return $this->files;

        return Build::getInstance()->getData($this->files, $name);
    }

    /**
     * request(get|post|cookie|session|put,file)
     * @param $name
     * @return array|null|string
     */
    public function request($name = null)
    {
        $req = array_merge($this->get(), $this->post(), $this->cookie(), $this->session(), $this->put(), $this->file());

        if (is_null($name)) return $req;

        return Build::getInstance()->getData($req, $name);
    }

    /**
     * 获取请求变量
     * @param $name
     * @param null $method ：方法(get|post|cookie|session|put)
     * @return bool|string
     */
    public function getParam($name, $method = null)
    {
        switch (strtoupper($method)) {
            case HttpConfig::PARAM_GET:
                return $this->get($name);
            case HttpConfig::PARAM_POST:
                return $this->post($name);
            case HttpConfig::PARAM_COOKIE:
                return $this->cookie($name);
            case HttpConfig::PARAM_PUT:
                return $this->put($name);
            case HttpConfig::PARAM_SESSION:
                return $this->session($name);
            case HttpConfig::PARAM_FILE:
                return $this->file($name);
            default:
                return $this->request($name);
        }
    }


    /**
     * 获取header
     * @param null $name
     * @return array|mixed|null
     */
    public function header($name = null)
    {
        if (is_null($name)) return $this->header;

        return Build::getInstance()->getData($this->header, $name);
    }

    /**
     * @return array
     */
    public function serverInfo(): array
    {
        return $this->serverInfo;
    }

    /**
     * @return string
     */
    public function rawContent(): string
    {
        return $this->rawContent;
    }

    /**
     * 获取请求scheme
     * @return mixed|string
     */
    public function getScheme()
    {
        $mode = Build::getInstance()->getData($this->serverInfo, 'REQUEST_SCHEME');

        return $mode ? $mode : 'http';
    }

    /**
     * 获取当前访问的网站Url
     * @param bool|false $meter
     * @param bool $isDecode
     * @return string
     */
    public function getUrl($meter = false, $isDecode = true): string
    {
        $mode = $this->getScheme();

        $host = Build::getInstance()->getData($this->header, 'Host');

        $request = Build::getInstance()->getData($this->serverInfo, 'REQUEST_URI');

        $url = $mode . '://' . $host . $request;

        if ($meter === false && is_int(strpos($url, '?'))) {

            $url = Build::getInstance()->getData(explode('?', $url), 0);
        }

        return $isDecode ? urldecode($url) : $url;
    }

    /**
     * 获取客户端Ip
     * @return mixed
     */
    public function getIp(): ?string
    {
        if (isset($this->header['X-Real-Ip'])) {
            $ip = $this->header['X-Real-Ip'];
        } else if (getenv('HTTP_CLIENT_IP')) {
            $ip = getenv('HTTP_CLIENT_IP');
        } elseif (getenv('HTTP_X_FORWARDED_FOR')) {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
        } elseif (getenv('HTTP_X_FORWARDED')) {
            $ip = getenv('HTTP_X_FORWARDED');
        } elseif (getenv('HTTP_FORWARDED_FOR')) {
            $ip = getenv('HTTP_FORWARDED_FOR');
        } elseif (getenv('HTTP_FORWARDED')) {
            $ip = getenv('HTTP_FORWARDED');
        } else {
            $ip = Build::getInstance()->getData($this->serverInfo, 'REMOTE_ADDR');

            if (empty($ip)) $ip = Build::getInstance()->getData($this->serverInfo, 'REMOTE_IP');
        }
        return $ip;
    }

    /**
     * 获取请求源
     * @return array|null|string
     */
    public function getUserAgent(): ?string
    {
        return Build::getInstance()->getData($this->header, 'User-Agent');
    }

    /**
     * 获取网站根url
     * @param string $rootPath
     * @return mixed
     */
    public function getHostUrl(string $rootPath = PATH_APP): string
    {
        $mode = $this->getScheme();

        $host = Build::getInstance()->getData($this->header, 'Host');

        $root = Build::getInstance()->getData($this->serverInfo, 'DOCUMENT_ROOT');

        if (empty($root)) $root = $rootPath;

        $rootDir = str_replace($root, '', $rootPath);

        $rootDir = substr($rootDir, 0, 1) != '/' ? "/$rootDir" : $rootDir;

        return $mode . "://{$host}{$rootDir}";
    }

    /**
     * 获取请求的文档路径
     * @return string
     */
    public function getDocumentRoot(): string
    {
        $hostUrl = $this->getHostUrl();

        $url = $this->getUrl();

        $documentRoot = (string)str_replace($hostUrl, '', $url);

        if (empty($documentRoot)) $documentRoot = '/';

        return $documentRoot;
    }

    /**
     * 获取请求方法
     * @return array|null|string
     */
    public function getMethod(): ?string
    {
        return Build::getInstance()->getData($this->serverInfo, 'REQUEST_METHOD');
    }

    /**
     * 通过参数生成url
     * @param null $path
     * @return string
     */
    public function toUrl($path = null)
    {
        $path = !is_string($path) ? $this->getUrl() : $this->getHostUrl() . $path;

        $args = func_get_args();

        if (isset($args[0]) && $path === $args[0]) unset($args[0]);

        $data = [];

        foreach ($args as $value) $data = array_merge($data, (array)$value);

        $pathParam = Build::getInstance()->getRegularAll('/\{(\w+)\}/i', $path);

        $replace = [];

        foreach ($data as $name => $value) {
            $key = is_numeric($name) ? Build::getInstance()->getData($pathParam, $name) : $name;

            if (is_int(strpos($path, "{{$key}}"))) {

                unset($data[$name]);

                $replace["{{$key}}"] = $value;
            }
        }

        $path = str_replace(array_keys($replace), $replace, $path);

        $query = Uri::getInstance()->toQuery($data);

        return $path . (!empty($query) ? '?' . $query : '');
    }

    /**
     * 判断是否微信客户端
     * @return bool
     */
    public function isWXClient()
    {
        return is_int(strpos($this->getUserAgent(), 'MicroMessenger'));
    }

    /**
     * 判断是否移动端
     * @return bool
     */
    public function isMobile()
    {
        $userAgent = $this->getUserAgent();

        if (is_int(strpos($userAgent, 'iphone')))
            return true;

        return is_int(strpos($userAgent, 'android'));
    }
}