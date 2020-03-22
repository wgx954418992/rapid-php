<?php

namespace rapidPHP\library;

use rapid\library\rapid;

class AB
{

    public $eachIndex = 0;

    protected $array = [];

    const ARRAY_OBJECT_TYPE_NOT = 'getValue';

    const ARRAY_OBJECT_TYPE_AB = 'getAB';

    const ARRAY_OBJECT_TYPE_ARRAY = 'getArray';

    const ARRAY_OBJECT_TYPE_STRING = 'getString';

    const ARRAY_OBJECT_TYPE_INT = 'getInt';

    const ARRAY_OBJECT_TYPE_BOOL = 'getBool';

    const ARRAY_OBJECT_TYPE_FLOAT = 'getFloat';

    public function __construct($array = null)
    {
        $this->setData($array);
    }


    public static function getInstance($array = null){
        return new self($array);
    }

    /**
     * setData
     * @param array $array
     * @return $this
     */
    public function setData($array = null)
    {
        if ($array === null) $array = [];

        if (!empty($array)) $this->setConvertList($array);

        $this->array = $array;

        return $this;
    }


    /**
     * 设置强制转换
     * @param $value
     */
    private function setConvert(&$value)
    {
        if (is_null($value)) return;

        if (is_numeric($value)) {
            $value = (int)$value;
        } else if (is_float($value)) {
            $value = (float)$value;
        } else if (is_double($value)) {
            $value = (double)$value;
        } else if (is_bool($value)) {
            $value = (bool)$value;
        } else if (is_array($value)) {
            foreach ($value as $name => $v) {
                $this->setConvert($v);

                $value[$name] = $v;
            }
        }
    }

    /**
     * 设置强制转换
     * @param $data
     */
    private function setConvertList(&$data)
    {
        foreach ($data as &$value) $this->setConvert($value);
    }

    /**
     * 获取数据
     * @param null $names
     * @return array
     */
    public function getData($names = null)
    {
        if ($names) return AR()->getArray($this->array, is_string($names) ? explode(',', $names) : $names);

        return $this->array;
    }

    /**
     * 是否空
     * @return bool
     */
    public function isEmpty()
    {
        return !$this->array;
    }

    /**
     * 校验name参数是否存在
     * @param $name
     * @return bool
     */
    public function hasName($name)
    {
        return array_key_exists($name, $this->array);
    }

    /**
     * 对比值
     * @param $name
     * @param $value
     * @return bool
     */
    public function hasValue($name, $value)
    {
        $data = B()->getData($this->array, $name);

        return $data == $value;
    }


    /**
     * 获取值
     * @param $name
     * @return mixed
     */
    public function getValue($name)
    {
        return B()->getData($this->array, $name);
    }

    /**
     * 设置value
     * @param $name
     * @param $value
     * @return $this
     */
    public function setValue($name, $value)
    {
        $this->setConvert($value);

        $this->array[$name] = $value;

        return $this;
    }

    /**
     * 获取子元素转arrayObject对象
     * @param $name
     * @return AB
     */
    public function getAB($name)
    {
        $array = array();

        if (isset($this->array[$name])) $array = $this->array[$name];

        $clone = clone $this;

        $clone->setData($array);

        return $clone;
    }

    /**
     * 获取数组
     * @param $name
     * @return array
     */
    public function getArray($name)
    {
        return (array)$this->getValue($name);
    }

    /**
     * 获取String
     * @param $name
     * @return string
     */
    public function getString($name)
    {
        return (string)$this->getValue($name);
    }

    /**
     * 获取int
     * @param $name
     * @return int
     */
    public function getInt($name)
    {
        return (int)$this->getValue($name);
    }

    /**
     * 获取bool
     * @param $name
     * @return bool
     */
    public function getBool($name)
    {
        return (bool)$this->getValue($name);
    }

    /**
     * 获取float
     * @param $name
     * @return float
     */
    public function getFloat($name)
    {
        return (float)$this->getValue($name);
    }

    /**
     * 获取object
     * @param $name
     * @return object
     */
    public function getObject($name)
    {
        return (object)$this->getValue($name);
    }

    /**
     * getLength
     * @return int
     */
    public function getLength()
    {
        return count($this->getData());
    }


    /**
     * where->each
     * @param string $method
     * @return mixed|null
     */
    public function each($method = AB::ARRAY_OBJECT_TYPE_NOT)
    {
        if (method_exists($this, $method) && $this->getValue($this->eachIndex)) {

            $result = call_user_func_array(array($this, $method), array($this->eachIndex));

            $this->eachIndex++;

            return $result;
        }

        return null;
    }

    /**
     * 转xml
     * @param null $names
     * @return string
     */
    public function toXml($names = null)
    {
        return X()->encode($this->getData($names));
    }

    /**
     * 转json
     * @param null $names
     * @return string
     */
    public function toJson($names = null)
    {
        return json_encode($this->getData($names));
    }

    /**
     * 删除指定value
     * @param $name
     * @return $this
     */
    public function delValue($name)
    {
        unset($this->array[$name]);

        return $this;
    }
}
