<?php

namespace rapidPHP\library\core\app\exception;


use Exception;
use rapidPHP\config\RouterConfig;
use rapidPHP\library\core\app\Controller;
use rapidPHP\library\core\server\Request;
use rapidPHP\library\core\server\Response;
use rapidPHP\library\RESTFullApi;

class ExceptionController extends Controller implements ExceptionInterface
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
    public function handler(Exception $exception, $uri, $className, $methodName, $classObject = null, $appMethodData = [])
    {
        $typed = B()->getData($appMethodData, RouterConfig::TYPED_TYPE);

        $requestAccept = B()->getData($this->getRequest()->header(), 'Accept');

        if (strtolower($typed) === 'api'
            || strtolower($typed) === 'raw'
            || (strtolower($typed) === 'auto' && $requestAccept === '*/*')) {
            $this->getResponse()->setHeader(['Content-Type:text/json']);

            $json = RESTFullApi::error($exception->getMessage(), $exception->getCode())
                ->toJson();

            $this->getResponse()->write($json);
        } else {
            $this->getResponse()->write($exception->getMessage());
        }
    }

    /**
     * 404找不到执行方法或者页面
     * @param $uri
     */
    public function notFound($uri)
    {
        $this->getResponse()->setHeader(404);
    }

    /**
     * 无权访问该方法，或者请求方法类型错误
     * @param $uri
     * @param $className
     * @param $appName
     * @param $appMethodData
     */
    public function forbidden($uri, $className, $appName, $appMethodData)
    {
        $this->getResponse()->setHeader(403);
    }

}