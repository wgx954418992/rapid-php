<?php


namespace rapidPHP\modules\reflection\classier;

use Exception;
use rapidPHP\modules\common\classier\Build;
use ReflectionProperty;

class Property
{

    /**
     * @var Classify
     */
    protected $classify;

    /**
     * @var ReflectionProperty
     */
    protected $property;


    /**
     * Property constructor.
     * @param Classify $classify
     * @param ReflectionProperty $property
     */
    public function __construct(Classify $classify, ReflectionProperty $property)
    {
        $this->classify = $classify;
        $this->property = $property;
    }

    /**
     * @return Classify
     */
    public function getClassify()
    {
        return $this->classify;
    }

    /**
     * 获取反射方法的声明类
     * 等同于这个属性是哪个类的，如果是继承过来过来的，这个属性是父类还是自己的
     * @return Classify|null
     * @throws Exception
     */
    public function getDeclaringClass()
    {
        return Classify::getInstance($this->getProperty()->getDeclaringClass());
    }

    /**
     * @return ReflectionProperty
     */
    public function getProperty()
    {
        return $this->property;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->getProperty()->getName();
    }

    /**
     * 获取属性值
     * @param $object
     * @return mixed
     */
    public function getValue($object = null)
    {
        if ($this->getProperty()->isPrivate() ||
            $this->getProperty()->isProtected()) {
            $this->getProperty()->setAccessible(true);
        }

        return $this->getProperty()->getValue($object);
    }

    /**
     * 设置属性值
     * @param $value
     * @param $object
     */
    public function setValue($value, $object = null)
    {
        if ($this->getProperty()->isPrivate() ||
            $this->getProperty()->isProtected()) {
            $this->getProperty()->setAccessible(true);
        }

        $this->getProperty()->setValue($object, $value);
    }

    /**
     * 获取参数类型 7.x
     * 因为7.x都是单个类型，所以返会的是string
     * @return string
     * @throws Exception
     */
    public function getType(): ?string
    {
        $type = Build::getInstance()->getData($this->getTypeToArray(), 0);

        return Utils::getInstance()->findTypeClass($type, $this->getDeclaringClass());
    }

    /**
     * @template T
     * @param string|object|T|static $class
     * @return DocComment|\rapidPHP\modules\router\classier\DocComment|T|null
     */
    public function getDocComment($class = DocComment::class)
    {
        if (method_exists($class, 'getInstance')) {
            return call_user_func([$class, 'getInstance'], $this->getProperty()->getDocComment());
        }

        return null;
    }

    /**
     * 获取参数类型
     * 因为8.0支持union types 类型，可能返回多个，没测试
     * @return array
     * @throws Exception
     * @since 8.0
     */
    public function getTypeToArray(): ?array
    {
        if (method_exists($this->property, 'getType')) {
            $type = (string)$this->getProperty()->getType();
        } else {
            $variable = $this->getDocComment()->getVariableAnnotation();

            if ($variable == null) return [];

            $type = (string)$variable->getType();
        }

        return explode("|", $type);
    }
}
