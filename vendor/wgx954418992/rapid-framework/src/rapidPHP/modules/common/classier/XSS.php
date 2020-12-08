<?php

namespace rapidPHP\modules\common\classier;

class XSS
{
    /**
     * @var XSS
     */
    private static $instance;

    /**
     * @return XSS
     */
    public static function getInstance()
    {
        return self::$instance instanceof self ? self::$instance : self::$instance = new self();
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