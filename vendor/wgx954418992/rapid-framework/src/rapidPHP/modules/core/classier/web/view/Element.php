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
    protected $element;

    /**
     * @var DOMDocument
     */
    protected $document;

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
    public function getElement()
    {
        return $this->element;
    }

    /**
     * @return DOMDocument
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * @param $value
     */
    public function setValue($value)
    {
        $this->element->nodeValue = $value;
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
     * @param $value
     * @param bool $isStack
     */
    public function setAttr($name, $value = null, bool $isStack = false)
    {
        $attrValue = $this->getAttr($name);

        $this->element->setAttribute($name, $isStack && $attrValue ? "{$attrValue} {$value}" : $value);
    }

    /**
     * 移出属性
     * @param $name
     */
    public function removeAttr($name)
    {
        $this->element->removeAttribute($name);
    }

    /**
     * @param array $attr
     * @param bool $isStack
     */
    public function setAttrList(array $attr = [], bool $isStack = false)
    {
        foreach ($attr as $name => $value) {
            $this->setAttr($name, $value, $isStack);
        }
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
     */
    public function addClass($name)
    {
        if (!$this->hasClass($name)) $this->setAttr('class', $name, 1);
    }

    /**
     * @param $name
     */
    public function removeClass($name)
    {
        $class = preg_replace("/(\s|^){$name}(\s|$)/i", '', $this->getAttr('class'));

        $this->setAttr('class', $class);
    }

    /**
     * @param $element
     */
    public function addView($element)
    {
        if ($element instanceof Element) {
            $this->element->appendChild($element->getElement());
        } else if ($element instanceof DOMElement) {
            $this->element->appendChild($element);
        }
    }

    /**
     * @param $name
     * @param $value
     * @param bool $isAdd
     * @return Element
     */
    public function createdView($name, $value = null, bool $isAdd = true)
    {
        return new Element($this->document, $name, $value, $isAdd === true ? $this : null);
    }

    /**
     * @param $element
     */
    public function setParent($element)
    {
        if ($element instanceof Element) {
            $element->addView($this->element);
        } else if ($element instanceof DOMElement) {
            $element->appendChild($this->element);
        }
    }


    /**
     * @param $name
     * @param $value
     */
    public function setData($name, $value = null)
    {
        $this->setAttr("data-{$name}", $value);
    }

    /**
     * @param $data
     */
    public function setDataList($data)
    {
        foreach ($data as $name => $value) {
            $this->setData($name, $value);
        }
    }

    /**
     * @param $name
     * @return string
     */
    public function getData($name): string
    {
        return $this->getAttr("data-{$name}");
    }

    /**
     * @param $value
     */
    public function setTitle($value)
    {
        $this->setAttr('title', $value);
    }


    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->getAttr('title');
    }

    /**
     * @param $value
     */
    public function setHref($value)
    {
        $this->setAttr('href', $value);
    }

    /**
     * @param string $value
     */
    public function setTarget(string $value = '_blank')
    {
        $this->setAttr('target', $value);
    }

    /**
     * @param $value
     */
    public function setSrc($value)
    {
        $this->setAttr('src', $value);
    }

    /**
     * @param $value
     */
    public function setId($value)
    {
        $this->setAttr('id', $value);
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
