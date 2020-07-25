<?php


namespace application\controller\exception;


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

        if (strtolower($typed) === 'api' || strtolower($typed) === 'raw') {
            $this->getResponse()->setHeader(['Content-Type:text/json']);

            $json = RESTFullApi::error($exception->getMessage(), $exception->getCode())
                ->toJson();

            $this->getResponse()->write($json);
        } else {
            $message = $exception->getMessage();

            $this->getResponse()->write("<script>alert('{$message}');window.history.back()</script>");
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
        $this->getResponse()->status(403);
    }
}