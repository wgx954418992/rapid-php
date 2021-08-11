<?php

namespace rapidPHP\modules\common\classier;

class Register
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
     * @var array
     */
    protected $container = [];

    /**
     * put
     * @param $name
     * @param $value
     * @return self|static
     */
    public function put($name, $value)
    {
        $this->container[$name] = $value;

        return $this;
    }

    /**
     * 是否存在
     * @param $name
     * @return bool
     */
    public function isPut($name): bool
    {
        return array_key_exists($name, $this->container);
    }

    /**
     * 获取
     * @param $name
     * @return mixed|null
     */
    public function get($name)
    {
        return $this->container[$name] ?? null;
    }

    /**
     * 移除
     * @param $name
     */
    public function remove($name)
    {
        unset($this->container[$name]);
    }

    /**
     * list
     * @return array
     */
    public function getContainerList(): array
    {
        return $this->container;
    }

}
