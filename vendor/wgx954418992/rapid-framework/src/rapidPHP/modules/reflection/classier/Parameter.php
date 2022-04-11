<?php


namespace rapidPHP\modules\reflection\classier;

use Exception;
use rapidPHP\modules\common\classier\Build;
use ReflectionException;
use ReflectionParameter;

class Parameter
{

    /**
     * @var Method
     */
    protected $method;

    /**
     * @var ReflectionParameter
     */
    protected $parameter;

    /**
     * Parameter constructor.
     * @param Method $method
     * @param ReflectionParameter $parameter
     */
    public function __construct(Method $method, ReflectionParameter $parameter)
    {
        $this->method = $method;

        $this->parameter = $parameter;
    }

    /**
     * @return Method
     */
    public function getMethod(): Method
    {
        return $this->method;
    }

    /**
     * @return Classify
     */
    public function getClassify(): Classify
    {
        return $this->getMethod()->getClassify();
    }

    /**
     * @return ReflectionParameter
     */
    public function getParameter(): ReflectionParameter
    {
        return $this->parameter;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->getParameter()->getName();
    }

    /**
     * 获取默认值
     * @return mixed|void
     */
    public function getDefaultValue()
    {
        try {
            if ($this->getParameter()->isDefaultValueAvailable()) {
                return $this->getParameter()->getDefaultValue();
            }
        } catch (ReflectionException $e) {

        }

        return;
    }

    /**
     * 获取参数类型 7.x
     * 因为7.x都是单个类型，所以返会的是string
     * @return string
     */
    public function getType(): ?string
    {
        return Build::getInstance()->getData($this->getTypeToArray(), 0);
    }

    /**
     * 获取参数类型
     * 因为8.0支持union types 类型，可能返回多个，没测试
     * @return array
     * @since 8.0
     */
    public function getTypeToArray(): ?array
    {
        $type = $this->getParameter()->getType();

        if (empty($type)) return null;

        return explode("|", str_replace('?', '', $type->getName()));
    }

    /**
     * @return annotation\Parameter|null
     * @throws Exception
     */
    public function getAnnotation()
    {
        return $this->method->getDocComment()->getParamAnnotation($this->getName());
    }
}
