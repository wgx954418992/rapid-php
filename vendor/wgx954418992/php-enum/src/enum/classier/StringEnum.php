<?php


namespace enum\classier;


use Exception;
use ReflectionException;

abstract class StringEnum extends Enum
{

    /**
     * 解析value
     * @param $value
     * @return string|null
     */
    public static function parseValue($value): ?string
    {
        if (is_array($value) || is_object($value)) {
            return json_encode($value);
        } else if (is_string($value) || is_numeric($value)) {
            return (string)$value;
        } else if (settype($value, 'string')) {
            return $value;
        }

        return null;
    }
}