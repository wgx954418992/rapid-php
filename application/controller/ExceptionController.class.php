<?php


namespace application\controller;


use Exception;
use rapidPHP\config\RouterConfig;
use rapidPHP\library\core\app\Controller;
use rapidPHP\library\core\app\exception\ExceptionInterface;
use rapidPHP\library\RESTFullApi;

class ExceptionController extends Controller implements ExceptionInterface
{

    /**
     * @inheritDoc
     */
    public function handler(Exception $exception, $uri, $className, $methodName, $classObject = null, $appMethodData = [])
    {
        $typed = B()->getData($appMethodData, RouterConfig::TYPED_TYPE);

        if (strtolower($typed) === 'api') {
            $this->getResponse()->setHeader(['Content-Type:text/json']);

            $json = RESTFullApi::error($exception->getMessage(), $exception->getCode())
                ->toJson();

            $this->getResponse()->write($json);
        } else {
            $this->getResponse()->write("<script>alert('{$exception->getMessage()}');window.history.back()</script> ");
        }
    }

    /**
     * @inheritDoc
     */
    public function notFound($uri)
    {
        $this->getResponse()->status(404);
    }

    /**
     * @inheritDoc
     */
    public function forbidden($uri, $className, $appName, $appMethodData)
    {
        $this->getResponse()->setHeader(403);
    }
}