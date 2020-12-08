<?php


namespace rapidPHP\modules\reflection\classier;

use Exception;
use rapidPHP\modules\common\classier\Build;
use rapidPHP\modules\common\classier\File;
use rapidPHP\modules\common\classier\StrCharacter;
use rapidPHP\modules\reflection\classier\annotation\Value;
use rapidPHP\modules\reflection\config\AnnotationConfig;

class Annotation
{

    /**
     * @var array
     */
    private $mapping = [];

    /**
     * @var Annotation
     */
    private static $instance;

    /**
     * @return Annotation
     */
    public static function getInstance()
    {
        return self::$instance instanceof self ? self::$instance : self::$instance = new self();
    }

    /**
     * 添加注解映射
     * @param $atName
     * @param $annotationClass
     * @throws Exception
     */
    public function addMapping($atName, $annotationClass)
    {
        if (!is_subclass_of($annotationClass, Value::class))
            throw new Exception('not extends ' . Value::class . '');

        $this->mapping[$atName] = $annotationClass;
    }

    /**
     * 获取映射
     * @return array
     */
    public function getMappings()
    {
        return $this->mapping;
    }

    /**
     * 获取注解类映射的的class
     * @param $atName
     * @return bool|false|string|string[]|null
     */
    private function getAnnotationClass($atName)
    {
        if (isset($this->mapping[strtolower($atName)])) return $this->mapping[strtolower($atName)];

        return null;
    }

    /**
     * 获取注解对象
     * @param $atName
     * @param $value
     * @return object|Value
     * @throws Exception
     */
    public function getAnnotation($atName, $value)
    {
        $atName = trim($atName);

        $value = trim($value);

        $class = $this->getAnnotationClass($atName);

        if (!$class) return new Value($atName, $value);

        return Classify::getInstance($class)->newInstanceKV(['atName' => $atName, 'value' => $value]);
    }

    /**
     * 获取注解s
     * @param $doc
     * @param string $name
     * @param null $pattern
     * @return array
     * @throws Exception
     */
    public function getAnnotations($doc, $name = '.*?', $pattern = null)
    {
        if (empty($pattern)) {
            preg_match_all("/@($name)? (.*?)([\s\t\n])/i", $doc, $list);
        } else {
            preg_match_all($pattern, $doc, $list);
        }

        $keys = Build::getInstance()->getData($list, 1);

        $values = Build::getInstance()->getData($list, 2);

        if (count($keys) != count($values)) throw new Exception('keys!=values error!');

        $result = [];

        foreach ($keys as $index => $key) {
            $value = Build::getInstance()->getData($values, $index);

            $result[] = $this->getAnnotation($key, $value);
        }

        return $result;
    }

    /**
     * 获取一条注解
     * @param $doc
     * @param string $name
     * @return mixed|null
     * @throws Exception
     */
    public function getOneAnnotation($doc, $name = '.*?')
    {
        $annotations = $this->getAnnotations($doc, $name);

        if (empty($annotations)) return null;

        $annotation = Build::getInstance()->getData($annotations, 0);

        if (empty($annotation)) return null;

        return $annotation;
    }

    /**
     * 通过param获取注解
     * @param $doc
     * @param $name
     * @return Parameter|null
     * @throws Exception
     */
    public function getAnnotationByParam($doc, $name)
    {
        /** @var Parameter[] $params */
        $params = $this->getAnnotations(
            $doc,
            null,
            "/@(" . AnnotationConfig::AT_PARAM . ")?\\$({$name})(.*)?(.*)?/i"
        );

        $parameter = Build::getInstance()->getData($params, 0);

        if (empty($parameter)) return null;

        if (!($parameter instanceof Parameter)) return null;

        return $parameter;
    }
}