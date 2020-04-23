<?php

namespace rapidPHP\library;


use rapid\library\rapid;
use rapidPHP\library\core\Loader;
use ReflectionClass;
use ReflectionException;

class AR
{
    private static $instance;

    public static function getInstance()
    {
        return self::$instance instanceof self ? self::$instance : self::$instance = new self();
    }

    /**
     * 批量删除数组元素
     * @param array $array
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
    public function delete(array $array, $key, $sort = false, $isTow = false)
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
     * @param array $array
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
    public function getArray(array $array, array $key, $isSort = false)
    {
        $newArray = [];

        if ($isSort === false) {

            foreach ($key as $value) $newArray[$value] = B()->getData($array, $value);

        } else {

            foreach ($key as $value) $newArray[] = B()->getData($array, $value);
        }
        return $newArray;
    }

    /**
     * 重命名
     * @param array $array
     * @param array $key
     * @return array
     */
    public function rename(array $array, array $key)
    {
        foreach ($array as $name => $value) {
            unset($array[$name]);
            $array[B()->getData($key, $name)] = $value;
        }

        return $array;
    }

    /**
     * 获取数组里面第一个指定key的value
     * @param array $array
     * @param $key
     * @return mixed|null
     */
    public function getArrayFirstValue(array $array, $key)
    {
        if (is_array($key)) {
            $result = [];

            foreach ($array as $value) {

                foreach ($key as $keyName) {
                    $result[$keyName] = B()->getData($value, $keyName);
                }
            }

            return $result;
        } else {
            foreach ($array as $value) return B()->getData($value, $key);
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
    public function isAppointValue(array $array, $value, $key = null)
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
    public function isAllAppointValue(array $array, $value, $key = null)
    {
        if (is_null($key)) {
            foreach ($array as $v) {

                if ($value != $v) return false;
            }
        } else {
            foreach ($array as $v) {

                if ($value != $v[$key]) return false;
            }
        }
        return true;
    }


    /**
     * 获取多维数组深度
     * @param $array
     * @return int
     */
    public function getDepth(array $array)
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
    public function sort(array $array)
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
     * 对象转数组
     * @param $object
     * @return array
     */
    public function toArray($object)
    {
        return (array)$object;
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
    public function mergeArrayValues(array $array)
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
    public function arrayColumn(array $array, $key, $of = null)
    {
        $newArray = [];

        if (is_null($of)) {
            foreach ($array as $value) {

                $index = B()->getData($value, $key);

                $newArray[$index][] = $value;
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
    public function rands(array $array, $number = 1, $isRepeat = false)
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
     * 获取array object
     * @param array $array
     * @return AB
     */
    public function getAB($array)
    {
        return new AB($array);
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
    public function valueToKey($array, $isValue = true)
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
    public function removalOfDuplicationValue($array)
    {
        $result = [];

        foreach ($array as $value) if (!isset($result[$value])) $result[$value] = $value;

        shuffle($result);

        return $result;
    }


    /**
     * 数组转对象
     * @param array|null $array 数组
     * @param $object object|string 对象实例或者对象class
     * @param array|null $params 对象默认初始化参数
     * @return object
     * @throws ReflectionException
     */
    public function toBean(?array $array, $object, ?array $params = [])
    {
        if (empty($array)) return null;

        if (empty($object)) return null;

        if (is_string($object) && is_file(Loader::getFilePath($object))) {
            $object = (new ReflectionClass($object))->newInstanceArgs($params);
        }

        if (!is_object($object)) return null;

        foreach ($object as $name => $value) {
            $object->$name = B()->getData($array, $name);
        }

        return $object;
    }
}