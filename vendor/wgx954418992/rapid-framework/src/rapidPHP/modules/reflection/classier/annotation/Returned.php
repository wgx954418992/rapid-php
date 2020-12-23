<?php

namespace rapidPHP\modules\reflection\classier\annotation;

use Exception;
use rapidPHP\modules\common\classier\Build;
use rapidPHP\modules\reflection\classier\Property as ReflectionProperty;
use rapidPHP\modules\reflection\config\AnnotationConfig;
use rapidPHP\modules\common\classier\Variable;
use rapidPHP\modules\reflection\classier\Classify;
use rapidPHP\modules\reflection\classier\Utils;

class Returned extends Value
{

    /**
     * Returned constructor.
     * @param $value
     */
    public function __construct($value)
    {
        parent::__construct(AnnotationConfig::AT_RETURNED, $value);
    }

    /**
     * 获取类型
     * @return false|string[]
     */
    public function getType()
    {
        return Build::getInstance()->getData($this->getTypeToArray(), 0);
    }

    /**
     * 获取类型多个
     * @return false|string[]
     */
    public function getTypeToArray()
    {
        return explode("|", $this->getValue());
    }

    /**
     * 获取返回的类型
     * @param Classify|null $classify
     * @return mixed|string|null
     */
    public function getReturnedType(?Classify $classify): ?string
    {
        $type = $this->getType();

        return Utils::getInstance()->findTypeClass($type, $classify);
    }

    /**
     * 获取返回的字段
     * @param $returnType
     * @return ReflectionProperty[]|null
     */
    public function getReturnedProperties($returnType): ?array
    {
        if (empty($returnType)) {
            return null;
        } else if (Variable::isSetType($returnType)) {
            return null;
        } else {
            try {
                $classify = Classify::getInstance($returnType);

                return $classify->getProperties();
            } catch (Exception $e) {
                return null;
            }
        }
    }
}