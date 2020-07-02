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
     * 获取时间戳时间或者本地时间
     * @param int|null $time
     * @param string $format
     * @param string $zone
     * @return false|string
     */
    public function getDate(?int $time = null, string $format = 'Y-m-d H:i:s', string $zone = 'PRC')
    {
        date_default_timezone_set($zone);

        return date($format, $time ? $time : time());
    }

    /**
     * 日期到时间戳
     * @param $date
     * @param string $zone
     * @return false|int
     */
    public function dateToTime($date, string $zone = 'PRC')
    {
        date_default_timezone_set($zone);

        return strtotime($date);
    }

    /**
     * 获取时间是星期几
     * @param int|null $time
     * @return array|string|null
     */
    public function getDateWeekName(?int $time = null)
    {
        if (is_null($time)) $time = time();

        $weeks = ['周天', '周一', '周二', '周三', '周四', '周五', '周六'];

        return $this->getData($weeks, $this->getDate($time, 'w'));
    }

    /**
     * 日期到时间戳
     * @param $date
     * @param string $now
     * @param string $zone
     * @return false|int
     */
    public function dateToTimeNow($date, string $now = 'time()', string $zone = 'PRC')
    {
        date_default_timezone_set($zone);

        return strtotime($date, $now);
    }

    /**
     * 获取url字符串的query参数
     * @param $url
     * @return array
     */
    public function getUrlQueryStringToArray(string $url): array
    {
        $urlQuery = explode('/', $url);

        $queryString = explode('?', end($urlQuery));

        $queryArray = explode('&', end($queryString));

        $list = [];

        foreach ($queryArray as $name => $value) {
            $data = explode('=', $value);

            $dataName = $this->getData($data, 0);

            $dataValue = $this->getData($data, 1);

            $list[$dataName] = $dataValue;
        }

        return $list;
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
     * 删除第一个字符串
     * @param $strings
     * @return string
     */
    public function deleteStringFirst(string $strings): string
    {
        return substr($strings, 1);
    }


    /**
     * 删除最后一个字符串
     * @param $strings
     * @return string
     */
    public function deleteStringLast(string $strings): string
    {
        return substr($strings, 0, -1);
    }


    /**
     * 概率算法
     * @param array $data
     * @return mixed
     */
    public function probability(array $data): array
    {
        return $this->getData($this->probabilityList($data, 1), 0);
    }

    /**
     * 概率算法=》多人中奖
     * @param array $data
     * @param int $count
     * @param bool $isRepeat
     * @param array $result
     * @return array
     */
    public function probabilityList(array $data, int $count = 1,
                                    bool $isRepeat = false,
                                    array $result = []): array
    {
        if ($count < 1) return $result;

        if ($count > count($data)) {
            foreach ($data as $key => $proCur) {
                $result[$key] = $key;
            }

            return $result;
        }

        $proSum = array_sum($data);

        foreach ($data as $key => $proCur) {

            if (!$isRepeat && isset($result[$key])) continue;

            $randNum = mt_rand(1, $proSum);

            if ($randNum <= $proCur) {
                $result[$key] = $key;

                if (count($result) >= $count) return $result;
            } else {
                $proSum -= $proCur;
            }
        }

        if (count($result) < $count)
            return $this->probabilityList($data, $count, $isRepeat, $result);

        return $result;
    }


    /**
     * 生成抽奖数据
     * @param array $data
     * @param $id
     * @param $probability
     * @return array
     */
    public function makeProbabilityData(array $data, string $id, $probability): array
    {
        $result = [];

        foreach ($data as $value) {
            $result[$this->getData($value, $id)] = $this->getData($value, $probability);
        }

        return $result;
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
     * 格式化路径
     * @param $path
     * @return mixed
     */
    public function formatSrc(string $path): string
    {
        return Loader::formatPath($path);
    }


    /**
     * 获取路径信息
     * @param $path
     * @return array
     */
    public function getPathInfo(string $path): array
    {
        $info = explode('/', $this->formatSrc($path));

        $filename = str_replace('?', '\?', end($info));

        $filenameInfo = explode('.', $filename);

        return [
            'dir' => str_replace($filename, '', $path), 'filename' => $filename,

            'prefix' => $this->getData(pathinfo($path), 'filename'),

            'suffix' => count($filenameInfo) == 1 ? null : end($filenameInfo)
        ];
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
     * 把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
     * @param $data
     * @param bool $isEncode
     * @param bool $isEmpty
     * @return string
     */
    public function toUrlString($data, $isEncode = false, $isEmpty = true)
    {
        $arg = '';

        foreach ($data as $key => $value) if (!is_array($value) && ($isEmpty == true && !empty($value) || $isEmpty == false)) $arg .= (empty($arg) ? "" : "&") . "{$key}=" . ($isEncode ? urlencode($value) : $value);

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
     * 首字母转大写
     * @param $string
     * @param string $ext
     * @param string $glue
     * @return string
     */
    public function toFirstUppercase($string, $ext = null, $glue = "")
    {
        if ($ext === null || $ext === '') return ucfirst($string);

        $str = [];

        $array = explode($ext, $string);

        foreach ($array as $value) $str[] = ucfirst($value);

        return join($glue, $str);
    }

    /**
     * 首字母转小写
     * @param $string
     * @param null $ext
     * @param string $glue
     * @return string
     */
    public function toFirstLowercase($string, $ext = null, $glue = "")
    {
        if ($ext === null || $ext === '') return lcfirst($string);

        $str = [];

        $array = explode($ext, $string);

        foreach ($array as $value) $str[] = lcfirst($value);

        return join($glue, $str);
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
     * 获取大小到字节文本
     * @param $size
     * @return string
     */
    public function getByteTextBySize($size)
    {
        $units = [' B', ' KB', ' MB', ' GB', ' TB'];

        for ($i = 0; $size >= 1024 && $i < 4; $i++) $size /= 1024;

        if ($size > 1000) {
            $i++;

            $size = $size / 1024;
        }

        $size = $this->roundNum($size, 2);

        return $size . $units[$i];
    }

    /**
     * 整数转小数
     * @param $num
     * @param $length
     * @return false|string
     */
    public function roundNum($num, $length)
    {
        if ($len = strpos($num, '.')) {

            $dianNum = substr($num, $len + 1, $len + $length + 1);

            if (strlen($dianNum) >= $length) return substr($num, 0, $len + $length + 1);
        }

        return $num;
    }


    /**
     * 通过文本大小获取字节大小
     * @param $str
     * @return float|int
     */
    public function getByteByTextSize($str)
    {
        preg_match('/(\d+)(\w+)/', $str, $matches);

        $type = strtolower($matches[2]);

        switch ($type) {
            case "b":
                $output = $matches[1];
                break;
            case "k":
            case "kb":
                $output = $matches[1] * 1024;
                break;
            case "m":
            case "mb":
                $output = $matches[1] * 1024 * 1024;
                break;
            case "g":
            case "gb":
                $output = $matches[1] * 1024 * 1024 * 1024;
                break;
            case "t":
            case "tb":
                $output = $matches[1] * 1024 * 1024 * 1024 * 1024;
                break;
            default:
                $output = 0;
        }

        return $output;
    }


    /**
     * 计算两点距离
     * @param float $startLongitude 起点经度
     * @param float $startLatitude 起点纬度
     * @param float $endLongitude 终点经度
     * @param float $endLatitude 终点纬度
     * @param int $decimal 精度 保留小数位数
     * @return float
     */
    public function getDistance(float $startLongitude, float $startLatitude, float $endLongitude, float $endLatitude, int $decimal = 2)
    {
        $PI = 3.1415926;

        $EARTH_RADIUS = 6370.996;

        $startRadLat = $startLatitude * $PI / 180.0;
        $endRadLat = $endLatitude * $PI / 180.0;

        $startRadLng = $startLongitude * $PI / 180.0;
        $endRadLng = $endLongitude * $PI / 180.0;

        $radLat = $startRadLat - $endRadLat;
        $radLng = $startRadLng - $endRadLng;

        $distance = 2 * asin(sqrt(pow(sin($radLat / 2), 2) + cos($startRadLat) * cos($endRadLat) * pow(sin($radLng / 2), 2)));

        $distance = $distance * $EARTH_RADIUS * 1000;

        return round($distance, $decimal);
    }


    /**
     * 计算两点距离
     * 超过1000 M 自动转换成 KM
     * @param float $startLongitude
     * @param float $startLatitude
     * @param float $endLongitude
     * @param float $endLatitude
     * @param int $decimal
     * @return string
     */
    public function getDistanceString(float $startLongitude, float $startLatitude, float $endLongitude, float $endLatitude, int $decimal = 2)
    {
        $unit = 'M';

        $distance = $this->getDistance($startLongitude, $startLatitude, $endLongitude, $endLatitude, $decimal);

        if ($distance > 1000) {
            $unit = 'KM';

            $distance = $distance / 1000;
        }

        return $distance . $unit;
    }

    /**
     * 格式化秒自动到 分或者时
     * @param int $second
     * @return string
     */
    public function formatSecond($second = 0)
    {
        $unit = 0;

        $result = $second;

        $unitString = ['秒', '分钟', '小时'];

        while ($result > 59 && $unit < count($unitString) - 1) {
            $unit++;

            $result = floor($result / 60);
        }

        return $result . $unitString[$unit];
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

    /**
     * 判断版本 1.0==1.0.0 or 1=1.0.0
     * @param $newV
     * @param $currentV
     * @return int
     */
    public function versionCompare($newV, $currentV)
    {
        $newV = explode(".", rtrim($newV, ".0"));

        $currentV = explode(".", rtrim($currentV, ".0"));

        foreach ($newV as $depth => $aVal) {
            if (isset($currentV[$depth])) {
                if ($aVal > $currentV[$depth]) return 1;
                else if ($aVal < $currentV[$depth]) return -1;

            } else {
                return 1;
            }
        }

        return (count($newV) < count($currentV)) ? -1 : 0;
    }

    /**
     * 阶加
     * 1+2+3+4+5+...+n
     * @param $n
     * @return float|int
     */
    public function termial($n)
    {
        return (1 + $n) * $n / 2;
    }

    /**
     * 阶乘
     * 1*2*3*4*5*..*n
     * @param $n
     * @return float|int
     */
    public function factorial($n)
    {
        return array_product(range(1, $n));
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
     * 通过长度分割文本
     * @param $string
     * @param int $length
     * @param string $encoding
     * @return array
     */
    public function strSplitByLength($string, $length = 1, $encoding = 'utf8')
    {
        $start = 0;

        $array = [];

        $strLen = mb_strlen($string);

        while ($strLen) {
            $array[] = mb_substr($string, $start, $length, $encoding);

            $string = mb_substr($string, $length, $strLen, $encoding);

            $strLen = mb_strlen($string);
        }

        return $array;
    }
}