<?php

namespace rapidPHP\modules\common\classier;

use function rapidPHP\B;

class Math
{

    /**
     * 阶加
     * 1+2+3+4+5+...+n
     * @param $n
     * @return float|int
     */
    public static function termial($n)
    {
        return (1 + $n) * $n / 2;
    }

    /**
     * 阶乘
     * 1*2*3*4*5*..*n
     * @param $n
     * @return float|int
     */
    public static function factorial($n)
    {
        return array_product(range(1, $n));
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
    public static function getDistance(float $startLongitude, float $startLatitude, float $endLongitude, float $endLatitude, int $decimal = 2): float
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
    public static function getDistanceString(float $startLongitude, float $startLatitude, float $endLongitude, float $endLatitude, int $decimal = 2): string
    {
        $unit = 'M';

        $distance = self::getDistance($startLongitude, $startLatitude, $endLongitude, $endLatitude, $decimal);

        if ($distance > 1000) {
            $unit = 'KM';

            $distance = $distance / 1000;
        }

        return $distance . $unit;
    }

    /**
     * 概率算法
     * @param array $data
     * @return mixed
     */
    public static function probability(array $data): array
    {
        return B()->getData(self::probabilityList($data, 1), 0);
    }

    /**
     * 概率算法=》多人中奖
     * @param array $data
     * @param int $count
     * @param bool $isRepeat
     * @param array $result
     * @return array
     */
    public static function probabilityList(array $data, int $count = 1,
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
            return self::probabilityList($data, $count, $isRepeat, $result);

        return $result;
    }


    /**
     * 生成抽奖数据
     * @param array $data
     * @param $id
     * @param $probability
     * @return array
     */
    public static function makeProbabilityData(array $data, string $id, $probability): array
    {
        $result = [];

        foreach ($data as $value) {
            $result[B()->getData($value, $id)] = B()->getData($value, $probability);
        }

        return $result;
    }

    /**
     * 通过文本获取字节大小
     * @param $str
     * @return float|int
     */
    public static function getByteByText($str)
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
     * 通过字节大小获取文本
     * @param $size
     * @return string
     */
    public static function getTextBySize($size): string
    {
        $units = [' B', ' KB', ' MB', ' GB', ' TB'];

        for ($i = 0; $size >= 1024 && $i < 4; $i++) $size /= 1024;

        if ($size > 1000) {
            $i++;

            $size = $size / 1024;
        }

        $size = self::roundNum($size, 2);

        return $size . $units[$i];
    }

    /**
     * 整数转小数
     * @param $num
     * @param $length
     * @return false|string
     */
    public static function roundNum($num, $length)
    {
        if ($len = strpos($num, '.')) {

            $dianNum = substr($num, $len + 1, $len + $length + 1);

            if (strlen($dianNum) >= $length) return substr($num, 0, $len + $length + 1);
        }

        return $num;
    }
}