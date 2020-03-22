<?php

namespace rapidPHP\library\core;

use Exception;

class Loader
{

    private static $map = null;


    /**
     * 自动加载
     * @param array $map
     */
    public static function init(array $map = array())
    {
        self::$map = $map;

        spl_autoload_register(function ($name) {
            self::loader($name);
        });
    }

    /**
     * 自动加载
     * @param $name
     * @return mixed
     * @throws Exception
     */
    public static function loader($name)
    {
        $file = self::getFilePath($name);

        if (is_file($file)) {
            return include($file . '');
        } else {
            throw new Exception('autoload file error ' . $file);
        }
    }

    /**
     * 获取文件实际路径
     * @param $name
     * @return mixed
     */
    public static function getFilePath($name)
    {
        return self::formatPath(self::getMap($name));
    }

    /**
     * 添加自动加载类
     * @param $name
     * @param $value
     * @return mixed
     */
    public static function addMap($name, $value)
    {
        return self::$map[$name] = $value;
    }

    /**
     * 获取对应文件
     * @param $name
     * @param string $path
     * @return string
     */
    public static function getMap($name, $path = ROOT_PATH)
    {
        $file = (isset(self::$map[$name]) ? self::$map[$name] : $name) . (strpos($name, '.') ? '' : '.class.php');

        if (is_file($filePath = self::formatPath($path . $file))) {
            return $filePath;
        } else if (is_file($application = self::formatPath(APP_PATH . $file))) {
            return $application;
        } else if (is_file($conf = self::formatPath(ROOT_CONF . $file))) {
            return $conf;
        } else if (is_file($library = self::formatPath(ROOT_LIBRARY . $file))) {
            return $library;
        }

        return self::formatPath($path . $file);
    }


    /**
     * 格式化路径
     * @param $path
     * @return mixed
     */
    public static function formatPath($path)
    {
        return str_replace('\\', '/', $path);
    }
}