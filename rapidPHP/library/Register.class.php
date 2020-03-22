<?php
namespace rapidPHP\library;


class Register
{

    private static $instance;

    public static function getInstance(){
        return self::$instance instanceof self ? self::$instance : self::$instance = new self();
    }

    private $container = [];

    public function put($name, $value)
    {
        $this->container[$name] = $value;

        return $this;
    }

    public function isPut($name)
    {
        return array_key_exists($name, $this->container);
    }

    public function get($name)
    {
        return isset($this->container[$name]) ? $this->container[$name] : null;
    }

    public function getContainerList()
    {
        return $this->container;
    }

}