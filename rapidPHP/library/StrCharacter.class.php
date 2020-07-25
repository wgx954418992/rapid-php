<?php

namespace rapidPHP\library;

use rapid\library\rapid;

class StrCharacter
{
    /**
     * @var StrCharacter
     */
    private static $instance;

    /**
     * @return StrCharacter
     */
    public static function getInstance()
    {
        return self::$instance instanceof self ? self::$instance : self::$instance = new self();
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
     * 把字符串解析成数组
     * @param $queryString
     * @param string $delimiter
     * @return array
     */
    public function parseStr(?string $queryString, string $delimiter = '&'): array
    {
        $queryArray = explode($delimiter, $queryString);

        $list = [];

        foreach ($queryArray as $name => $value) {
            $data = explode('=', $value);

            $dataName = B()->getData($data, 0);

            $dataValue = B()->getData($data, 1);

            $list[$dataName] = $dataValue;
        }

        return $list;
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

    /**
     * 隐藏姓名第二位
     * @param $name
     * @param string $t
     * @param int $length
     * @return string|string[]|null
     */
    public function hideName($name, $t = '*', $length = 1)
    {
        if (mb_strlen($name, 'utf-8') == 1) return '*';

        while (mb_strlen($t) <= ($length - 1)) {
            $t = $t . $t;
        }

        $first = mb_substr($name, 0, 1);

        $end = mb_substr($name, $length + 1);

        return $first . $t . $end;
    }

    /**
     * 隐藏手机号码中间4位
     * @param $tel
     * @param string $t
     * @return string|string[]|null
     */
    public function hideTel($tel, $t = '*')
    {
        $isWhat = preg_match('/(0[0-9]{2,3}[\-]?[2-9][0-9]{6,7}[\-]?[0-9]?)/i', $tel);

        if ($isWhat == 1) {
            return preg_replace('/(0[0-9]{2,3}[\-]?[2-9])[0-9]{3,4}([0-9]{3}[\-]?[0-9]?)/i', "\$1{$t}{$t}{$t}{$t}\$2", $tel);
        } else {
            return preg_replace('/(1[358]{1}[0-9])[0-9]{4}([0-9]{4})/i', "\$1{$t}{$t}{$t}{$t}\$2", $tel);
        }
    }
}