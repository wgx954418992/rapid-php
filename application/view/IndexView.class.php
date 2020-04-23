<?php

namespace application\view;

use rapidPHP\library\core\app\View;
use rapidPHP\library\core\app\ViewInterface;

class IndexView extends ViewInterface
{
    /**
     * 显示页面
     */
    public function display()
    {
        View::show('index', $this->data);
    }
}