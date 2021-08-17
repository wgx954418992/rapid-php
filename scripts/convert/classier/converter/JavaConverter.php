<?php

namespace script\convert\classier\converter;

use rapidPHP\modules\common\classier\Build;
use rapidPHP\modules\common\classier\Calendar;
use rapidPHP\modules\common\classier\StrCharacter;
use script\model\classier\Column;
use script\model\classier\HandlerInterface;
use script\model\classier\Table;

class JavaConverter extends HandlerInterface

{

    /**
     * CONVERSION
     */
    const CONVERSION = [
        'Integer' => [
            'int',
            'integer',
            'numeric',
            'year',
            'time',
            'mediumint',
            'smallint',
        ],
        'Long' => [
            'bigint',
        ],
        'char' => [
            'char',
            'year',
            'tinyint',
        ],
        'Bool' => [
            'real',
        ],
        'Float' => [
            'float',
        ],
        'Double' => [
            'double',
        ],
        'Byte' => [
            'bit',
            'blob',
            'longblob',
            'mediumblob',
        ],
        'BigDecimal' => [
            'decimal',
        ],
        'Object' => [
            'json'
        ],
        'String' => [
            'binary',
            'varchar',
            'varbinary',
            'text',
            'textarea',
            'mediumtext',
            'linestring',
            'multilinestring',
            'tinytext',
            'longtext',
            'multipolygon',
            'multipoint',
            'polygon',
            'date',
            'datetime',
            'enum',
        ],
    ];


    /**
     * @var array
     */
    private $conversionMapping = [];

    /**
     * PHPHandler constructor.
     */
    public function __construct()
    {
        $this->initConversionMapping();
    }

    /**
     * 初始化映射
     */
    private function initConversionMapping()
    {
        foreach (self::CONVERSION as $type => $value) {
            foreach ($value as $t) {
                $this->conversionMapping[$t] = $type;
            }
        }
    }

    /**
     * 把数据库字段类型转换成 php强类型
     * @param $type
     * @return mixed|string|null
     */
    private function getConversionType($type): ?string
    {
        if (isset($this->conversionMapping[$type])) return $this->conversionMapping[$type];

        return 'String';
    }


    /**
     * 获取后缀
     * @return string
     */
    public function getExt(): string
    {
        return '.java';
    }

    /**
     * @param Table $table
     * @param $columns
     * @param null $namespace
     * @param array|null $options
     * @return mixed|void
     */
    public function onReceive(Table $table, $columns, $namespace = null, ?array $options = [])
    {
        $extends = Build::getInstance()->getData($options, 'extends');

        $imports = '';

        if (!empty($extends)) $imports = 'import ' . join(";\nimport ", is_array($extends) ? $extends : (array)$extends) . ';';

        if (!empty($extends)) $extends = 'extends ' . join(',', is_array($extends) ? $extends : (array)$extends);

        $uTableName = StrCharacter::getInstance()->toFirstUppercase($table->getName(), '_');

        if ($namespace) $namespace = "package {$namespace};";

        $className = "{$uTableName}Model";

        $date = Calendar::getInstance()->getDate();

        $classString = <<<EOF
{$namespace}

{$imports}

/**
 * {$table->getComment()}
 * @table {$table->getName()}
 * rapidPHP auto generate Model {$date}
 */
class {$className} {$extends} {

    /**
    * table name
    */
    public static final String NAME = "{$table->getName()}"
    {properties}

EOF;

        $properties = '';

        /** @var Column $column */
        foreach ($columns as $column) {

            $uColumnName = StrCharacter::getInstance()->toFirstUppercase($column->getName(), '_');

            $conversionType = $this->getConversionType($column->getType());

            $properties .= <<<EOF
    
    
    /**
     * {$column->getComment()}
     * @length {$column->getLength()}
     * @typed {$column->getType()}
     */
    private {$conversionType} {$column->getName()};
EOF;
            $classString .= <<<EOF
    

    
    /**
     * 获取 {$column->getComment()}
     * @return {$conversionType}
     */
    public {$conversionType} get{$uColumnName}()
    {
        return this.{$column->getName()};
    }
    
    /**
     * 设置 {$column->getComment()}
     * @param {$conversionType} {$column->getName()}
     */
    public void set{$uColumnName}({$conversionType} {$column->getName()})
    {
        this.{$column->getName()} = {$column->getName()};
    }

EOF;

        }

        $classString .= <<<EOF

}
EOF;

        return str_replace(['{properties}'], $properties, $classString);
    }
}