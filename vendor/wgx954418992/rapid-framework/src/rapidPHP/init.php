<?php


namespace rapidPHP;

use rapidPHP\modules\core\classier\DI;
use Exception;
use rapidPHP\modules\common\classier\AB;
use rapidPHP\modules\common\classier\AR;
use rapidPHP\modules\common\classier\Build;
use rapidPHP\modules\common\classier\Calendar;
use rapidPHP\modules\common\classier\File;
use rapidPHP\modules\common\classier\Register;
use rapidPHP\modules\common\classier\StrCharacter;
use rapidPHP\modules\common\classier\Verify;
use rapidPHP\modules\common\classier\Xml;
use rapidPHP\modules\core\classier\web\ViewTemplate;
use rapidPHP\modules\reflection\classier\Classify;

// 检测PHP环境
if (version_compare(PHP_VERSION, '7.2.0', '<')) die('require PHP > 7.1.0 !');

//运行模式
define('RAPIDPHP_VERSION', '3.9.8');

//运行模式
define('APP_RUNNING_SAPI_NAME', php_sapi_name());

//运行模式是否命令运行
define('APP_RUNNING_IS_SHELL', isset($_SERVER['SHELL']));

//项目根目录
define('PATH_ROOT', str_replace('\\', '/', dirname(dirname(dirname(dirname(dirname(__DIR__)))))) . '/');

//rapidPHP 框架根目录
define('PATH_RAPIDPHP_ROOT', str_replace('\\', '/', dirname(dirname(__DIR__))) . '/src/');

//当前框架根目录
define('PATH_FRAMEWORK', PATH_RAPIDPHP_ROOT . 'rapidPHP/');

//modules目录
define('PATH_MODULES', PATH_FRAMEWORK . 'modules/');

//当前运行文件根目录
define('PATH_RUNTIME', PATH_ROOT . 'runtime/');

//当前app运行文件目录
if (defined('PATH_APP')) define('PATH_APP_RUNTIME', PATH_APP . 'runtime/');

if (!defined('SWOOLE_HOOK_ALL')) define('SWOOLE_HOOK_ALL', 1879048191);

if (!defined('SWOOLE_HOOK_CURL')) define('SWOOLE_HOOK_CURL', 268435456);

/**
 * 快捷获取ArrayObject类
 * @param $array
 * @return AB
 */
function AB($array = null): AB
{
    return AB::getInstance($array);
}

/**
 * 快捷获取Array类
 * @return AR
 */
function AR(): AR
{
    return AR::getInstance();
}

/**
 * 快捷获取build类
 * @return Build
 */
function B(): Build
{
    return Build::getInstance();
}


/**
 * 快捷获取StrCharacter类
 * @return StrCharacter
 */
function Str(): StrCharacter
{
    return StrCharacter::getInstance();
}

/**
 * 快捷获取Calendar类
 * @return Calendar
 */
function Cal(): Calendar
{
    return Calendar::getInstance();
}

/**
 * 获取获得文件操作类
 * @return File
 */
function F(): File
{
    return File::getInstance();
}

/**
 * 获取获得验证操作类
 * @return Verify
 */
function V(): Verify
{
    return Verify::getInstance();
}

/**
 * 获取获得xml操作类
 * @return Xml
 */
function X(): Xml
{
    return Xml::getInstance();
}

/**
 * 实例化类中转站，如果类已经实例化过则自动取出之前的
 * @param $name string 类名字，如果用命名空间则需要带上命名空间
 * @param array $parameter
 * @param bool $forced
 * @return array|null|object|string
 * @throws Exception
 */
function M(string $name, array $parameter = [], bool $forced = false)
{
    if ($forced == false) {
        if (Register::getInstance()->isPut($name)) {
            return Register::getInstance()->get($name);
        } else {
            $object = Classify::getInstance($name)->newInstanceArgs($parameter);

            Register::getInstance()->put($name, $object);

            return $object;
        }
    } else {
        $object = Classify::getInstance($name)->newInstanceArgs($parameter);

        Register::getInstance()->put($name, $object);

        return $object;
    }
}

/**
 * 获取当前view的 ViewTemplate 对象
 * @param $view
 * @return ViewTemplate
 */
function VT($view): ?ViewTemplate
{
    if ($view instanceof ViewTemplate) return $view;

    return null;
}

/**
 * di
 * @template T
 * @param $class
 * @param ...$supports
 * @return T|false|void
 */
function DI($class, ...$supports)
{
    if (func_num_args() <= 1) {
        if (!is_array($class)) {
            return DI::resolveArgument($class);
        } else {
            DI::supportsParameter($class);
        }
    } else {
        DI::supportParameter($class, ...$supports);
    }

    return;
}

/**
 * 格式化异常
 * format Exception
 * @param Exception $e
 * @param string $format
 * @return string
 */
function formatException(Exception $e, string $format = "{msg} {code}\n{trace}\n thrown in {file} on line {line}"): string
{
    $result = [
        'code' => $e->getCode(),
        'msg' => $e->getMessage(),
        'trace' => $e->getTraceAsString(),
        'file' => $e->getFile(),
        'line' => $e->getLine(),
    ];

    foreach ($result as $key => $value) {
        $format = str_replace("{{$key}}", $value, $format);
    }

    return $format;
}
