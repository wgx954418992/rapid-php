<?php

namespace rapidPHP\modules\common\classier;

use rapidPHP\modules\console\classier\Args;
use rapidPHP\modules\console\classier\Utils;

class Variable
{
    /**
     * 变量类型 integer
     */
    const INTEGER = 'integer';

    /**
     * 变量类型 int
     */
    const INT = 'int';

    /**
     * 变量类型 double
     */
    const DOUBLE = 'double';

    /**
     * 变量类型 string
     */
    const STRING = 'string';

    /**
     * 变量类型 array
     */
    const ARRAY = 'array';

    /**
     * 变量类型 object
     */
    const OBJECT = 'object';

    /**
     * 变量类型 boolean
     */
    const BOOLEAN = 'boolean';

    /**
     * 变量类型 bool
     */
    const BOOL = 'bool';

    /**
     * 变量类型 float
     */
    const FLOAT = 'float';

    /**
     * 变量类型 null
     */
    const NULL = 'null';

    /**
     * 混合类型 mixed
     */
    const MIXED = 'mixed';

    /**
     * 设置var默认可选类型
     * @var array
     */
    public static $CAPABLE_SET_TYPES = [
        self::INTEGER,
        self::INT,
        self::FLOAT,
        self::DOUBLE,
        self::STRING,
        self::ARRAY,
        self::OBJECT,
        self::BOOLEAN,
        self::BOOL,
        self::NULL,
    ];

    /**
     * 能否调用settype函数
     * @param $type
     * @return bool
     */
    public static function isSetType($type): bool
    {
        return in_array($type, self::$CAPABLE_SET_TYPES);
    }

    /**
     * safe settype
     * @param $value
     * @param $type
     * @return void
     */
    public static function setType(&$value, $type)
    {
        if (empty($type)) return;

        if ($type === self::MIXED) return;

        $type = strtolower($type);

        if (is_array($value) && $type === 'string') {
            $value = join('', $value);
        }

        settype($value, $type);
    }

    /**
     * 解析var 通过数组
     * @param $data
     */
    public static function parseVarByArray(&$data)
    {
        $result = [];

        foreach ($data as $key => $value) {
            if (is_string($value) && !is_null($data)) {
                self::parseVarByString($value);
            } else if (is_array($value)) {
                self::parseVarByArray($value);
            }

            self::parseVarByString($key);

            $result[$key] = $value;
        }

        $data = $result;
    }

    /**
     * 解析var 通过字符串
     * @param string $content
     */
    public static function parseVarByString(string &$content)
    {
        $vars = Build::getInstance()->getRegularAll('/\${(.*?)}/i', $content);

        if (empty($vars)) return;

        foreach ($vars as $var) {

            $value = self::getVarValue($var);

            $content = str_replace("\${{$var}}", $value, $content);
        }
    }

    /**
     * 获取var 值
     * 1.先常量里面读取
     * 2.再从输入的命令行进行读取
     * 3.最后从 $_ENV 环境变量中取
     * @param $var
     * @return false|false[]|mixed|string[]|null
     */
    public static function getVarValue($var)
    {
        if (defined($var)) return constant($var);

        $value = Args::getInstance()->getOptionValue($var);

        if (!empty($value)) return $value;

        if (array_key_exists($var, $_ENV)) return Build::getInstance()->getData($_ENV, $var);

        return null;
    }
}
