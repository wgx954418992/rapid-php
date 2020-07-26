<?php

namespace rapidPHP\library\core\server;

use rapidPHP\config\AppConfig;
use rapidPHP\library\cache\CacheInterface;
use rapidPHP\library\StrCharacter;
use ReflectionException;

abstract class Request
{
    /**
     * @var SwooleServer
     */
    private $swooleServer;

    /**
     * sessionId
     * @var string
     */
    private $sessionId;

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
     *  Http请求相关的服务器信息，相当于PHP的$_SERVER数组。包含了Http请求的方法，URL路径，客户端IP等信息。key全部为大写
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
     * Request constructor.
     * @param SwooleServer|null $swooleServer
     * @param $get
     * @param $post
     * @param $files
     * @param $cookie
     * @param $sessionId
     * @param $header
     * @param $serverInfo
     * @param $rawContent
     */
    protected function __construct(?SwooleServer $swooleServer, $get, $post, $files, $cookie, $sessionId, $header, $serverInfo, $rawContent)
    {
        $this->swooleServer = $swooleServer;
        $this->get = is_null($get) ? [] : $get;
        $this->post = is_null($post) ? [] : $post;
        $this->files = is_null($files) ? [] : $files;
        $this->cookie = is_null($cookie) ? [] : $cookie;
        $this->header = is_null($header) ? [] : $header;
        $this->serverInfo = is_null($serverInfo) ? [] : $serverInfo;
        $this->rawContent = $rawContent;

        $this->setSessionId($sessionId);
    }


    /**
     * 获取重命名的header,key 首字母全部转大写
     * @param $header
     * @return array
     */
    protected static function getRenameHeader($header)
    {
        $headers = [];
        foreach ($header as $item => $value) {
            $headers[Str()->toFirstUppercase($item, '-', '-')] = $value;
        }
        return $headers;
    }

    /**
     * 获取重命名的server，key全部转大写
     * @param $server
     * @return array
     */
    protected static function getRenameServerInfo($server)
    {
        return array_change_key_case(is_null($server) ? [] : $server, CASE_UPPER);
    }

    /**
     * getAllHeaders
     * @param $serverInfo
     * @return array
     */
    protected static function getAllHeaders(&$serverInfo)
    {
        $headers = [];

        foreach ($serverInfo as $name => $value) {
            if (substr($name, 0, 5) == 'HTTP_') {
                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
                unset($serverInfo[$name]);
            }
        }

        return $headers;
    }

    /**
     * @return SwooleServer
     */
    public function getSwooleServer()
    {
        return $this->swooleServer;
    }

    /**
     * @return string
     */
    public function getSessionId(): ?string
    {
        return $this->sessionId;
    }

    /**
     * @param string $sessionId
     */
    public function setSessionId(?string $sessionId): void
    {
        $this->sessionId = $sessionId;
    }

    /**
     * 获取get参数
     * @param $name
     * @return mixed|null
     */
    public function get($name = null)
    {
        if (is_null($name)) return $this->get;

        return B()->getData($this->get, $name);
    }

    /**
     * 获取post参数
     * @param $name
     * @return mixed|null
     */
    public function post($name = null)
    {
        if (is_null($name)) return $this->post;

        return B()->getData($this->post, $name);
    }

    /**
     * 获取cookie参数
     * @param $name
     * @return mixed|null
     */
    public function cookie($name = null)
    {
        if (is_null($name)) return $this->cookie;

        return B()->getData($this->cookie, $name);
    }

    /**
     * 获取session参数
     * @param $name
     * @return mixed|null
     * @throws ReflectionException
     */
    public function session($name = null)
    {
        if (empty($this->getSessionId())) return $name ? null : [];

        /** @var CacheInterface $cacheService */
        $cacheService = M(SESSION_SERVICE);

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

        return B()->getData($this->raw, $name);
    }

    /**
     * 获取文件
     * @param $name
     * @return array|null|string
     */
    public function file($name = null)
    {
        if (is_null($name)) return $this->files;

        return B()->getData($this->files, $name);
    }

    /**
     * request(get|post|cookie|session|put,file)
     * @param $name
     * @return array|null|string
     * @throws ReflectionException
     */
    public function request($name = null)
    {
        $req = array_merge($this->get(), $this->post(), $this->cookie(), $this->session(), $this->put(), $this->file());

        if (is_null($name)) return $req;

        return B()->getData($req, $name);
    }

    /**
     * 获取请求变量
     * @param $name
     * @param null $method ：方法(get|post|cookie|session|put)
     * @return bool|string
     * @throws ReflectionException
     */
    public function getParam($name, $method = null)
    {
        switch (strtoupper($method)) {
            case AppConfig::REQUEST_PARAM_GET:
                return $this->get($name);
            case AppConfig::REQUEST_PARAM_POST:
                return $this->post($name);
            case AppConfig::REQUEST_PARAM_COOKIE:
                return $this->cookie($name);
            case AppConfig::REQUEST_PARAM_PUT:
                return $this->put($name);
            case AppConfig::REQUEST_PARAM_SESSION:
                return $this->session($name);
            case AppConfig::REQUEST_PARAM_FILE:
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

        return B()->getData($this->header, $name);
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
        $mode = B()->getData($this->serverInfo, 'REQUEST_SCHEME');

        $isHttps = $this->swooleServer ? $this->swooleServer->isHttps() : false;

        return $mode ? $mode : ($isHttps ? 'https' : 'http');
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

        $host = B()->getData($this->header, 'Host');

        $request = B()->getData($this->serverInfo, 'REQUEST_URI');

        $url = $mode . '://' . $host . $request;

        if ($meter === false && is_int(strpos($url, '?'))) {

            $url = B()->getData(explode('?', $url), 0);
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
            $ip = B()->getData($this->serverInfo, 'REMOTE_ADDR');
        }
        return $ip;
    }

    /**
     * 获取请求源
     * @return array|null|string
     */
    public function getUserAgent(): ?string
    {
        return B()->getData($this->header, 'User_Agent');
    }

    /**
     * 获取网站根url
     * @param string $rootPath
     * @return mixed
     */
    public function getHostUrl(string $rootPath = ROOT_PATH): string
    {
        $mode = $this->getScheme();

        $host = B()->getData($this->header, 'Host');

        $root = B()->getData($this->serverInfo, 'DOCUMENT_ROOT');

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
        return B()->getData($this->serverInfo, 'REQUEST_METHOD');
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

        $pathParam = B()->getRegularAll('/\{(\w+)\}/i', $path);

        $replace = [];

        foreach ($data as $name => $value) {
            $key = is_numeric($name) ? B()->getData($pathParam, $name) : $name;

            if (is_int(strpos($path, "{{$key}}"))) {

                unset($data[$name]);

                $replace["{{$key}}"] = $value;
            }
        }

        $path = str_replace(array_keys($replace), $replace, $path);

        $query = B()->toUrlString($data);

        return $path . (!empty($query) ? '?' . $query : '');
    }
}