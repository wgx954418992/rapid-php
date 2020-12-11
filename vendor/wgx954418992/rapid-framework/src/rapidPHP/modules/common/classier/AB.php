<?php

namespace rapidPHP\modules\common\classier;

class AB
{
    /**
     * 获取模式
     */
    const MODEL_GET = 1;

    /**
     * 删除模式
     */
    const MODEL_DEL = 2;

    /**
     * @var array
     */
    private $data;

    /**
     * toInstance
     * @param null $data
     * @return AB
     */
    public static function getInstance($data = null): self
    {
        return new self($data);
    }

    /**
     * AB constructor.
     * @param null $data
     */
    public function __construct($data = null)
    {
        $this->data($data);
    }

    /**
     * 设置 data
     * @param null $data
     * @return $this
     */
    public function data($data = null)
    {
        if ($data === null) $data = [];

        $this->data = $data;

        return $this;
    }

    /**
     * 获取数据
     * @param array|null $names
     * @param int $mode 1获取names下的values 2,排除names下的values
     * @return array
     */
    public function toData(?array $names = null, int $mode = self::MODEL_GET): array
    {
        if (!empty($names)) {
            switch ($mode) {
                case self::MODEL_GET:
                    return AR::getInstance()->getArray($this->data, $names);
                case self::MODEL_DEL:
                    return AR::getInstance()->delete($this->data, $names);
            }
        }

        return $this->data;
    }


    /**
     * 是否空
     * @return bool
     */
    public function isEmpty(): bool
    {
        return empty($this->data);
    }

    /**
     * 校验name参数是否存在
     * @param $name
     * @return bool
     */
    public function hasName($name): bool
    {
        return array_key_exists($name, $this->data);
    }

    /**
     * 获取值
     * @param $name
     * @return mixed
     */
    public function toValue($name)
    {
        return isset($this->data[$name]) ? $this->data[$name] : null;
    }

    /**
     * 对比值
     * @param $name
     * @param $value
     * @return bool
     */
    public function hasValue($name, $value): bool
    {
        $data = isset($this->data[$name]) ? $this->data[$name] : null;

        return $this->toValue($name) == $value;
    }

    /**
     * 设置value
     * @param $name
     * @param $value
     * @return $this
     */
    public function value($name, $value): self
    {
        $this->data[$name] = $value;

        return $this;
    }

    /**
     * 获取子元素转arrayObject对象
     * @param $name
     * @return AB
     */
    public function toAB($name): self
    {
        $array = array();

        if (isset($this->data[$name])) $array = $this->data[$name];

        $clone = clone $this;

        $clone->data($array);

        return $clone;
    }

    /**
     * 获取数组
     * @param $name
     * @return array
     */
    public function toArray($name): array
    {
        return (array)$this->toValue($name);
    }

    /**
     * 获取String
     * @param $name
     * @return string
     */
    public function toString($name): string
    {
        return (string)$this->toValue($name);
    }

    /**
     * 获取int
     * @param $name
     * @return int
     */
    public function toInt($name): int
    {
        return (int)$this->toValue($name);
    }

    /**
     * 获取bool
     * @param $name
     * @return bool
     */
    public function toBool($name): bool
    {
        return (bool)$this->toValue($name);
    }

    /**
     * 获取float
     * @param $name
     * @return float
     */
    public function toFloat($name): float
    {
        return (float)$this->toValue($name);
    }

    /**
     * 获取object
     * @param $name
     * @return object
     */
    public function toObject($name)
    {
        return (object)$this->toValue($name);
    }

    /**
     * toLength
     * @return int
     */
    public function toLength(): int
    {
        return count($this->data);
    }

    /**
     * 转xml
     * @param array $names
     * @return string
     */
    public function toXml(?array $names = null): string
    {
        return Xml::getInstance()->encode($this->toData($names));
    }

    /**
     * 转json
     * @param array $names
     * @return string
     */
    public function toJson(?array $names = null): string
    {
        return json_encode($this->toData($names));
    }

    /**
     * 删除指定value
     * @param $names
     * @return $this
     */
    public function delValue($names)
    {
        if (is_array($names)) {
            foreach ($names as $key) {
                unset($this->data[$key]);
            }
        } else {
            unset($this->data[$names]);
        }

        return $this;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
