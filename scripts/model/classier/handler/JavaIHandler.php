<?php

namespace script\model\classier\handler;

use Exception;
use rapidPHP\modules\common\classier\StrCharacter;
use script\convert\classier\enum\Optional;
use script\model\classier\config\IHandlerConfig;
use script\model\classier\config\JavaHandlerConfig;
use script\model\classier\helper\CommonHelper;
use script\model\classier\model\ColumnModel;
use script\model\classier\model\TableModel;
use function rapidPHP\Cal;

class JavaIHandler extends IHandler
{

    /**
     * 把数据库字段类型转换成 java类型
     * @param JavaHandlerConfig $config
     * @param TableModel $table
     * @param ColumnModel $column
     * @return string
     */
    private function getCType(JavaHandlerConfig $config, TableModel $table, ColumnModel $column): ?string
    {
        $customMapping = $config->getMappingCustom();

        $customName = $table->getName() . '.' . $column->getName();

        if (isset($customMapping[$customName])) return $customMapping[$customName];

        $types = [];

        $systemMapping = $config->getMappingSystem();

        foreach ($systemMapping as $type => $list) {
            foreach ($list as $item) {
                $types[$item] = $type;
            }
        }

        if (isset($types[$column->getType()])) return $types[$column->getType()];

        return 'String';
    }


    /**
     * 获取 package
     * @param JavaHandlerConfig $config
     * @return string
     */
    private function getPackage(JavaHandlerConfig $config): string
    {
        $package = $config->getPackage();

        if (empty($package)) return '';

        return "package {$package};";
    }

    /**
     * 获取 imports
     * @param JavaHandlerConfig $config
     * @return string
     */
    private function getImports(JavaHandlerConfig $config): string
    {
        $imports = $config->getImports();

        if (empty($imports)) return '';

        $result = '';

        foreach ($imports as $import) {
            $result .= "import {$import};\n";
        }

        return $result;
    }

    /**
     * 获取继承
     * @param JavaHandlerConfig $config
     * @return string
     */
    private function getExtends(JavaHandlerConfig $config): string
    {
        $extends = $config->getExtends();

        if (empty($extends)) return '';

        return 'extends ' . join(',', $extends);
    }

    /**
     * 获取接口
     * @param JavaHandlerConfig $config
     * @return string
     */
    private function getImplements(JavaHandlerConfig $config): string
    {
        $implements = $config->getImplements();

        if (empty($implements)) return '';

        return 'implements ' . join(',', $implements);
    }


    /**
     * 获取Class 注解
     * @param JavaHandlerConfig $config
     * @return string
     */
    private function getClassAnnotation(JavaHandlerConfig $config): string
    {
        $annotations = $config->getAnnotationClass();

        if (empty($annotations)) return '';

        $result = '';

        foreach ($annotations as $annotation) {
            $result .= "@{$annotation};\n";
        }

        return $result;
    }

    /**
     * handler
     * @param JavaHandlerConfig $config
     * @param TableModel $table
     * @param $columns
     * @return array|string|string[]
     * @throws Exception
     */
    public function onHandler(IHandlerConfig $config, TableModel $table, $columns): string
    {
        if (!($config instanceof JavaHandlerConfig)) {
            throw new Exception('config error');
        }

        $package = $this->getPackage($config);

        $imports = $this->getImports($config);

        $extends = $this->getExtends($config);

        $implements = $this->getImplements($config);

        $classAnnotation = $this->getClassAnnotation($config);

        $UTableName = StrCharacter::getInstance()->toFirstUppercase($table->getName(), '_');

        $templateClass = $config->getTemplateClass();

        $templateProperty = $config->getTemplateProperty();

        if ($config->isSetter()) $templateProperty .= $config->getTemplateSetter();

        if ($config->isGetter()) $templateProperty .= $config->getTemplateGetter();

        $properties = '';

        /** @var ColumnModel $column */
        foreach ($columns as $column) {

            $UName = StrCharacter::getInstance()->toFirstUppercase($column->getName(), '_');

            $CType = $this->getCType($config, $table, $column);

            $config->getOptional()
                ->then(Optional::Auto, function () use (&$CType, $column) {
                    if ($column->isIsNullable()) $CType = "Optional<{$CType}>";
                })
                ->then(Optional::All, function () use (&$CType) {
                    $CType = "Optional<{$CType}>";
                })
                ->fetch();

            $properties .= CommonHelper::parseVariable($templateProperty, [
                'comment' => $column->getComment(),
                'length' => $column->getLength(),
                'type' => $column->getType(),
                'name' => $column->getName(),
                'modifiers' => $config->getPropertyModifiers(),
                'UName' => $UName,
                'CType' => $CType
            ]);
        }

        return CommonHelper::parseVariable($templateClass, [
            'date' => Cal()->getDate(),
            'package' => $package,
            'imports' => $imports,
            'tableComment' => $table->getComment(),
            'tableName' => $table->getName(),
            'classAnnotation' => $classAnnotation,
            'className' => CommonHelper::parseVariable($config->getClassName(), ['UTableName' => $UTableName]),
            'extends' => $extends,
            'implements' => $implements,
            'properties' => $properties,
        ]);
    }
}
