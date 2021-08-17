<?php

namespace script\convert\classier\converter;

use Exception;
use rapidPHP\modules\common\classier\Build;
use rapidPHP\modules\common\classier\Calendar;
use rapidPHP\modules\common\classier\StrCharacter;
use rapidPHP\modules\reflection\classier\Classify;
use script\convert\classier\ConverterInterface;
use script\convert\classier\Property;
use script\model\classier\Column;
use script\model\classier\HandlerInterface;
use script\model\classier\Table;

class SwiftConverter extends ConverterInterface
{

    /**
     * CONVERSION
     */
    const CONVERSION = [
        'Int' => [
            'int',
        ],
        'Bool' => [
            'bool',
        ],
        'Float' => [
            'float',
        ],
        'Double' => [
            'double',
        ],
        'String' => [
            'string'
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
     * 格式化class name
     * @param $className
     * @return string|string[]|null
     */
    private function formatClassName($className)
    {
        if (empty($className)) return $className;

        return preg_replace('#(.*\\\)#i', '', $className);
    }

    /**
     * 把数据库字段类型转换成 php强类型
     * @param Property $property
     * @param bool $isArray
     * @return mixed|string|null
     */
    private function getConversionType(Property $property, &$isArray = false): ?string
    {
        $isArray = false;

        $type = $property->getType();

        if (is_int(strpos($type, '[')) || $type == 'array') {

            $isArray = true;

            $type = str_replace(['[', ']'], '', $type);
        }

        if (isset($this->conversionMapping[$type])) {
            return $this->conversionMapping[$type];
        } else {
            return $this->formatClassName($type) ?? "String";
        }
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
     * toString
     * @param Property $property
     * @return string|string[]
     */
    private function propertyToString(Property $property)
    {
        $conversionType = $this->getConversionType($property, $isArray);

        $template = <<<EOF
{doc}
    {access}{static}{var} {name}{type}{eq} {eqv}

    
EOF;

        $doc = str_replace(
            ['/**', ' */', ' *', '@var', '@length', '@typed', ': '],
            ['///', '///', '///', $conversionType, 'length', 'typed', ''],
            $property->getDoc()
        );

        return str_replace(
            ['{doc}', '{access}', '{static}', '{var}', '{name}', '{type}', '{eq}', '{eqv}'],
            [
                $doc,

                'public',

                $property->getIsStatic() ? ' static ' : ' ',

                $property->getIsConst() ? 'let' : 'var',

                $property->getName(),

                $property->getDefault() ? '' : ': ' . ($isArray ? "[{$conversionType}]" : $conversionType),

                ' =',

                $property->getDefault() ? (is_string($property->getDefault()) ? "\"{$property->getDefault()}\"" : $property->getDefault()) : "{$conversionType}()",
            ],
            $template
        );
    }

    /**
     * @param array $properties
     * @param $className
     * @param string $doc
     * @param null $namespace
     * @param array|null $options
     * @return mixed|string|string[]
     */
    public function onConvert(array $properties, $className, string $doc, $namespace = null, ?array $options = [])
    {
        $className = $this->formatClassName($className);

        $extends = Build::getInstance()->getData($options, 'extends');

        if (!empty($extends)) {
            if (!is_array($extends)) $extends = [$extends];

            foreach ($extends as &$extend) {
                $extend = $this->formatClassName($extend);
            }

            $extends = ': ' . join(',', is_array($extends) ? $extends : (array)$extends);
        }

        $imports = Build::getInstance()->getData($options, 'imports');

        if (!empty($imports)) {
            $imports = 'import ' . join("\nimport ", is_array($imports) ? $imports : (array)$imports);
        }

        $doc = str_replace(
            ['/**', ' */', ' *'],
            ['///', '///', '///'],
            $doc
        );
        $classString = <<<EOF
{$imports}

{$doc}
class {$className}{$extends} {

    {properties}

}
EOF;

        $propertiesString = '';

        /** @var Property $property */
        foreach ($properties as $property) {

            $propertiesString .= $this->propertyToString($property);
        }

        return str_replace(['{properties}'], $propertiesString, $classString);
    }
}