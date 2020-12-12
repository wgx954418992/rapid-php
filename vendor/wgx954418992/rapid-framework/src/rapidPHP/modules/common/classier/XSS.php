<?php

namespace rapidPHP\modules\common\classier;

class XSS
{

    /**
     * @var static[]
     */
    private static $instances;

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
     * 过滤
     * @param array|null $data
     */
    public function filter(?array &$data)
    {
        foreach ($data as &$value) {
            $this->filterValue($value);
        }
    }

    /**
     * 过滤value
     * @param $data
     */
    public function filterValue(&$data)
    {

    }

    public function reduction()
    {

    }
}