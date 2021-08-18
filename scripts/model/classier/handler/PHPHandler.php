<?php

namespace script\model\classier\handler;

use rapidPHP\modules\common\classier\StrCharacter;
use rapidPHP\modules\common\classier\Variable;
use script\model\classier\Column;
use script\model\classier\HandlerInterface;
use script\model\classier\Table;
use function rapidPHP\AR;
use function rapidPHP\B;
use function rapidPHP\Cal;

class PHPHandler extends HandlerInterface
{

    /**
     * 获取后缀
     * @return string
     */
    public function getExt(): string
    {
        return '.php';
    }

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
     * 把数据库字段类型转换成 php强类型
     * @param $mapping
     * @param Table $table
     * @param Column $column
     * @return mixed|string|null
     */
    private function getConversionType($mapping, Table $table, Column $column): ?string
    {
        $customType = $table->getName() . '.' . $column->getName();

        if (isset($mapping[$customType])) return $mapping[$customType];

        if (version_compare(PHP_VERSION, '7.0.0', '<')) return '';

        return B()->getData($mapping, $column->getType());
    }

    /**
     * 获取 namespace
     * @param array|null $options
     * @return string
     */
    private function getNamespace(?array $options): string
    {
        $namespace = (string)B()->getData($options, 'namespace');

        if (empty($namespace)) return '';

        return "namespace {$namespace};";
    }

    /**
     * 获取 imports
     * @param array|null $options
     * @return array
     */
    private function getImports(?array $options): array
    {
        $imports = (array)B()->getData($options, 'imports');

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
     * 获取接口
     * @param array|null $options
     * @return string
     */
    private function getImplements(?array $options): string
    {
        $implements = (array)B()->getData($options, 'implements');

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
        $extends = (array)B()->getData($options, 'extends');

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
            $result .= "#{$annotation};\n";
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
        $property = (string)B()->getData($options, 'field.property');

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
        return (bool)B()->getData($options, 'is_getter');
    }

    /**
     * 是否生成setter
     * @param array|null $options
     * @return string
     */
    private function getIsMakeSetter(?array $options): string
    {
        return (bool)B()->getData($options, 'is_setter');
    }

    /**
     * 是否生成 valida
     * @param array|null $options
     * @return string
     */
    private function getIsMakeValida(?array $options): string
    {
        return (bool)B()->getData($options, 'is_valida');
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
     * 收到字段
     * @param Table $table
     * @param $columns
     * @param array|null $options
     * @return string
     */
    public function onReceive(Table $table, $columns, ?array $options = []): string
    {
        $CMapping = $this->getConversionMapping($options);

        $namespace = $this->getNamespace($options);

        $imports = $this->getImports($options);

        $extends = $this->getExtends($options);

        $implements = $this->getImplements($options);

        $classAnnotation = $this->getClassAnnotation($options);

        $fieldProperty = $this->getFieldProperty($options);

        $isMakeGetter = $this->getIsMakeGetter($options);

        $isMakeSetter = $this->getIsMakeSetter($options);

        $isMakeValida = $this->getIsMakeValida($options);

        $uTableName = StrCharacter::getInstance()->toFirstUppercase($table->getName(), '_');

        $classTemplate = file_get_contents(PATH_APP . 'template/php/class');

        $propertyTemplate = file_get_contents(PATH_APP . 'template/php/property');

        if ($isMakeSetter) $propertyTemplate .= file_get_contents(PATH_APP . 'template/php/setter');

        if ($isMakeGetter) $propertyTemplate .= file_get_contents(PATH_APP . 'template/php/getter');

        if ($isMakeValida) $propertyTemplate .= file_get_contents(PATH_APP . 'template/php/valida');

        $properties = '';

        /** @var Column $column */
        foreach ($columns as $column) {

            $CType = $this->getConversionType($CMapping, $table, $column);

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

            $RType = empty($CType) ? '' : ": ?{$CType}";

            $SType = empty($CType) ? '' : "?{$CType} ";

            $DRType = empty($CType) ? 'mixed' : "{$CType}";

            $DSType = empty($CType) ? '' : "{$CType}|null ";

            $properties .= $this->parseVariable($propertyTemplate, [
                'comment' => $column->getComment(),
                'length' => $column->getLength(),
                'type' => $column->getType(),
                'name' => $column->getName(),
                'UName' => $UName,
                'property' => $fieldProperty,
                'RType' => $RType,
                'SType' => $SType,
                'DRType' => $DRType,
                'DSType' => $DSType,
            ]);
        }

        return $this->parseVariable($classTemplate, [
            'date' => Cal()->getDate(),
            'namespace' => $namespace,
            'imports' => $this->formatImports($imports),
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
