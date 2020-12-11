<?php
namespace rapidPHP\modules\core\classier\web\view;


use DOMDocument;
use DOMElement;
use rapidPHP\modules\common\classier\Build;

class Element
{

    /**
     * @var DOMElement
     */
    private $element;

    /**
     * @var DOMDocument
     */
    private $document;

    /**
     * Element constructor.
     * @param DOMDocument $document
     * @param $name
     * @param $value
     * @param Element|null $parent
     */
    public function __construct(DOMDocument $document, $name, $value, Element $parent = null)
    {
        $this->document = $document;

        $this->element = $this->document->createElement($name, $value);

        $this->document->appendChild($this->element);

        if ($parent != null) $this->setParent($parent);
    }

    /**
     * @return DOMElement
     */
    public function getElement(): DOMElement
    {
        return $this->element;
    }

    /**
     * @return DOMDocument
     */
    public function getDocument(): DOMDocument
    {
        return $this->document;
    }

    /**
     * @param $value
     * @return static|self
     */
    public function setValue($value)
    {
        $this->element->nodeValue = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->element->nodeValue;
    }


    /**
     * @param $name
     * @return string
     */
    public function getAttr($name): string
    {
        return $this->element->getAttribute($name);
    }


    /**
     * @param $name
     * @param null $value
     * @param bool $isStack
     * @return static|self
     */
    public function setAttr($name, $value = null, $isStack = false)
    {
        $attrValue = $this->getAttr($name);

        $this->element->setAttribute($name, $isStack && $attrValue ? "{$attrValue} {$value}" : $value);

        return $this;
    }

    /**
     * 移出属性
     * @param $name
     * @return static|self
     */
    public function removeAttr($name): Element
    {
        $this->element->removeAttribute($name);

        return $this;
    }

    /**
     * @param array $attr
     * @param bool $isStack
     * @return static|self
     */
    public function setAttrList($attr = array(), $isStack = false)
    {
        foreach ($attr as $name => $value) {
            $this->setAttr($name, $value, $isStack);
        }

        return $this;
    }

    /**
     * @param $name
     * @return array|null|string
     */
    public function hasClass($name)
    {
        return Build::getInstance()->getRegular("/(\s|^){$name}(\s|$)/i", $this->getAttr('class'));
    }

    /**
     * @param $name
     * @return static|self
     */
    public function addClass($name)
    {
        if (!$this->hasClass($name)) $this->setAttr('class', $name, 1);

        return $this;
    }

    /**
     * @param $name
     * @return static|self
     */
    public function removeClass($name)
    {
        $class = preg_replace("/(\s|^){$name}(\s|$)/i", '', $this->getAttr('class'));

        $this->setAttr('class', $class);

        return $this;
    }

    /**
     * @param $element
     * @return static|self
     */
    public function addView($element)
    {
        if ($element instanceof Element) {
            $this->element->appendChild($element->getElement());
        } else if ($element instanceof DOMElement) {
            $this->element->appendChild($element);
        }
        return $this;
    }

    /**
     * @param $name
     * @param null $value
     * @param bool $isAdd
     * @return Element
     */
    public function createdView($name, $value = null, $isAdd = true)
    {
        return new Element($this->document, $name, $value, $isAdd === true ? $this : null);
    }

    /**
     * @param $element
     * @return static|self
     */
    public function setParent($element)
    {
        if ($element instanceof Element) {
            $element->addView($this->element);
        } else if ($element instanceof DOMElement) {
            $element->appendChild($this->element);
        }
        return $this;
    }


    /**
     * @param $name
     * @param null $value
     * @return static|self
     */
    public function setData($name, $value = null)
    {
        $this->setAttr("data-{$name}", $value);

        return $this;
    }

    /**
     * @param $data
     * @return static|self
     */
    public function setDataList($data)
    {
        foreach ($data as $name => $value) {
            $this->setData($name, $value);
        }

        return $this;
    }

    /**
     * @param $name
     * @return string
     */
    public function getData($name)
    {
        return $this->getAttr("data-{$name}");
    }

    /**
     * @param $value
     * @return static|self
     */
    public function setTitle($value)
    {
        $this->setAttr('title', $value);

        return $this;
    }


    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->getAttr('title');
    }

    /**
     * @param $value
     * @return static|self
     */
    public function setHref($value)
    {
        $this->setAttr('href', $value);

        return $this;
    }

    /**
     * @param $value
     * @return static|self
     */
    public function setTarget($value = '_blank')
    {
        $this->setAttr('target', $value);

        return $this;
    }

    /**
     * @param $value
     * @return static|self
     */
    public function setSrc($value)
    {
        $this->setAttr('src', $value);

        return $this;
    }

    /**
     * @param $value
     * @return static|self
     */
    public function setId($value)
    {
        $this->setAttr('id', $value);

        return $this;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->getAttr('id');
    }

    /**
     * @return string
     */
    public function toHtml(): string
    {
        return html_entity_decode($this->document->saveHTML(), ENT_QUOTES, 'utf-8');
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toHtml();
    }
}