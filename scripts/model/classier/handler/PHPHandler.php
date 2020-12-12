<?php

namespace script\model\classier\handler;

use rapidPHP\modules\common\classier\Build;
use rapidPHP\modules\common\classier\Calendar;
use rapidPHP\modules\common\classier\StrCharacter;
use script\model\classier\Column;
use script\model\classier\HandlerInterface;
use script\model\classier\Table;

class PHPHandler extends HandlerInterface
{

    /**
     * CONVERSION
     */
    const CONVERSION = [
        'int' => [
            'int',
            'tinyint',
            'integer',
            'numeric',
            'year',
            'time',
            'year',
            'tinyint',
            'mediumint',
            'smallint',
        ],
        'float' => [
            'float',
            'double',
            'decimal',
        ],
        'bool' => [
            'bit',
            'real',
        ],
        'string' => [
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
        if (!version_compare(PHP_VERSION, '7.0.0')) return null;

        return Build::getInstance()->getData($this->conversionMapping, $type);
    }

    /**
     * 获取后缀
     * @return string
     */
    public function getExt(): string
    {
        return '.php';
    }

    /**
     * 收到字段
     * @param Table $table
     * @param $columns
     * @param null $namespace
     * @param array|null $options
     * @return string|string[]|void
     */
    public function onReceive(Table $table, $columns, $namespace = null, ?array $options = [])
    {
        $uTableName = StrCharacter::getInstance()->toFirstUppercase($table->getName(), '_');

        $className = "{$uTableName}Model";

        if ($namespace) $namespace = "namespace {$namespace};";

        $date = Calendar::getInstance()->getDate();

        $classString = <<<EOF
<?php

{$namespace}

use Exception;
use rapidPHP\modules\core\classier\Model;

/**
 * {$table->getComment()}
 * @table {$table->getName()}
 * rapidPHP auto generate Model {$date}
 */
class {$className} extends Model
{
    
    /**
     * table name
     */
    const NAME = '{$table->getName()}';
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
    public \${$column->getName()};
EOF;

            $classString .= <<<EOF
    
    /**
     * 获取 {$column->getComment()}
     * @return {getReturnType}
     */
    public function get{$uColumnName}(){returnType}
    {
        return \$this->{$column->getName()};
    }
    
    /**
     * 设置 {$column->getComment()}
     * @param {paramSetType}\${$column->getName()}
     */
    public function set{$uColumnName}({setType}\${$column->getName()})
    {
        \$this->{$column->getName()} = \${$column->getName()};
    }
    
    /**
     * 效验 {$column->getComment()}
     * @param string \$msg
     * @throws Exception
     */
    public function valid{$uColumnName}(string \$msg = '{$column->getName()} Cannot be empty!')
    {
        if(empty(\$this->{$column->getName()})) throw new Exception(\$msg);
    }

EOF;

            $returnType = empty($conversionType) ? "" : ": ?{$conversionType}";

            $getReturnType = empty($conversionType) ? "mixed" : "{$conversionType}";

            $setType = empty($conversionType) ? "" : "?{$conversionType} ";

            $paramSetType = empty($conversionType) ? "" : "{$conversionType}|null ";

            $classString = str_replace(['{returnType}', '{getReturnType}', '{setType}', '{paramSetType}'],
                [$returnType, $getReturnType, $setType, $paramSetType],
                $classString);
        }

        $classString .= <<<EOF
}
EOF;

        return str_replace(['{properties}'], $properties, $classString);
    }
}