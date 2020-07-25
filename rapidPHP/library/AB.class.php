<?php

namespace rapidPHP\library;

use rapid\library\rapid;
use ReflectionException;

class AB
{
    /**
     * getInstance
     * @param null $data
     * @return static
     * @throws ReflectionException
     */
    public static function getInstance($data = null): self
    {
        return new self($data);
    }

    /**
     * AB constructor.
     * @param null $data
     * @throws ReflectionException
     */
    public function __construct($data = null)
    {
        $this->sData($data);
    }

    /**
     * setData
     * @param array $data
     * @return $this
     * @throws ReflectionException
     */
    public function sData($data = null): self
    {
        if ($data === null) $data = [];

        if (is_object($data)) $data = (array)$data;

        $params = B()->invokeObjectSetterMethods($this, $data);

        foreach ($params as $key => $param) $data = AR()->delete($data, array_keys($param));

        foreach ($data as $name => $value) $this->$name = $value;

        return $this;
    }


    /**
     * 获取数据
     * @param array $names
     * @param int $mode 1获取names下的values 2,排除names下的values
     * @return array
     */
    public function getData(?array $names = null, int $mode = 1): array
    {
        $array = (array)$this;

        if (!empty($names)) {
            if ($mode == 1) {
                return AR()->getArray($array, $names);
            } else if ($mode == 2) {
                return AR()->delete($array, $names);
            }
        }

        return $array;
    }

    /**
     * 是否空
     * 不再建议使用该方法判断数据，请用 is_null或者==null判断数据
     * @return bool
     */
    public function isEmpty(): bool
    {
        foreach ($this as $name => $value) if (!empty($value)) return false;

        return true;
    }

    /**
     * 校验name参数是否存在
     * @param $name
     * @return bool
     * 不太建议使用该api，但不代表就会过时，请直接通过属性properties来判断
     */
    public function hasName($name): bool
    {
        return isset($this->$name);
    }

    /**
     * 对比值
     * @param $name
     * @param $value
     * @return bool
     * 不太建议使用该api，但不代表就会过时，请直接通过属性properties来判断
     */
    public function hasValue($name, $value): bool
    {
        $data = isset($this->$name) ? $this->$name : null;

        return $data == $value;
    }


    /**
     * 获取值
     * @param $name
     * @return mixed
     * 不太建议使用该api，但不代表就会过时，请直接通过属性properties获取值
     */
    public function getValue($name)
    {
        return isset($this->$name) ? $this->$name : null;
    }

    /**
     * 设置value
     * @param $name
     * @param $value
     * @return $this
     * @since 4.0
     * @since 5.0
     * 该api已过时，setValue不存在的properties等同于__set，效率特别低，不建议使用该方法
     */
    public function sValue($name, $value): self
    {
        $this->$name = $value;

        return $this;
    }

    /**
     * 获取子元素转arrayObject对象
     * @param $name
     * @return AB
     * 不太建议使用该api，但不代表就会过时，请直接通过属性properties获取值
     * @throws ReflectionException
     */
    public function getAB($name): self
    {
        $array = [];

        if (isset($this->$name)) $array = $this->$name;

        $clone = clone $this;

        $clone->sData($array);

        return $clone;
    }

    /**
     * 获取数组
     * @param $name
     * @return array
     * 不太建议使用该api，但不代表就会过时，请直接通过属性properties获取值
     */
    public function getArray($name): array
    {
        return (array)$this->getValue($name);
    }

    /**
     * 获取String
     * @param $name
     * @return string
     * 不太建议使用该api，但不代表就会过时，请直接通过属性properties获取值
     */
    public function getString($name): string
    {
        return (string)$this->getValue($name);
    }

    /**
     * 获取int
     * @param $name
     * @return int
     * 不太建议使用该api，但不代表就会过时，请直接通过属性properties获取值
     */
    public function getInt($name): int
    {
        return (int)$this->getValue($name);
    }

    /**
     * 获取bool
     * @param $name
     * @return bool
     * 不太建议使用该api，但不代表就会过时，请直接通过属性properties获取值
     */
    public function getBool($name): bool
    {
        return (bool)$this->getValue($name);
    }

    /**
     * 获取float
     * @param $name
     * @return float
     * 不太建议使用该api，但不代表就会过时，请直接通过属性properties获取值
     */
    public function getFloat($name): float
    {
        return (float)$this->getValue($name);
    }

    /**
     * 获取object
     * @param $name
     * @return object
     * 不太建议使用该api，但不代表就会过时，请直接通过属性properties获取值
     */
    public function getObject($name)
    {
        return (object)$this->getValue($name);
    }

    /**
     * getLength
     * @return int
     */
    public function getLength(): int
    {
        return count($this->getData());
    }

    /**
     * 转xml
     * @param array $names
     * @return string
     */
    public function toXml(?array $names = null): string
    {
        return X()->encode($this->getData($names));
    }

    /**
     * 转json
     * @param array $names
     * @return string
     */
    public function toJson(?array $names = null): string
    {
        return json_encode($this->getData($names));
    }

    /**
     * 删除指定value
     * @param $names
     * @return $this
     */
    public function delValue($names): self
    {
        if (is_array($names)) {
            foreach ($names as $key) if (isset($this->$key)) unset($this->$key);
        } else {
            unset($this->$names);
        }

        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->toJson();
    }
}
