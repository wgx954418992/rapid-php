<?php


namespace rapidPHP\modules\reflection\classier;

use Exception;
use rapidPHP\modules\common\classier\Build;
use rapidPHP\modules\reflection\classier\annotation\Value;

class Annotation
{

    /**
     * @var array
     */
    protected $mapping = [];

    /**
     * @var static[]
     */
    protected static $instances;

    /**
     * @return static
     */
    public static function getInstance()
    {
        if (isset(self::$instances[static::class])) {
            return self::$instances[static::class];
        } else {
            return self::$instances[static::class] = new static();
        }
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
    public function getMappings(): array
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

        return Classify::getInstance($class)
            ->newInstanceKV(['atName' => $atName, 'value' => $value]);
    }

    /**
     * 获取注解s
     * @param $doc
     * @param string|null $name
     * @param $pattern
     * @return array
     * @throws Exception
     */
    public function getAnnotations($doc, ?string $name = '.*?', $pattern = null): array
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
     * @param string|null $name
     * @return mixed|null
     * @throws Exception
     */
    public function getOneAnnotation($doc, ?string $name = '.*?')
    {
        $annotations = $this->getAnnotations($doc, $name);

        if (empty($annotations)) return null;

        $annotation = Build::getInstance()->getData($annotations, 0);

        if (empty($annotation)) return null;

        return $annotation;
    }
}
