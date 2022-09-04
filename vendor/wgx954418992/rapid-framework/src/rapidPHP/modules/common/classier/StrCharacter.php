<?php

namespace rapidPHP\modules\common\classier;

class StrCharacter
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
     * 删除第一个字符串
     * @param string $strings
     * @return string
     */
    public function deleteStringFirst(string $strings): string
    {
        return substr($strings, 1);
    }

    /**
     * 删除最后一个字符串
     * @param string $strings
     * @return string
     */
    public function deleteStringLast(string $strings): string
    {
        return substr($strings, 0, -1);
    }


    /**
     * 把字符串解析成数组
     * @param string|null $queryString
     * @param string $delimiter
     * @return array
     */
    public function parseStr(?string $queryString, string $delimiter = '&'): array
    {
        $queryArray = explode($delimiter, $queryString);

        $list = [];

        foreach ($queryArray as $value) {
            $data = explode('=', $value);

            $dataName = Build::getInstance()->getData($data, 0);

            $dataValue = Build::getInstance()->getData($data, 1);

            $list[$dataName] = $dataValue;
        }

        return $list;
    }


    /**
     * 首字母转大写
     * @param $string
     * @param string|null $ext
     * @param string $glue
     * @return string
     */
    public function toFirstUppercase($string, string $ext = null, string $glue = ""): string
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
     * @param $ext
     * @param string $glue
     * @return string
     */
    public function toFirstLowercase($string, $ext = null, string $glue = ""): string
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
    public function versionCompare($newV, $currentV): int
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
    public function strSplitByLength($string, int $length = 1, string $encoding = 'utf8'): array
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
     * @param string $replace
     * @param int $length
     * @return string
     */
    public function hideName($name, string $replace = '*', int $length = 1): string
    {
        if (mb_strlen($name, 'utf-8') == 1) return '*';

        while (mb_strlen($replace) <= ($length - 1)) {
            $replace = $replace . $replace;
        }

        $first = mb_substr($name, 0, 1);

        $end = mb_substr($name, $length + 1);

        return $first . $replace . $end;
    }

    /**
     * 隐藏手机号码中间指定的数量
     * @param $tel
     * @param string $replace
     * @param int $count
     * @return string|string[]|null
     */
    public function hideTel($tel, string $replace = '*', int $count = 4)
    {
        $length = mb_strlen($tel);

        $startIndex = intval(($length / 2 - 1));

        $endIndex = $startIndex + min($length - $startIndex, $count);

        $replaces = '';

        for ($i = $startIndex; $i < $endIndex; $i++) {
            $replaces .= "$replace";
        }

        return substr_replace($tel, $replaces, $startIndex, $endIndex - $startIndex);
    }

    /**
     * 数组转字符串
     * @param $glue
     * @param $pieces
     * @param bool $isEncoded
     * @param bool $isKey
     * @param string $keyEncode
     * @param string $kvGlue
     * @return string
     */
    public function join($glue, $pieces, bool $isEncoded = false, bool $isKey = false, string $keyEncode = '`{key}`', string $kvGlue = '='): string
    {
        $result = '';

        foreach ($pieces as $key => $str) {
            $str = $isEncoded && !is_numeric($str) ? '\'' . addslashes($str) . '\'' : $str;

            if ($isKey) {
                if ($keyEncode) {
                    $key = str_replace('{key}', $key, $keyEncode);
                }

                $str = $key . $kvGlue . $str;
            }

            $result .= $str . $glue;
        }

        return mb_substr($result, 0, mb_strlen($result) - mb_strlen($glue));
    }
}
