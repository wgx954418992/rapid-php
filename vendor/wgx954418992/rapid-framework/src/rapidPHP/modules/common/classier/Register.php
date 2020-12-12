<?php

namespace rapidPHP\modules\common\classier;

class Register
{

    /**
     * @var array
     */
    private $container = [];

    /**
     * @var static[]
     */
    private static $instances;

    /**
     * @return static
     */
    public static function getInstance()
    {
        if (isset(self::$instances[static::class])) {
            return self::$instances[static::class];
        } else {
            return self::$instances[static::class] = new static();
        }
    }

    /**
     * put
     * @param $name
     * @param $value
     * @return static|self|mixed|null
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
        return isset($this->container[$name]) ? $this->container[$name] : null;
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