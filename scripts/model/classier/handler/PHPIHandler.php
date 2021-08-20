<?php

namespace script\model\classier\handler;

use Exception;
use rapidPHP\modules\common\classier\StrCharacter;
use rapidPHP\modules\common\classier\Variable;
use script\convert\classier\enum\Optional;
use script\model\classier\config\IHandlerConfig;
use script\model\classier\config\PHPHandlerConfig;
use script\model\classier\helper\CommonHelper;
use script\model\classier\model\ColumnModel;
use script\model\classier\model\TableModel;
use function rapidPHP\B;
use function rapidPHP\Cal;

class PHPIHandler extends IHandler
{

    /**
     * 格式化class name
     * @param string $className
     * @return string
     */
    private function formatClassName(string $className): string
    {
        return ltrim($className, '\\');
    }

    /**
     * 把数据库字段类型转换成 php强类型
     * @param PHPHandlerConfig $config
     * @param TableModel $table
     * @param ColumnModel $column
     * @return mixed|string|null
     */
    private function getCType(PHPHandlerConfig $config, TableModel $table, ColumnModel $column): ?string
    {
        $customMapping = (array)$config->getMappingCustom();

        $customName = $table->getName() . '.' . $column->getName();

        if (isset($customMapping[$customName])) return $customMapping[$customName];

        if (version_compare(PHP_VERSION, '7.0.0', '<')) return '';

        $types = [];

        $systemMapping = (array)$config->getMappingSystem();

        foreach ($systemMapping as $type => $list) {
            foreach ($list as $item) {
                $types[$item] = $type;
            }
        }

        return B()->getData($types, $column->getType());
    }

    /**
     * 获取 namespace
     * @param PHPHandlerConfig $config
     * @return string
     */
    private function getNamespace(PHPHandlerConfig $config): string
    {
        $namespace = $config->getNamespace();

        if (empty($namespace)) return '';

        return "namespace {$namespace};";
    }

    /**
     * 获取 imports
     * @param PHPHandlerConfig $config
     * @return array
     */
    private function getImports(PHPHandlerConfig $config): array
    {
        $imports = (array)$config->getImports();

        if (empty($imports)) return [];

        $result = [];

        foreach ($imports as $import) {
            $import = '\\' . $this->formatClassName($import);

            $shortName = preg_replace('/(.*)\\\(\w+)/i', '$2', $import);

            $result[$shortName] = $import;
        }

        return $result;
    }

    /**
     * 获取继承
     * @param PHPHandlerConfig $config
     * @return string
     */
    private function getExtends(PHPHandlerConfig $config): string
    {
        $extends = (array)$config->getExtends();

        if (empty($extends)) return '';

        return 'extends ' . join(',', $extends);
    }

    /**
     * 获取接口
     * @param PHPHandlerConfig $config
     * @return string
     */
    private function getImplements(PHPHandlerConfig $config): string
    {
        $implements = (array)$config->getImplements();

        if (empty($implements)) return '';

        return 'implements ' . join(',', $implements);
    }

    /**
     * 获取Class 注解
     * @param PHPHandlerConfig $config
     * @return string
     */
    private function getClassAnnotation(PHPHandlerConfig $config): string
    {
        $annotations = (array)$config->getAnnotationClass();

        if (empty($annotations)) return '';

        $result = '';

        foreach ($annotations as $annotation) {
            $result .= "#{$annotation};\n";
        }

        return $result;
    }

    /**
     * 格式化imports
     * @param array $imports
     * @return string
     */
    private function formatImports(array $imports): string
    {
        $result = '';

        foreach ($imports as $import) {
            $import = $this->formatClassName($import);

            $result .= "use {$import};\n";
        }

        return $result;
    }

    /**
     * handler
     * @param PHPHandlerConfig $config
     * @param TableModel $table
     * @param $columns
     * @return string
     * @throws Exception
     */
    public function onHandler(IHandlerConfig $config, TableModel $table, $columns): string
    {
        if (!($config instanceof PHPHandlerConfig)) {
            throw new Exception('config error');
        }

        $namespace = $this->getNamespace($config);

        $imports = $this->getImports($config);

        $extends = $this->getExtends($config);

        $implements = $this->getImplements($config);

        $classAnnotation = $this->getClassAnnotation($config);

        $UTableName = StrCharacter::getInstance()->toFirstUppercase($table->getName(), '_');

        $templateClass = $config->getTemplateClass();

        $templateProperty = $config->getTemplateProperty();

        if ($config->isSetter()) $templateProperty .= $config->getTemplateSetter();

        if ($config->isGetter()) $templateProperty .= $config->getTemplateGetter();

        if ($config->isValida()) $templateProperty .= $config->getTemplateValida();

        $properties = '';

        /** @var ColumnModel $column */
        foreach ($columns as $column) {

            $CType = $this->getCType($config, $table, $column);

            $UName = StrCharacter::getInstance()->toFirstUppercase($column->getName(), '_');

            if ($CType && !Variable::isSetType($CType)
                && $CType != Variable::MIXED
                && !in_array($CType, $imports)) {

                $CType = '\\' . $this->formatClassName($CType);

                $CShortName = preg_replace('/(.*)\\\(\w+)/i', '$2', $CType);

                if (!$imports[$CShortName]) {
                    $imports[$CShortName] = $CType;

                    $CType = $CShortName;
                }
            }

            $isOptional = false;

            $config->getOptional()
                ->then(Optional::Auto, function () use (&$isOptional, $column) {
                    $isOptional = $column->isIsNullable();
                })
                ->then(Optional::All, function () use (&$isOptional) {
                    $isOptional = true;
                })
                ->then(Optional::Never, function () use (&$isOptional) {
                    $isOptional = false;
                })
                ->fetch();

            $RType = empty($CType) ? '' : ': ' . ($isOptional ? '?' : '') . $CType;

            $SType = empty($CType) ? '' : ($isOptional ? '?' : '') . $CType . ' ';

            $DRType = empty($CType) ? 'mixed' : $CType . ($isOptional ? '|null' : '');

            $DSType = empty($CType) ? '' : $CType . ($isOptional ? '|null' : '') . ' ';

            $properties .= CommonHelper::parseVariable($templateProperty, [
                'comment' => $column->getComment(),
                'length' => $column->getLength(),
                'type' => $column->getType(),
                'name' => $column->getName(),
                'modifiers' => $config->getPropertyModifiers(),
                'UName' => $UName,
                'RType' => $RType,
                'SType' => $SType,
                'DRType' => $DRType,
                'DSType' => $DSType,
            ]);
        }

        return CommonHelper::parseVariable($templateClass, [
            'date' => Cal()->getDate(),
            'namespace' => $namespace,
            'imports' => $this->formatImports($imports),
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
