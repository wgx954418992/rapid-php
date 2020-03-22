<?php

namespace rapidPHP\library\core\app;

use rapidPHP\library\AB;

abstract class ViewInterface
{
    protected $data;

    public function __construct(AB $data = null)
    {
        if(is_null($data)) $data = new AB();

        $this->data = $data;
    }

    abstract public function display();
}