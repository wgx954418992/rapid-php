<?php

namespace rapidPHP\modules\reflection\classier\annotation;

use rapidPHP\modules\common\classier\Build;
use rapidPHP\modules\common\classier\Variable;
use rapidPHP\modules\reflection\config\AnnotationConfig;

class Parameter extends Value
{
    /**
     * 参数注解类型
     * @var string|string[]
     */
    protected $type;

    /**
     * 名字
     * @var string|string[]
     */
    protected $name;

    /**
     * 来源
     * @var string|string[]
     */
    protected $source;

    /**
     * 说明
     * @var string
     */
    protected $remark;

    /**
     * Parameter constructor.
     * @param $value
     */
    public function __construct($value)
    {
        parent::__construct(AnnotationConfig::AT_PARAM, $value);

        preg_match("/(.*?)\\\$(\w+)(\s\w+)?(\s\w+.*)?/i", $value, $info);

        $type = Build::getInstance()->getData($info, 1);

        $name = Build::getInstance()->getData($info, 2);

        $source = Build::getInstance()->getData($info, 3);

        $remark = Build::getInstance()->getData($info, 4);

        $this->type = trim($this->format($type));

        if (empty($this->type)) $this->type = Variable::MIXED;

        $this->name = trim($name);

        $this->source = trim($this->format($source));

        $this->remark = trim($remark);
    }


    /**
     * 格式化传进来的参数值
     * @param $value
     * @return string|string[]
     */
    public function format($value)
    {
        return str_replace('-', '', $value);
    }

    /**
     * @return string|string[]
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string|string[]
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string|string[]
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @return string|null
     */
    public function getRemark(): ?string
    {
        return $this->remark;
    }
}