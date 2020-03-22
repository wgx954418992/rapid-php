<?php

namespace rapidPHP\library\core\app\exception;


use Exception;
use rapidPHP\library\RESTFullApi;

class ExceptionController implements ExceptionInterface
{

    /**
     * 执行异常
     * @param Exception $exception
     * @param $uri
     * @param $className
     * @param $methodName
     * @param $classObject
     */
    public function handler(Exception $exception, $uri, $className, $methodName, $classObject = null)
    {
        if (is_int(strpos($uri, "api/"))) {
            B()->setHeader(['Content-Type:text/json;']);

            $json = RESTFullApi::error($exception->getMessage(), $exception->getCode())
                ->toJson();

            echo($json);
        } else {
            echo($exception->getMessage());
        }
    }

    /**
     * 404找不到执行方法或者页面
     * @param $uri
     */
    public function notFound($uri)
    {
        B()->setHeader(['HTTP/1.1 404 Not Found', 'status: 404 Not Found']);

        exit();
    }

    /**
     * 无权访问该方法，或者请求方法类型错误
     * @param $uri
     * @param $className
     * @param $appName
     */
    public function forbidden($uri, $className, $appName)
    {
        B()->setHeader(['HTTP/1.1 403 Forbidden', 'status: 403 Forbidden']);

        exit();
    }

}