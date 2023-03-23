<?php


namespace enum\classier;

abstract class IntEnum extends Enum
{

    /**
     * 解析value
     * @param $value
     * @return int|null
     */
    public static function parseValue($value): ?int
    {
        return is_numeric($value) ? intval($value) : null;
    }
}