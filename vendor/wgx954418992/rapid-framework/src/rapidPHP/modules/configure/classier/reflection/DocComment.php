<?php


namespace rapidPHP\modules\configure\classier\reflection;


use Exception;
use rapidPHP\modules\configure\classier\reflection\annotation\Config as ConfigAnnotation;
use rapidPHP\modules\configure\config\AnnotationConfig;
use rapidPHP\modules\reflection\classier\DocComment as ReflectionDocComment;

class DocComment extends ReflectionDocComment
{

    /**
     * @throws Exception
     */
    public function getConfigClass(): string
    {
        return AnnotationConfig::class;
    }

    /**
     * 获取Config注解
     * @return ConfigAnnotation|null
     * @throws Exception
     */
    public function getConfigAnnotation()
    {
        /** @var ConfigAnnotation $annotation */
        $annotation = $this->getOneAnnotation(AnnotationConfig::AT_CONFIG);

        if ($annotation instanceof ConfigAnnotation) return $annotation;

        return null;
    }
}
