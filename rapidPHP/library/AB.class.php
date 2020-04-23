<?php

namespace rapidPHP\library;

use rapid\library\rapid;

class AB
{
    public function __construct(?array $array = null)
    {
        $this->setData($array);
    }

    public static function getInstance(?array $array = null): self
    {
        return new self($array);
    }

    /**
     * setData
     * @param array $array
     * @return $this
     */
    public function setData(?array $array = null): self
    {
        if ($array === null) $array = [];

        if (!empty($array)) B()->autoTypeConvertByArray($array);

        foreach ($array as $name => $value) {
            $this->$name = $value;
        }

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
     */
    public function setValue($name, $value): self
    {
        B()->autoTypeConvert($value);

        $this->$name = $value;

        return $this;
    }

    /**
     * 获取子元素转arrayObject对象
     * @param $name
     * @return AB
     */
    public function getAB($name): self
    {
        $array = [];

        if (isset($this->$name)) $array = $this->$name;

        $clone = clone $this;

        $clone->setData($array);

        return $clone;
    }

    /**
     * 获取数组
     * @param $name
     * @return array
     */
    public function getArray($name): array
    {
        return (array)$this->getValue($name);
    }

    /**
     * 获取String
     * @param $name
     * @return string
     */
    public function getString($name): string
    {
        return (string)$this->getValue($name);
    }

    /**
     * 获取int
     * @param $name
     * @return int
     */
    public function getInt($name): int
    {
        return (int)$this->getValue($name);
    }

    /**
     * 获取bool
     * @param $name
     * @return bool
     */
    public function getBool($name): bool
    {
        return (bool)$this->getValue($name);
    }

    /**
     * 获取float
     * @param $name
     * @return float
     */
    public function getFloat($name): float
    {
        return (float)$this->getValue($name);
    }

    /**
     * 获取object
     * @param $name
     * @return object
     */
    public function getObject($name): object
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
            foreach ($names as $key) {
                unset($this->$key);
            }
        } else {
            unset($this->$names);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->toJson();
    }
}
