<?php

namespace rapidPHP\modules\common\classier;

class XSS
{

    /**
     * 采用单例模式
     */
    use Instances;

    /**
     * 实例不存在
     * @return static
     */
    public static function onNotInstance()
    {
        return new static();
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