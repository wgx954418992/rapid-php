<?php

namespace script\model\classier\handler;

use Exception;
use rapidPHP\modules\common\classier\StrCharacter;
use script\convert\classier\enum\Optional;
use script\model\classier\config\IHandlerConfig;
use script\model\classier\config\SwiftHandlerConfig;
use script\model\classier\helper\CommonHelper;
use script\model\classier\model\ColumnModel;
use script\model\classier\model\TableModel;
use function rapidPHP\Cal;

class SwiftIHandler extends IHandler
{


    /**
     * 把数据库字段类型转换成 swift类型
     * @param SwiftHandlerConfig $config
     * @param TableModel $table
     * @param ColumnModel $column
     * @return string
     */
    private function getCType(SwiftHandlerConfig $config, TableModel $table, ColumnModel $column): ?string
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
     * 获取 imports
     * @param SwiftHandlerConfig $config
     * @return string
     */
    private function getImports(SwiftHandlerConfig $config): string
    {
        $imports = $config->getImports();

        if (empty($imports)) return '';

        $result = '';

        foreach ($imports as $import) {
            $result .= "import {$import}\n";
        }

        return $result;
    }

    /**
     * 获取继承
     * @param SwiftHandlerConfig $config
     * @return string
     */
    private function getExtends(SwiftHandlerConfig $config): string
    {
        $extends = $config->getExtends();

        if (empty($extends)) return '';

        return ': ' . join(',', $extends);
    }

    /**
     * 获取Class 注解
     * @param SwiftHandlerConfig $config
     * @return string
     */
    private function getClassAnnotation(SwiftHandlerConfig $config): string
    {
        $annotations = $config->getAnnotationClass();

        if (empty($annotations)) return '';

        $result = '';

        foreach ($annotations as $annotation) {
            $result .= "@{$annotation}\n";
        }

        return $result;
    }

    /**
     * handler
     * @param IHandlerConfig $config
     * @param TableModel $table
     * @param $columns
     * @return array|string|string[]
     * @throws Exception
     */
    public function onHandler(IHandlerConfig $config, TableModel $table, $columns): string
    {
        if (!($config instanceof SwiftHandlerConfig)) {
            throw new Exception('config error');
        }

        $imports = $this->getImports($config);

        $extends = $this->getExtends($config);

        $classAnnotation = $this->getClassAnnotation($config);

        $UTableName = $this->getUTableName($config, $table);

        $templateClass = $config->getTemplateClass();

        $templateProperty = $config->getTemplateProperty();

        $properties = '';

        /** @var ColumnModel $column */
        foreach ($columns as $column) {

            $value = null;

            $UName = StrCharacter::getInstance()->toFirstUppercase($column->getName(), '_');

            $CType = $this->getCType($config, $table, $column);

            $config->getOptional()
                ->then(Optional::Auto, function () use (&$CType, &$value, $column) {
                    if ($column->isIsNullable()) {
                        $value = 'nil';

                        $CType = "{$CType}?";
                    } else {
                        $value = "{$CType}()";
                    }
                })
                ->then(Optional::All, function () use (&$CType, &$value) {
                    $value = 'nil';

                    $CType = "{$CType}?";
                })
                ->then(Optional::Never, function () use ($CType, &$value) {
                    $value = "{$CType}()";
                })
                ->fetch();

            $properties .= CommonHelper::parseVariable($templateProperty, [
                'comment' => $column->getComment(),
                'length' => $column->getLength(),
                'type' => $column->getType(),
                'name' => $column->getName(),
                'modifiers' => $config->getPropertyModifiers(),
                'UName' => $UName,
                'CType' => $CType,
                'value' => $value
            ]);
        }

        return CommonHelper::parseVariable($templateClass, [
            'date' => Cal()->getDate(),
            'imports' => $imports,
            'tableComment' => $table->getComment(),
            'tableName' => $table->getName(),
            'classAnnotation' => $classAnnotation,
            'className' => CommonHelper::parseVariable($config->getClassName(), ['UTableName' => $UTableName]),
            'extends' => $extends,
            'properties' => $properties,
        ]);
    }
}
