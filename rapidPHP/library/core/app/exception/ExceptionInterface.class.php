<?php

namespace rapidPHP\library\core\app\exception;


use Exception;

interface ExceptionInterface
{
    /**
     * 执行异常
     * @param Exception $exception
     * @param $uri
     * @param $className
     * @param $methodName
     * @param $classObject
     * @param array $appMethodData
     */
    public function handler(Exception $exception, $uri, $className, $methodName, $classObject = null, $appMethodData = []);

    /**
     * 404找不到页面
     * @param $uri
     */
    public function notFound($uri);

    /**
     * 无权访问该方法，或者请求方法类型错误
     * @param $uri
     * @param $className
     * @param $appName
     * @param array $appMethodData
     */
    public function forbidden($uri, $className, $appName, $appMethodData);
}