<?php

namespace rapidPHP\modules\common\classier;

class Register
{

    /**
     * @var array
     */
    private $container = [];

    /**
     * @var Register
     */
    private static $instance;

    /**
     * @return Register
     */
    public static function getInstance(): Register
    {
        return self::$instance instanceof self ? self::$instance : self::$instance = new self();
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