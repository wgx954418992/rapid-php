<?php

namespace rapidPHP\library\core\app;

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
     * 直接显示view
     * @param $name
     * @throws ReflectionException
     */
    public function show($name)
    {
        View::display($this->controller, $name)
            ->assign($this->data)
            ->view();
    }

    abstract public function display();
}