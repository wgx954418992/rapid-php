<?php


namespace enum\classier;


use ReflectionClass;
use ReflectionException;

class Utils
{

    /**
     * 反射实例
     * @var array
     */
    protected static $reflections = [];

    /**
     * 当前实例的所有常量
     * @var array
     */
    protected static $constants = [];

    /**
     * 当前实例的所有静态属性
     * @var array
     */
    protected static $staticProperties = [];

    /**
     * 首字母转大写
     * @param $string
     * @param string|null $ext
     * @param string $glue
     * @return string
     */
    public static function toFirstUppercase($string, string $ext = null, string $glue = ""): string
    {
        if ($ext === null || $ext === '') return ucfirst($string);

        $str = [];

        $array = explode($ext, $string);

        foreach ($array as $value) $str[] = ucfirst($value);

        return join($glue, $str);
    }

    /**
     * @param $class
     * @return ReflectionClass
     * @throws ReflectionException
     */
    public static function getReflection($class): ReflectionClass
    {
        $className = is_object($class) ? get_class($class) : $class;

        $className = ltrim($className, '\\');

        if (array_key_exists($className, self::$constants)) {
            return self::$reflections[$className];
        }

        return self::$reflections[$className] = new ReflectionClass($className);
    }

    /**
     * 获取常量
     * @param ReflectionClass $reflectionClass
     * @return array
     */
    public static function getConstants(ReflectionClass $reflectionClass): array
    {
        $className = $reflectionClass->getName();

        if (array_key_exists($className, self::$constants)) {
            return (array)self::$constants[$className];
        }

        return self::$constants[$className] = $reflectionClass->getConstants();
    }

    /**
     * 获取静态属性
     * @param ReflectionClass $reflectionClass
     * @return array
     */
    public static function getStaticProperties(ReflectionClass $reflectionClass): array
    {
        $className = $reflectionClass->getName();

        if (array_key_exists($className, self::$staticProperties)) {
            return (array)self::$staticProperties[$className];
        }

        return self::$staticProperties[$className] = $reflectionClass->getStaticProperties();
    }
}
