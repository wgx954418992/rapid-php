<?php

namespace rapidPHP\modules\core\classier\web;

use Exception;
use rapidPHP\modules\common\classier\AB;

abstract class ViewInterface
{
    /**
     * @var WebController
     */
    protected $controller;

    /**
     * @var AB
     */
    protected $data;

    /**
     * ViewInterface constructor.
     * @param WebController $controller
     * @param AB|null $data
     */
    public function __construct(WebController $controller, AB $data = null)
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
     * @throws Exception
     */
    public function show($name)
    {
        $content = View::display($this->controller, $name)
            ->assign($this->data)
            ->view();

        $this->controller->getResponse()->write($content);
    }

    /**
     * @return mixed
     */
    abstract public function display();
}