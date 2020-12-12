<?php

namespace script\model\classier\handler;

use rapidPHP\modules\common\classier\Build;
use rapidPHP\modules\common\classier\Calendar;
use rapidPHP\modules\common\classier\StrCharacter;
use script\model\classier\Column;
use script\model\classier\HandlerInterface;
use script\model\classier\Table;

class SwiftHandler extends HandlerInterface
{

    /**
     * CONVERSION
     */
    const CONVERSION = [
        'Int' => [
            'int',
            'bigint',
            'integer',
            'numeric',
            'year',
            'time',
        ],
        'Int8' => [
            'year',
            'tinyint',
        ],
        'Int32' => [
            'mediumint',
            'smallint',
        ],
        'Bool' => [
            'bit',
            'real',
        ],
        'Float' => [
            'float',
        ],
        'Double' => [
            'double',
        ],
        'Money' => [
            'decimal',
        ],
        'String' => [
            'binary',
            'varchar',
            'varbinary',
            'char',
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
            'json'
        ],
        'Any' => [
            'blob',
            'longblob',
            'mediumblob',
        ]
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
        return '.swift';
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

        if (!empty($extends)) $extends = ': ' . join(',', is_array($extends) ? $extends : (array)$extends);

        $imports = Build::getInstance()->getData($options, 'imports');

        if (!empty($imports)) $imports = 'import ' . join("\nimport ", is_array($imports) ? $imports : (array)$imports);

        $uTableName = StrCharacter::getInstance()->toFirstUppercase($table->getName(), '_');

        $className = "{$uTableName}Model";

        $date = Calendar::getInstance()->getDate();

        $classString = <<<EOF
{$imports}

/// 
/// {$table->getComment()}
/// table {$table->getName()}
/// rapidPHP auto generate Model {$date}
class {$className}{$extends} {

    /// table name
    public static let NAME = "{$table->getName()}"
    {properties}

EOF;

        $properties = '';

        /** @var Column $column */
        foreach ($columns as $column) {

            $conversionType = $this->getConversionType($column->getType());

            $properties .= <<<EOF


    ///
    /// {$column->getComment()}
    /// length {$column->getLength()}
    /// typed {$column->getType()}
    public var {$column->getName()}: {$conversionType}?
EOF;
        }

        $classString .= <<<EOF

}
EOF;

        return str_replace(['{properties}'], $properties, $classString);
    }
}