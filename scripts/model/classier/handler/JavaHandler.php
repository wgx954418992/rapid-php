<?php

namespace script\model\classier\handler;

use rapidPHP\modules\common\classier\Build;
use rapidPHP\modules\common\classier\StrCharacter;
use script\model\classier\Column;
use script\model\classier\HandlerInterface;
use script\model\classier\Table;
use function rapidPHP\AR;
use function rapidPHP\B;
use function rapidPHP\Cal;

class JavaHandler extends HandlerInterface

{

    /**
     * 获取后缀
     * @return string
     */
    public function getExt(): string
    {
        return '.java';
    }

    /**
     * 获取映射
     */
    private function getConversionMapping(?array $options): array
    {
        $conversion = [];

        $mapping = (array)B()->getData($options, 'mapping');

        foreach ($mapping as $type => $value) {
            foreach ($value as $t) {
                $conversion[$t] = $type;
            }
        }

        return $conversion;
    }

    /**
     * 把数据库字段类型转换成 java类型
     * @param $mapping
     * @param Table $table
     * @param Column $column
     * @return mixed|string|null
     */
    private function getConversionType($mapping, Table $table, Column $column): ?string
    {
        $customType = $table->getName() . '.' . $column->getName();

        if (isset($mapping[$customType])) return $mapping[$customType];

        if (isset($mapping[$column->getType()])) return $mapping[$column->getType()];

        return 'String';
    }

    /**
     * 获取 package
     * @param array|null $options
     * @return string
     */
    private function getPackage(?array $options): string
    {
        $package = (string)Build::getInstance()->getData($options, 'package');

        if (empty($package)) return '';

        return "package {$package};";
    }

    /**
     * 获取 import
     * @param array|null $options
     * @return string
     */
    private function getImports(?array $options): string
    {
        $imports = (array)Build::getInstance()->getData($options, 'imports');

        if (empty($imports)) return '';

        $result = '';

        foreach ($imports as $import) {
            $result .= "import {$import};\n";
        }

        return $result;
    }

    /**
     * 获取接口
     * @param array|null $options
     * @return string
     */
    private function getImplements(?array $options): string
    {
        $implements = (array)Build::getInstance()->getData($options, 'implements');

        if (empty($implements)) return '';

        return 'implements ' . join(',', $implements);
    }

    /**
     * 获取继承
     * @param array|null $options
     * @return string
     */
    private function getExtends(?array $options): string
    {
        $extends = (array)Build::getInstance()->getData($options, 'extends');

        if (empty($extends)) return '';

        return 'extends ' . join(',', $extends);
    }

    /**
     * 获取Class 注解
     * @param array|null $options
     * @return string
     */
    private function getClassAnnotation(?array $options): string
    {
        $annotations = (array)AR()->value((array)$options, 'annotations.class');

        if (empty($annotations)) return '';

        $result = '';

        foreach ($annotations as $annotation) {
            $result .= "@{$annotation};\n";
        }

        return $result;
    }

    /**
     * 字段属性
     * @param array|null $options
     * @return string
     */
    private function getFieldProperty(?array $options): string
    {
        $property = (string)Build::getInstance()->getData($options, 'field.property');

        if ($property) return $property;

        return 'protected';
    }

    /**
     * 是否生成getter
     * @param array|null $options
     * @return string
     */
    private function getIsMakeGetter(?array $options): string
    {
        return (bool)Build::getInstance()->getData($options, 'is_getter');
    }

    /**
     * 是否生成setter
     * @param array|null $options
     * @return string
     */
    private function getIsMakeSetter(?array $options): string
    {
        return (bool)Build::getInstance()->getData($options, 'is_setter');
    }

    /**
     * @param Table $table
     * @param $columns
     * @param array|null $options
     * @return array|string|string[]
     */
    public function onReceive(Table $table, $columns, ?array $options = []): string
    {
        $CMapping = $this->getConversionMapping($options);

        $package = $this->getPackage($options);

        $imports = $this->getImports($options);

        $extends = $this->getExtends($options);

        $implements = $this->getImplements($options);

        $classAnnotation = $this->getClassAnnotation($options);

        $fieldProperty = $this->getFieldProperty($options);

        $isMakeGetter = $this->getIsMakeGetter($options);

        $isMakeSetter = $this->getIsMakeSetter($options);

        $uTableName = StrCharacter::getInstance()->toFirstUppercase($table->getName(), '_');

        $classTemplate = file_get_contents(PATH_APP . 'template/java/class');

        $propertyTemplate = file_get_contents(PATH_APP . 'template/java/property');

        if ($isMakeSetter) $propertyTemplate .= file_get_contents(PATH_APP . 'template/java/setter');

        if ($isMakeGetter) $propertyTemplate .= file_get_contents(PATH_APP . 'template/java/getter');

        $properties = '';

        /** @var Column $column */
        foreach ($columns as $column) {

            $UName = StrCharacter::getInstance()->toFirstUppercase($column->getName(), '_');

            $CType = $this->getConversionType($CMapping, $table, $column);

            $properties .= $this->parseVariable($propertyTemplate, [
                'comment' => $column->getComment(),
                'length' => $column->getLength(),
                'type' => $column->getType(),
                'name' => $column->getName(),
                'UName' => $UName,
                'property' => $fieldProperty,
                'CType' => $CType
            ]);
        }

        return $this->parseVariable($classTemplate, [
            'date' => Cal()->getDate(),
            'package' => $package,
            'imports' => $imports,
            'tableComment' => $table->getComment(),
            'tableName' => $table->getName(),
            'classAnnotation' => $classAnnotation,
            'className' => "{$uTableName}Model",
            'extends' => $extends,
            'implements' => $implements,
            'properties' => $properties,
        ]);
    }
}
