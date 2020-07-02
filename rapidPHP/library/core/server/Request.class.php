<?php

namespace rapidPHP\library\core\server;

abstract class Request
{
    /**
     * Http请求的GET参数，相当于PHP中的$_GET，格式为数组
     * 为防止HASH攻击，GET参数最大不允许超过128个
     * @var array
     */
    public $get;

    /**
     * POST与Header加起来的尺寸不得超过package_max_length的设置，否则会认为是恶意请求
     * POST参数的个数最大不超过128个
     * @var array HTTP POST参数，格式为数组
     */
    public $post;

    /**
     * files
     * @var array
     */
    public $files;

    /**
     * HTTP请求携带的COOKIE信息，与PHP的$_COOKIE相同，格式为数组。
     * @var array
     */
    public $cookie;

    /**
     * Http请求的头部信息。类型为数组，所有key的首字母均为大写，并且 以 - 连接符分割。如：Accept-Language，User-Agent
     * @var array
     */
    public $header = [];

    /**
     *  Http请求相关的服务器信息，相当于PHP的$_SERVER数组。包含了Http请求的方法，URL路径，客户端IP等信息。key全部为大写
     * @var array
     */
    public $server = [];

    /**
     * 获取非urlencode-form表单的POST原始数据
     * @var string
     */
    public $rawContent;

    /**
     * Request constructor.
     * @param $get
     * @param $post
     * @param $files
     * @param $cookie
     * @param $header
     * @param $server
     * @param $rawContent
     */
    protected function __construct($get, $post, $files, $cookie, $header, $server, $rawContent)
    {
        $this->get = is_null($get) ? [] : $get;
        $this->post = is_null($post) ? [] : $post;
        $this->files = is_null($files) ? [] : $files;
        $this->cookie = is_null($cookie) ? [] : $cookie;
        $this->header = is_null($header) ? [] : $header;
        $this->server = is_null($server) ? [] : $server;
        $this->rawContent = $rawContent;
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
            $headers[B()->toFirstUppercase($item, '-', '-')] = $value;
        }
        return $headers;
    }

    /**
     * 获取重命名的server，key全部转大写
     * @param $server
     * @return array
     */
    protected static function getRenameServer($server)
    {
        return array_change_key_case(is_null($server) ? [] : $server, CASE_UPPER);
    }

    /**
     * getAllHeaders
     * @param $server
     * @return array
     */
    protected static function getAllHeaders(&$server)
    {
        $headers = [];

        foreach ($server as $name => $value) {
            if (substr($name, 0, 5) == 'HTTP_') {
                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
                unset($server[$name]);
            }
        }

        return $headers;
    }


    /**
     * 获取当前访问的网站Url
     * @param bool|false $meter
     * @param bool $isDecode
     * @return string
     */
    public function getUrl($meter = false, $isDecode = true): string
    {
        $mode = B()->getData($this->server, 'REQUEST_SCHEME');

        $mode = $mode ? $mode : 'http';

        $host = B()->getData($this->header, 'Host');

        $request = B()->getData($this->server, 'REQUEST_URI');

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
        }if (getenv('HTTP_CLIENT_IP')) {
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
            $ip = B()->getData($this->server, 'REMOTE_ADDR');
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
        $mode = B()->getData($this->server, 'REQUEST_SCHEME');

        $host = B()->getData($this->header, 'Host');

        $root = B()->getData($this->server, 'DOCUMENT_ROOT');

        if (empty($root)) $root = $rootPath;

        $rootDir = str_replace($root, '', $rootPath);

        $rootDir = substr($rootDir, 0, 1) != '/' ? "/$rootDir" : $rootDir;

        return ($mode ? $mode : 'http') . "://{$host}{$rootDir}";
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
        return B()->getData($this->server, 'REQUEST_METHOD');
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