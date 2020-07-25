<?php

namespace rapidPHP\library\core\app;

use Exception;
use rapidPHP\library\AB;
use ReflectionException;

abstract class ViewInterface
{
    protected $controller;

    protected $data;

    public function __construct(Controller $controller, AB $data = null)
    {
        $this->controller = $controller;

        if (is_null($data)) $data = new AB();

        $this->data = $data;
    }

    /**
     * @return AB
     */
    public function getData(): AB
    {
        return $this->data;
    }

    /**
     * @param array|AB $data
     * @throws ReflectionException
     */
    public function setData($data): void
    {
        if ($data instanceof AB) {
            $this->data = $data;
        } else if (is_array($data)) {
            $this->data = new AB($data);
        }
    }

    /**
     * 直接显示view
     * @param $name
     * @throws ReflectionException
     * @throws Exception
     */
    public function show($name)
    {
        View::display($this->controller, $name)
            ->assign($this->data)
            ->view();
    }

    abstract public function display();
}