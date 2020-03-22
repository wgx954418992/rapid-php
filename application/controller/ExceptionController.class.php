<?php


namespace application\controller;


use Exception;
use rapidPHP\library\core\app\exception\ExceptionInterface;
use rapidPHP\library\RESTFullApi;

class ExceptionController implements ExceptionInterface
{

    /**
     * @inheritDoc
     */
    public function handler(Exception $exception, $uri, $className, $methodName, $classObject = null)
    {
        if (is_int(strpos($uri, "api/"))) {
            B()->setHeader(['Content-Type:text/json;']);

            $json = RESTFullApi::error($exception->getMessage(), $exception->getCode())
                ->toJson();

            exit($json);
        } else {
            exit("<script>alert('{$exception->getMessage()}');window.history.back()</script> ");
        }
    }

    /**
     * @inheritDoc
     */
    public function notFound($uri)
    {
    }

    /**
     * @inheritDoc
     */
    public function forbidden($uri, $className, $appName)
    {
    }
}