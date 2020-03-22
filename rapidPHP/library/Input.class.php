<?php

namespace rapidPHP\library;

use rapid\library\rapid;
use rapidPHP\config\AppConfig;

class Input
{

    private static $instance;

    public static function getInstance()
    {
        return self::$instance instanceof self ? self::$instance : self::$instance = new self();
    }


    /**
     * 获取get参数
     * @param $name
     * @return string
     */
    public function get($name)
    {
        $value = B()->getData($_GET, $name);

        return is_array($value) ? join('', $value) : $value;
    }

    /**
     * 获取post参数
     * @param $name
     * @return string
     */
    public function post($name)
    {
        $value = B()->getData($_POST, $name);

        return is_array($value) ? join('', $value) : $value;
    }

    /**
     * 获取cookie参数
     * @param $name
     * @return string
     */
    public function cookie($name)
    {
        $value = B()->getData($_COOKIE, $name);

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
        $_PUT = null;

        if (is_null($_PUT)) parse_str(file_get_contents('php://input'), $_PUT);

        $value = B()->getData($_PUT, $name);

        return is_array($value) ? join('', $value) : $value;
    }

    /**
     * request(get|post|cookie|session|put,file)
     * @param $name
     * @return array|null|string
     */
    public function request($name)
    {
        $_PUT = null;

        if (is_null($_PUT)) parse_str(file_get_contents('php://input'), $_PUT);

        if (!isset($_SESSION) ) $_SESSION = [];

        $req = array_merge($_GET, $_POST, $_COOKIE, $_SESSION, $_PUT, $_FILES);

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
        return B()->getData($_FILES, $name);
    }

}