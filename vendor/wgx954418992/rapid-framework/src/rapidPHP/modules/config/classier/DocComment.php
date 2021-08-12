<?php


namespace rapidPHP\modules\config\classier;


use Exception;
use rapidPHP\modules\config\classier\annotation\Config as ConfigAnnotation;
use rapidPHP\modules\config\config\AnnotationConfig;
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
