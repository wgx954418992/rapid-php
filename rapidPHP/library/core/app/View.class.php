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
     * @param $name
     * @param null $data
     * @return ViewTemplate
     */
    public static function display($name, $data = null)
    {
        return (new ViewTemplate($name))->display($data);
    }

    /**
     * 显示
     * @param $name
     * @param null $data
     */
    public static function show($name, $data = null)
    {
        (new ViewTemplate($name))->display($data)->view();
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