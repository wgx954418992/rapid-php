<?php


namespace rapidPHP\modules\database\sql\classier;


use Exception;
use rapidPHP\modules\database\sql\classier\annotation\Table;
use rapidPHP\modules\database\sql\config\AnnotationConfig;
use rapidPHP\modules\reflection\classier\DocComment as ReflectionDocComment;

class DocComment extends ReflectionDocComment
{

    /**
     * @throws Exception
     */
    public function getConfigClass()
    {
        return AnnotationConfig::class;
    }

    /**
     * 获取Table注解
     * @return Table
     * @throws Exception
     */
    public function getTableAnnotation()
    {
        /** @var Table $annotation */
        $annotation = $this->getOneAnnotation(AnnotationConfig::AT_TABLE);

        if ($annotation instanceof Table) return $annotation;

        return null;
    }
}