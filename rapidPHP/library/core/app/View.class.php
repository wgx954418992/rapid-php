<?php

namespace rapidPHP\library\core\app;

use DOMDocument;
use rapid\library\rapid;
use rapidPHP\library\core\app\view\Element;
use rapidPHP\library\ViewTemplate;

class View
{

    /**
     * 预先生成view模板
     * @param Controller $controller
     * @param $name
     * @return ViewTemplate
     */
    public static function display(Controller $controller, $name)
    {
        return new ViewTemplate($controller, $name);
    }

    /**
     * @param $name
     * @param null $value
     * @param array $attr
     * @param Element|null $parent
     * @return Element
     */
    public static function createElement($name, $value = null, $attr = array(), Element $parent = null)
    {
        $dom = new DOMDocument('1.0');

        return (new Element($dom, $name, $value, $parent))->setAttrList($attr);
    }
}