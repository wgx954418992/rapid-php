<?php

namespace rapidPHP\modules\core\classier\web;

use DOMDocument;
use rapidPHP\modules\core\classier\web\view\Element;

class View
{

    /**
     * 预先生成view模板
     * @param WebController $controller
     * @param $name
     * @return ViewTemplate
     */
    public static function display(WebController $controller, $name): ViewTemplate
    {
        return new ViewTemplate($controller, $name);
    }

    /**
     * @param $name
     * @param $value
     * @param array $attr
     * @param Element|null $parent
     * @return Element
     */
    public static function createElement($name, $value = null, array $attr = [], Element $parent = null): Element
    {
        $dom = new DOMDocument('1.0');

        $element = new Element($dom, $name, $value, $parent);

        $element->setAttrList($attr);

        return $element;
    }
}
