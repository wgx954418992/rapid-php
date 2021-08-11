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
        return new static();
    }

    /**
     * 是否正则表达式
     * @param $pattern
     * @return bool
     */
    public function preg($pattern): bool
    {
        return (substr($pattern, 0, 1)) == '/' && preg_match("/\/(.*)\//i", $pattern);
    }

    /**
     * 验证邮箱
     * @param $email
     * @return bool
     */
    public function email($email): bool
    {
        return preg_match("/^[0-9a-zA-Z]+(?:[_-][a-z0-9-]+)*@[a-zA-Z0-9]+(?:[-.][a-zA-Z0-9]+)*.[a-zA-Z]+$/i", $email) === 1;
    }

    /**
     * 验证电话
     * @param $tel
     * @return bool
     */
    public function tel($tel): bool
    {
        return preg_match("/^[1][34587][0-9]{9}$/i", $tel) === 1;
    }

    /**
     * 验证ip地址
     * @param $ip
     * @return bool
     */
    public function ip($ip): bool
    {
        return preg_match('/^[\d.]*$/is', $ip) === 1;
    }

    /**
     * 验证url
     * @param $url
     * @return bool
     */
    public function website($url): bool
    {
        return preg_match('/^http[s]?:\/\/' .
                '(([0-9]{1,3}\.){3}[0-9]{1,3}' . // IP形式的URL- 199.194.52.184
                '|' . // 允许IP和DOMAIN（域名）
                '([0-9a-z_!~*\'()-]+\.)*' . // 三级域验证- www.
                '([0-9a-z][0-9a-z-]{0,61})?[0-9a-z]\.' . // 二级域验证
                '[a-z]{2,6})' .  // 顶级域验证.com or .museum
                '(:[0-9]{1,4})?' .  // 端口- :80
                '((\/\?)|' .  // 如果含有文件对文件部分进行校验
                '(\/.*)?)$/u', $url) === 1;
    }

    /**
     * 是否小数
     * @param $str
     * @return bool
     */
    public function decimal($str): bool
    {
        if (is_array($str) || is_object($str)) return false;

        if (is_float($str) || is_double($str)) return true;

        return preg_match('/^(-?\d+)(\.\d+)$/', $str) === 1;
    }
}
