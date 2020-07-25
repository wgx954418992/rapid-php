<?php

namespace rapidPHP\library;

use Exception;
use rapid\library\rapid;
use rapidPHP\config\AppConfig;
use rapidPHP\library\core\Loader;
use ReflectionClass;
use ReflectionException;

class Build
{
    private static $instance;

    public static function getInstance()
    {
        return self::$instance instanceof self ? self::$instance : self::$instance = new self();
    }

    /**
     * 解析数组
     * @param array|null $array
     * @param $key
     * @return mixed|null
     */
    public function getData(?array $array, $key)
    {
        return isset($array[$key]) ? $array[$key] : null;
    }

    /**
     * Json解析
     * @param string|null $json
     * @param null $key
     * @return mixed|null
     */
    public function jsonDecode($json, $key = null)
    {
        if (empty($json)) return null;

        $json = trim($json, "\xEF\xBB\xBF");

        $array = json_decode($json, true);

        return $key ? $this->getData($array, $key) : $array;
    }


    /**
     * 获取url字符串的query参数
     * @param string $url
     * @param bool $isRemove
     * @return array
     */
    public function getUrlQueryStringToArray(string &$url, $isRemove = false): array
    {
        if (!is_int(strpos($url, '?'))) return [];

        $urlQuery = explode('/', $url);

        $queryString = explode('?', end($urlQuery));

        $queryString = end($queryString);

        parse_str($queryString, $list);

        if ($isRemove) {
            $url = rtrim(str_replace($queryString, '', $url), '?');
        }

        return $list;
    }


    /**
     * 把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
     * @param $data
     * @param bool $isEncode
     * @param bool $isEmpty
     * @param string $connector
     * @return string
     */
    public function toUrlString($data, $isEncode = false, $isEmpty = true, $connector = '&')
    {
        $arg = '';

        foreach ($data as $key => $value)
            if (!is_array($value) && ($isEmpty == true && !empty($value) || $isEmpty == false))
                $arg .= (empty($arg) ? "" : $connector) . "{$key}=" . ($isEncode ? urlencode($value) : $value);

        return $arg;
    }


    /**
     * 目录后退，可指定后退次数
     * @param $path
     * @param int $count
     * @return string
     */
    public function dirName($path, $count = 1)
    {
        $count = (int)$count;

        while ($count > 0) {
            $count--;

            $path = dirname($path);
        }

        return $path == '' || $path == DIRECTORY_SEPARATOR ? '/' : "{$path}/";
    }

    /**
     * 随机生成字符串
     * @param int $count
     * @param string $strings
     * @return string|int
     */
    public function randoms(int $count = 4, string $strings = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'): string
    {
        $code = '';

        for ($i = 0; $i < $count; $i++) {
            $code .= $strings[mt_rand(0, strlen($strings) - 1)];
        }

        return $code;
    }


    /**
     * 生成唯一id
     * @return string
     */
    public function onlyId(): string
    {
        return md5($this->randoms(10) . microtime());
    }

    /**
     * 生成数字唯一id
     * @param int|null $count
     * @return int
     */
    public function onlyIdToInt(?int $count = 11): int
    {
        $result = (int)$this->randoms($count, '0123456789');

        if (strlen($result) < $count) {
            $result = $this->randoms($count - strlen($result), '123456789')
                . $result;
        }

        return (int)$result;
    }


    /**
     * 两值对比，如果第一个存在返回第一个值，否则返回第二个
     * @param $value
     * @param $default
     * @return mixed
     */
    public function contrast($value, $default)
    {
        return !empty($value) ? $value : $default === '' || is_null($default) ? $value : $default;
    }


    /**
     * 获取正则内容
     * @param string $pattern
     * @param string $subject
     * @param int $index
     * @return mixed|null
     */
    public function getRegular(string $pattern, string $subject, $index = 1)
    {
        return preg_match($pattern, $subject, $data) ? $this->getData($data, $index) : null;
    }

    /**
     * 获取正则内容
     * @param $pattern
     * @param $subject
     * @param int $index
     * @param array $data
     * @return array|null|string
     */
    public function getRegularAll(string $pattern, string $subject, int $index = 1, array &$data = [])
    {
        return preg_match_all($pattern, $subject, $data) ? $this->getData($data, $index) : null;
    }


    /**
     * 获取路径信息
     * @param $path
     * @return array
     */
    public function getPathInfo(string $path): array
    {
        $info = explode('/', Loader::formatPath($path));

        $filename = str_replace('?', '\?', end($info));

        $filenameInfo = explode('.', $filename);

        return [
            'dir' => str_replace($filename, '', $path), 'filename' => $filename,

            'prefix' => $this->getData(pathinfo($path), 'filename'),

            'suffix' => count($filenameInfo) == 1 ? null : end($filenameInfo)
        ];
    }

    /**
     * 生成cookie
     * @param $cookie
     * @return string
     */
    public function makeCookie($cookie): string
    {
        $strCookie = '';

        if (is_array($cookie)) {
            foreach ($cookie as $item => $value) $strCookie .= "$item=$value;";
        } else {
            $strCookie = (string)$cookie;
        }

        return $strCookie;
    }


    /**
     * 发送httpResponse
     * @param string $url
     * @param $post
     * @param int $timeout
     * @param array $cookie
     * @param array $setOpt
     * @param bool $isBuild
     * @return string|null
     */
    public function getHttpResponse(string $url, $post = [],
                                    int $timeout = 5000,
                                    array $cookie = [],
                                    array $setOpt = [],
                                    bool $isBuild = true): ?string
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($curl, CURLOPT_HEADER, 0);

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        if (!empty($post)) {
            curl_setopt($curl, CURLOPT_POST, 1);

            curl_setopt($curl, CURLOPT_POSTFIELDS, is_array($post) && $isBuild ? http_build_query($post) : $post);
        }

        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);

        curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);

        curl_setopt($curl, CURLOPT_COOKIE, !is_string($cookie) ? $this->makeCookie($cookie) : $cookie);

        foreach ($setOpt as $item => $value) curl_setopt($curl, $item, $value);

        $executive = curl_exec($curl);

        if (curl_errno($curl)) return null;

        curl_close($curl);

        return $executive;
    }


    /**
     * 解析http_response_headers
     * @param $headers
     * @return array
     */
    public function parseHeaders(array $headers): array
    {
        $head = [];

        foreach ($headers as $k => $v) {

            $t = explode(':', $v, 2);

            if (isset($t[1])) {
                $head[trim($t[0])] = trim($t[1]);
            } else {
                $head[] = $v;

                if (preg_match("#HTTP/[0-9.]+\s+([0-9]+)#", $v, $out)) {
                    $head['response_code'] = intval($out[1]);
                }
            }
        }

        return $head;
    }

    /**
     * 获取Http响应头
     * @param $url
     * @param string $headers
     * @param array $context
     * @return array
     */
    public function getHTTPResponseHeaders(string $url, string $headers = '', array $context = []): array
    {
        $uri = parse_url($url);

        $host = $this->getData($uri, 'host');

        $scheme = $this->getData($uri, 'scheme');

        $port = $this->contrast($this->getData($uri, 'port'), $scheme === 'https' ? 443 : 80);

        if ($sock = @fsockopen($host, $port, $error)) {
            fputs($sock, "GET {$url} HTTP/1.1\r\n");

            fputs($sock, "Host: {$host}\r\n");

            fputs($sock, "{$headers}");

            foreach ($context as $name => $value) fputs($sock, "$name: $value\r\n");

            fputs($sock, "\r\n\r\n");

            $rawHeaders = [];

            while ($tmp = trim(fgets($sock, 4096))) {
                $rawHeaders [] = $tmp;
            }

            return $this->parseHeaders($rawHeaders);
        }

        return [];
    }



    /**
     * 判断字符串是否为 Json 格式
     *
     * @param string $data Json 字符串
     * @param bool $assoc 是否返回关联数组。默认返回对象
     *
     * @return bool
     */
    public function isJson($data = '', $assoc = false)
    {
        $data = json_decode($data, $assoc);

        if (($data && is_object($data)) || (is_array($data) && !empty($data))) {
            return true;
        }

        return false;
    }

    /**
     * 反射接口类
     * @param $className
     * @param array $classArgs
     * @return object
     * @throws ReflectionException
     */
    public function reflectionInstance($className, $classArgs = [])
    {
        return (new ReflectionClass($className))->newInstanceArgs($classArgs);
    }


    /**
     * 更改变量类型
     * @param $var :变量
     * @param $type :系统类型 或者 json,xml(自动转数组) 或者 databean对象
     * @return bool
     * @throws ReflectionException
     */
    public function setVarType(&$var, $type)
    {
        if (empty($var)) {
            $var = null;
            return false;
        }

        if (empty($type)) return false;

        if (isset(AppConfig::$SET_VAR_DEFAULT_TYPE[$type]) && AppConfig::$SET_VAR_DEFAULT_TYPE[$type] == 1) {
            return settype($var, $type);
        } else if (strtoupper($type) === AppConfig::VAR_TYPE_JSON) {
            $var = $this->jsonDecode($var);
            return true;
        } else if (strtoupper($type) === AppConfig::VAR_TYPE_XML) {
            $var = X()->decode($var);
            return true;
        } else {
            $var = $this->reflectionInstance($type, [$var]);
            return true;
        }
    }


    /**
     * 自动转换类型，比如如果是int就自动转成int
     * @param $value
     */
    public function autoTypeConvert(&$value)
    {
        if (is_null($value)) return;

        if (is_array($value)) {
            foreach ($value as $name => $v) {
                $this->autoTypeConvert($v);

                $value[$name] = $v;
            }
        } else if (is_object($value)) {
            foreach ($value as $name => $v) {
                $this->autoTypeConvert($v);

                $value->$name = $v;
            }
        } else if (V()->decimal($value)) {
            $value = (double)$value;
        } else if (is_numeric($value)) {
            if (substr($value, 0, 1) == '0' && strlen($value) > 1) return;

            $value = (int)$value;
        } else if (is_bool($value)) {
            $value = (bool)$value;
        }
    }

    /**
     * 数组或者对象自动类型转换
     * @param $data
     */
    public function autoTypeConvertByAB(&$data)
    {
        foreach ($data as &$value) $this->autoTypeConvert($value);
    }

    /**
     * 数组转对象
     * @param array|object|null $data 数组或者对象
     * @param $object object|string 对象实例或者对象class
     * @param array|null $params 对象默认初始化参数
     * @return object
     * @throws ReflectionException
     */
    public function toObject($data, $object, ?array $params = [])
    {
        if (empty($data)) return is_object($object) ? $object : null;

        if (empty($object)) return $object;

        if (is_string($object) && is_file(Loader::getFilePath($object))) {
            $object = (new ReflectionClass($object))->newInstanceArgs($params);
        }

        if (!is_object($object)) return null;

        $this->invokeObjectSetterMethods($object, $data);

        return $object;
    }

    /**
     * 反射调用对象的所有set方法
     * @param $object
     * @param $data
     * @return array 返回所有set方法的参数 2维数组
     * @throws ReflectionException
     */
    public function invokeObjectSetterMethods($object, $data)
    {
        $methods = get_class_methods(get_class($object));

        $params = [];

        foreach ($methods as $methodName) {
            $type = substr($methodName, 0, 3);

            if (strtolower($type) !== 'set') continue;

            $params[$methodName] = Reflection::invokeMethod($object, $methodName, $data);
        }

        return $params;
    }


    /**
     * 线程调用脚本
     * @param $bin
     * @param $param
     * @param int $sleep
     * @return bool
     * @throws Exception
     */
    public function threadExec($bin, $param, $sleep = 1)
    {
        if (!function_exists('exec')) throw new Exception('exec 方法不存在!');

        if (!function_exists('popen')) throw new Exception('popen 方法不存在!');

        if (!is_file($bin)) {
            exec('type -P ' . $bin, $out);

            $bin = $this->getData($out, 0);
        }

        if (!is_file($bin)) throw new Exception($bin . ' 文件不存在!');

        $paramString = '';

        foreach ($param as $name => $value) {
            if (empty($value) && empty($name)) continue;

            if (is_string($name)) {
                $paramString .= " {$name} '{$value}'";
            } else {
                $paramString .= " '{$value}'";
            }
        }

        pclose(popen("{$bin} {$paramString}&", "r"));

        sleep($sleep);

        return true;
    }

    /**
     * 线程调用脚本
     * @param $bin
     * @param $script
     * @param array $param
     * @param int $sleep
     * @return bool
     * @throws Exception
     */
    public function threadExecScript($bin, $script = null, $param = [], $sleep = 1)
    {
        if (!is_file($script)) $script = ROOT_PATH . DIRECTORY_SEPARATOR . $script;

        if (!is_file($script)) throw new Exception('脚本不存在!');

        if (!is_null($script)) array_unshift($param, $script);

        return $this->threadExec($bin, $param, $sleep);
    }

}