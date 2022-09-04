<?php

namespace rapidPHP\modules\common\classier;

class Build
{
    /**
     * 采用单例模式
     */
    use Instances;

    /**
     * 实例不存在
     * @return static
     */
    public static function onNotInstance()
    {
        return new static();
    }

    /**
     * 解析数组
     * @param array|null $array
     * @param $key
     * @return mixed|array|string|int|null|object
     */
    public function getData(?array $array, $key)
    {
        if (is_null($array)) return null;

        if (array_key_exists($key, $array)) return $array[$key];

        return null;
    }

    /**
     * Json解析
     * @param string|null $json
     * @param $key
     * @return mixed|null
     */
    public function jsonDecode(?string $json, $key = null)
    {
        if (empty($json)) return null;

        $json = trim($json, "\xEF\xBB\xBF");

        $array = json_decode($json, true);

        return $key ? $this->getData($array, $key) : $array;
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
        return !empty($value) ? $value : ($default === '' || is_null($default) ? $value : $default);
    }


    /**
     * 获取正则内容
     * @param string $pattern
     * @param string $subject
     * @param int $index
     * @return mixed|null
     */
    public function getRegular(string $pattern, string $subject, int $index = 1)
    {
        return preg_match($pattern, $subject, $data) ? $this->getData($data, $index) : null;
    }

    /**
     * 获取正则内容
     * @param string $pattern
     * @param string $subject
     * @param int $index
     * @param array $data
     * @return array|null|string
     */
    public function getRegularAll(string $pattern, string $subject, int $index = 1, array &$data = [])
    {
        return preg_match_all($pattern, $subject, $data) ? $this->getData($data, $index) : null;
    }


    /**
     * 判断字符串是否为 Json 格式
     *
     * @param string|null $data Json 字符串
     * @param bool $assoc 是否返回关联数组。默认返回对象
     *
     * @return bool
     */
    public function isJson(?string $data = '', bool $assoc = false): bool
    {
        if (empty($data)) return false;

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
    public function toTypeConvert(&$value)
    {
        if (is_null($value)) return;

        if (is_array($value)) {
            foreach ($value as $name => $v) {
                $this->toTypeConvert($v);

                $value[$name] = $v;
            }
        } else if (is_object($value)) {
            foreach ($value as $name => $v) {
                $this->toTypeConvert($v);

                $value->$name = $v;
            }
        } else if (Verify::getInstance()->decimal($value)) {
            $value = (double)$value;
        } else if (is_numeric($value)) {
            if (substr($value, 0, 1) == '+') return;

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
    public function toTypeConvertByAO(&$data)
    {
        foreach ($data as &$value) $this->toTypeConvert($value);
    }

    /**
     * 是否内网
     * @param $ip
     * @return bool
     */
    public function isIntranet($ip): bool
    {
        return !filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE);
    }
}
