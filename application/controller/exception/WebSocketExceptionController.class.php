<?php


namespace application\controller\exception;


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

            $data[WEBSOCKET_RETURN_KEY] = $this->getRequest()->getParam(WEBSOCKET_RETURN_KEY);

            $response->write(json_encode($data));
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