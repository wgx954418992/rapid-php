<?php

namespace rapidPHP\modules\common\classier;

class Verify
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
        return new static(...func_get_args());
    }

    /**
     * 是否正则表达式
     * @param $pattern
     * @return int
     */
    public function preg($pattern)
    {
        return (substr($pattern, 0, 1)) == '/' && preg_match("/\/(.*)\//i", $pattern);
    }

    /**
     * 验证邮箱
     * @param $email
     * @return int
     */
    public function email($email): int
    {
        return preg_match("/^[0-9a-zA-Z]+(?:[_-][a-z0-9-]+)*@[a-zA-Z0-9]+(?:[-.][a-zA-Z0-9]+)*.[a-zA-Z]+$/i", $email);
    }

    /**
     * 验证电话
     * @param $tel
     * @return int
     */
    public function tel($tel): int
    {
        return preg_match("/^[1][34587][0-9]{9}$/i", $tel);
    }

    /**
     * 验证ip地址
     * @param $ip
     * @return int
     */
    public function ip($ip): int
    {
        return preg_match('/^[\d.]*$/is', $ip);
    }

    /**
     * 验证url
     * @param $url
     * @return int
     */
    public function website($url)
    {
        return preg_match('/^http[s]?:\/\/' .
                '(([0-9]{1,3}\.){3}[0-9]{1,3}' . // IP形式的URL- 199.194.52.184
                '|' . // 允许IP和DOMAIN（域名）
                '([0-9a-z_!~*\'()-]+\.)*' . // 三级域验证- www.
                '([0-9a-z][0-9a-z-]{0,61})?[0-9a-z]\.' . // 二级域验证
                '[a-z]{2,6})' .  // 顶级域验证.com or .museum
                '(:[0-9]{1,4})?' .  // 端口- :80
                '((\/\?)|' .  // 如果含有文件对文件部分进行校验
                '(\/.*)?)$/u', $url) == 1;
    }

    /**
     * 是否小数
     * @param $str
     * @return false|int
     */
    public function decimal($str)
    {
        if (is_array($str) || is_object($str)) return false;

        if (is_float($str) || is_double($str)) return $str;

        return preg_match('/^(-?\d+)(\.\d+)$/', $str);
    }
}