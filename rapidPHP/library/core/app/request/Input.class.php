<?php

namespace rapidPHP\library\core\app\request;


use rapid\library\rapid;
use rapidPHP\config\AppConfig;
use rapidPHP\library\core\server\Request;

class Input
{

    /**
     * @var Request
     */
    private $request;

    /**
     * Input constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param Request $request
     * @return Input
     */
    public static function getInstance(Request $request)
    {
        return new self($request);
    }

    /**
     * 获取get参数
     * @param $name
     * @return string
     */
    public function get($name)
    {
        $value = B()->getData($this->request->get, $name);

        return is_array($value) ? join('', $value) : $value;
    }

    /**
     * 获取post参数
     * @param $name
     * @return string
     */
    public function post($name)
    {
        $value = B()->getData($this->request->post, $name);

        return is_array($value) ? join('', $value) : $value;
    }

    /**
     * 获取cookie参数
     * @param $name
     * @return string
     */
    public function cookie($name)
    {
        $value = B()->getData($this->request->cookie, $name);

        return is_array($value) ? join('', $value) : $value;
    }

    /**
     * 获取session参数
     * @param $name
     * @return string
     */
    public function session($name)
    {
        return isset($_SESSION) ? B()->getData($_SESSION, $name) : null;
    }

    /**
     * 获取put参数
     * @param $name
     * @return string
     */
    public function put($name)
    {
        $raw = null;

        if (is_null($raw)) parse_str($this->request->rawContent, $raw);

        $value = B()->getData($raw, $name);

        return is_array($value) ? join('', $value) : $value;
    }

    /**
     * request(get|post|cookie|session|put,file)
     * @param $name
     * @return array|null|string
     */
    public function request($name)
    {
        $raw = null;

        if (is_null($raw)) parse_str($this->request->rawContent, $raw);

        if (!isset($_SESSION)) $_SESSION = [];

        $req = array_merge($this->request->get, $this->request->post, $this->request->cookie, $_SESSION, $raw, $this->request->files);

        $value = B()->getData($req, $name);

        return is_array($value) ? join('', $value) : $value;
    }

    /**
     * 获取请求变量
     * @param $name
     * @param null $method ：方法(get|post|cookie|session|put)
     * @return bool|string
     */
    public function getRequest($name, $method = null)
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
     * 获取文件
     * @param $name
     * @return array|null|string
     */
    public function file($name)
    {
        return B()->getData($this->request->files, $name);
    }

}