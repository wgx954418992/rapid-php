<?php

namespace application\view;

use Exception;
use rapidPHP\library\core\app\View;
use rapidPHP\library\core\app\ViewInterface;
use ReflectionException;

class IndexView extends ViewInterface
{

    /**
     * 显示页面
     * @throws ReflectionException
     * @throws Exception
     */
    public function display()
    {
        View::display($this->controller, 'index')
            ->assign($this->data)
            ->view();
    }
}