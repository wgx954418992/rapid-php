<?php

use rapidPHP\library\AB;
use rapidPHP\library\AR;
use rapidPHP\library\Build;
use rapidPHP\library\core\Loader;
use rapidPHP\library\Db;
use rapidPHP\library\File;
use rapidPHP\library\Input;
use rapidPHP\library\Register;
use rapidPHP\library\Verify;
use rapidPHP\library\ViewTemplate;
use rapidPHP\library\Xml;

// 检测PHP环境
if (version_compare(PHP_VERSION, '7.0.0', '<')) die('require PHP > 7.0.0 !');

//运行模式
define('RAPIDPHP_VERSION', '2.1.1');

//运行模式
define('APP_RUNNING_SAPI_NAME', php_sapi_name());

//是否开启session
define('APP_IS_SESSION', false);

//运行模式是否命令运行
define('APP_RUNNING_IS_SHELL', isset($_SERVER['SHELL']));

//设置文档编码,如果是cil模式,请注释掉
if (APP_RUNNING_IS_SHELL === false) header("Content-type: text/html; charset=utf-8");

//程序根目录
define('ROOT_PATH', str_replace('\\', '/', dirname(__DIR__)) . '/');

//程序运行目录
define('ROOT_RUNNING_PATH', str_replace('\\', '/', dirname($_SERVER['SCRIPT_FILENAME'])) . '/');

//项目运行目录
define('ROOT_PROJECT_PATH', isset($_SERVER['DOCUMENT_ROOT']) && !empty($_SERVER['DOCUMENT_ROOT']) ? str_replace($_SERVER['DOCUMENT_ROOT'], '/', ROOT_PATH) : '');

//系统核心library包目录
define('ROOT_LIBRARY', ROOT_PATH . 'rapidPHP/library/');

//系统核心配置目录
define('ROOT_CONF', ROOT_PATH . 'rapidPHP/config/');

//系统核心公开目录
define('ROOT_PUBLIC', ROOT_PATH . 'public/');

//系统缓存目录
define('ROOT_RUNTIME', ROOT_PATH . 'running/');

//app目录
define('APP_PATH', ROOT_PATH . 'application/');

//开启session
if (APP_IS_SESSION === true) session_start();

//引入composer自动加载类
require ROOT_PATH . 'vendor/autoload.php' . '';

//引入rapidPHP自动加载类
require ROOT_LIBRARY . 'core/Loader.class.php' . '';

//初始化自动加载器
Loader::init();

/**
 * 快捷获取ArrayObject类
 * @param $array
 * @return AB
 */
function AB($array = null)
{
    return AB::getInstance($array);
}


/**
 * 快捷获取Array类
 * @return AR
 */
function AR()
{
    return AR::getInstance();
}

/**
 * 快捷获取build类
 * @return Build
 */
function B()
{
    return Build::getInstance();
}

/**
 * 快捷获取数据库操作(db)类
 * @param null $config
 * @return mixed|Db|null
 */
function D($config = null)
{
    return Db::getInstance($config);
}

/**
 * 获取获得文件操作类
 * @return File
 */
function F()
{
    return File::getInstance();
}

/**
 * 快捷获取表单输入（input）类
 * @return Input
 */
function I()
{
    return Input::getInstance();
}


/**
 * 获取获得寄存器操作类
 * @return Register
 */
function R()
{
    return Register::getInstance();
}

/**
 * 获取获得验证操作类
 * @return Verify
 */
function V()
{
    return Verify::getInstance();
}

/**
 * 获取获得xml操作类
 * @return Xml
 */
function X()
{
    return Xml::getInstance();
}

/**
 * 实例化类中转站，如果类已经实例化过则自动取出之前的
 * @param $name string 类名字，如果用命名空间则需要带上命名空间
 * @param array $parameter
 * @param bool $forced
 * @return array|null|object|string
 * @throws ReflectionException
 */
function M($name, $parameter = array(), $forced = false)
{
    if ($forced == false) {
        return $GLOBALS[$name] = ($object = B()->getData($GLOBALS, $name)) ? $object : (new ReflectionClass($name))->newInstanceArgs($parameter);
    } else {
        return $GLOBALS[$name] = (new ReflectionClass($name))->newInstanceArgs($parameter);
    }
}

/**
 * 获取当前view的 array object
 * @param $view
 * @return ViewTemplate
 */
function VT($view)
{
    if ($view instanceof ViewTemplate) return $view;

    return null;
}

//网站跟URL
define('APP_ROOT_URL', B()->getHostUrl());

//访问URL的跟目录
define('APP_ROOT_PATH', str_replace(B()->getData($_SERVER, 'DOCUMENT_ROOT'), '', ROOT_PATH));