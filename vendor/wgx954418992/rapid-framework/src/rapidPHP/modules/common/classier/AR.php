<?php

namespace rapidPHP\modules\common\classier;

class AR
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
     * 批量删除数组元素
     * @param array|null $array $array
     * array(
     *  'a'=>1,'b'=>2,'c'=>3
     * )
     * @param $key
     * array(
     *      'a','c'
     * )
     * @param bool|false $sort
     * @param bool $isTow
     * @return array
     * array(
     *      'b'=>2
     * )
     */
    public function delete(?array $array, $key, $sort = false, $isTow = false): ?array
    {
        $keys = !is_array($key) ? explode(',', $key) : $key;

        if ($isTow) {
            foreach ($keys as $keyName) {
                foreach ($array as $index => $value) {
                    unset($array[$index][$keyName]);
                }
            }
        } else {
            foreach ($keys as $keyName) unset($array[$keyName]);
        }

        return $sort ? self::sort($array) : $array;
    }

    /**
     * 批量获取数组里面的value
     * @param array|null $array $array
     * array(
     *      'a'=>1,'b'=>2,'c'=>3
     * )
     * @param array $key
     * array(
     *      'a','c'
     * )
     * @param bool $isSort
     * @return array
     * array('a'=>1,'c'=>3)
     */
    public function getArray(?array $array, array $key, $isSort = false): array
    {
        $newArray = [];

        if ($isSort === false) {

            foreach ($key as $value) $newArray[$value] = Build::getInstance()->getData($array, $value);

        } else {

            foreach ($key as $value) $newArray[] = Build::getInstance()->getData($array, $value);
        }
        return $newArray;
    }

    /**
     * 重命名
     * @param array $array
     * @param array $key
     * @return array
     */
    public function rename(array $array, array $key): array
    {
        foreach ($array as $name => $value) {
            unset($array[$name]);
            $array[Build::getInstance()->getData($key, $name)] = $value;
        }

        return $array;
    }


    /**
     * 获取数组里面第一个指定key的value
     * @param array $array
     * @param $key
     * @return mixed|null
     */
    public function getArrayFirstValue(array $array, $key = null): ?array
    {
        if (is_array($key)) {
            $result = [];

            foreach ($array as $value) {

                foreach ($key as $keyName) {
                    $result[$keyName] = Build::getInstance()->getData($value, $keyName);
                }
            }

            return $result;
        } else if (empty($key)) {
            foreach ($array as $value) return $value;
        } else {
            foreach ($array as $value) return Build::getInstance()->getData($value, $key);
        }

        return null;
    }

    /**
     * 判断数组是否存在指定值
     * @param array $array
     * array(
     *  1,2,3
     * )
     * @param $value => 3
     * @param null $key
     * @return bool => true
     */
    public function isAppointValue(array $array, $value, $key = null): bool
    {
        if (is_null($key)) {
            foreach ($array as $v) {

                if ($v == $value) return true;
            }
        } else {
            foreach ($array as $v) {

                if ($v[$key] == $value) return true;
            }
        }
        return false;
    }


    /**
     * 判断数组值是否全部相等指定的值
     * @param array $array
     * array(
     *      'e','e','e'
     * )
     * @param $value => e
     * @param null $key
     * @return bool => true
     */
    public function isAllAppointValue(array $array, $value, $key = null): bool
    {
        if (is_null($key)) {
            foreach ($array as $v) {

                if ($value !== $v) return false;
            }
        } else {
            foreach ($array as $v) {

                if ($value !== $v[$key]) return false;
            }
        }
        return true;
    }


    /**
     * 获取多维数组深度
     * @param $array
     * @return int
     */
    public function getDepth(array $array): int
    {
        $maxDepth = 1;

        foreach ($array as $value) {

            if (is_array($value)) {

                $depth = self::getDepth($value) + 1;

                if ($depth > $maxDepth) $maxDepth = $depth;
            }
        }
        return $maxDepth;
    }


    /**
     * 多维数组重新索引
     * @param array $array
     * @return array
     */
    public function sort(array $array): array
    {
        $newArray = [];

        foreach ($array as $val) {

            if (is_array($val)) {

                $newArray[] = self::sort($val);
            } else {
                $newArray[] = $val;
            }
        }
        return $newArray;
    }

    /**
     * 合并多维数组值
     * @param array $array
     * array(
     *      array(1),array(2)
     * )
     * @return array
     * array(1,2)
     */
    public function mergeArrayValues(array $array): array
    {
        $newArray = [];

        foreach ($array as $value) {
            if (is_array($value)) {

                $newArray = array_merge($newArray, self::mergeArrayValues($value));
            } else {

                $newArray[] = $value;
            }
        }
        return $newArray;
    }

    /**
     * 深度合并数组
     * @param $source
     * @param $overlap
     */
    public function merge(&$source, $overlap)
    {
        if (!is_array($source)) $source = (array)$source;

        if (!is_array($overlap)) $overlap = (array)$overlap;

        foreach ($overlap as $item => $value) {
            if (isset($source[$item]) && is_array($source[$item])) {
                $this->merge($source[$item], $value);
            } else {
                $source[$item] = $value;
            }
        }
    }


    /**
     * 获取指定key重复数组
     * @param array $array
     * array(
     *      array('key'=>'value'),
     *      array('key'=>'value'),
     *      array('key'=>'value'),
     *      array('key'=>'value1'),
     * )
     * @param $key =>'key'
     * @param null $of
     * @param bool $isOne
     * @return array
     * array(
     *      'value'=>array(
     *          array('key'=>'value'),
     *          array('key'=>'value'),
     *          array('key'=>'value'),
     *      )
     *      'value1'=>array(
     *           array('key'=>'value1')
     *      )
     * )
     */
    public function arrayColumn(array $array, $key, $of = null, $isOne = false): array
    {
        $newArray = [];

        if (is_null($of)) {
            foreach ($array as $value) {

                $index = Build::getInstance()->getData($value, $key);

                if ($isOne) {
                    $newArray[$index] = $value;
                } else {
                    $newArray[$index][] = $value;

                }
            }
        } else {
            return array_column($array, $key, $of);
        }

        return $newArray;
    }

    /**
     * 随机取出几个数组元素
     * @param array $array
     * @param int $number
     * @param bool $isRepeat
     * @return array
     */
    public function rands(array $array, $number = 1, $isRepeat = false): array
    {
        $rand = [];

        if (is_array($array) && $array) {

            while (count($rand) < $number) {

                $mt_rand = $array[mt_rand(0, count($array) - 1)];

                if ($isRepeat === true) {
                    $rand[] = $mt_rand;
                } else if ($isRepeat === false) {

                    if (array_search($mt_rand, $rand) === false) {
                        $rand[] = $mt_rand;

                    } else if (count($rand) == count($array) && $number > count($array)) {
                        break;
                    }
                }
            }
        }
        return $rand;
    }

    /**
     * 数组k=>v颠倒
     * array(
     *  a=>1
     * )
     * @param $array
     * @param bool $isValue
     * @return array
     * array(
     *  1=>a|null
     * )
     */
    public function valueToKey($array, $isValue = true): array
    {
        $newArray = [];

        if (is_array($array)) {

            foreach ($array as $item => $value) if (!is_array($value)) $newArray[$value] = $isValue ? $item : null;
        }
        return $newArray;
    }

    /**
     * 移除重复数组的value
     * @param $array
     * @return array
     */
    public function removalOfDuplicationValue($array): array
    {
        $result = [];

        foreach ($array as $value) if (!isset($result[$value])) $result[$value] = $value;

        shuffle($result);

        return $result;
    }
}