<?php


namespace application\controller;


use Exception;
use rapidPHP\library\core\app\Controller;
use rapidPHP\library\core\app\exception\ExceptionInterface;
use rapidPHP\library\core\server\response\SWebSocketResponse;
use rapidPHP\library\RESTFullApi;

class WebSocketExceptionController extends Controller implements ExceptionInterface
{

    /**
     * @inheritDoc
     */
    public function handler(Exception $exception, $uri, $className, $methodName, $classObject = null, $appMethodData = [])
    {
        $response = $this->getResponse();

        if ($response instanceof SWebSocketResponse) {

            $data = RESTFullApi::error($exception->getMessage(), $exception->getCode())
                ->getResult();

            $data['callback'] = I($this->getRequest())->getRequest('callback');

            $response->write(json_encode($data));
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
    public function forbidden($uri, $className, $appName, $appMethodData)
    {
    }
}