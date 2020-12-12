<?php

namespace rapidPHP\modules\router\classier\router;


use Exception;
use rapidPHP\modules\application\classier\Application;
use rapidPHP\modules\application\classier\apps\WebApplication;
use rapidPHP\modules\application\classier\Context;
use rapidPHP\modules\application\classier\context\WebContext;
use rapidPHP\modules\common\classier\Build;
use rapidPHP\modules\core\classier\Controller;
use rapidPHP\modules\exception\classier\ActionException;
use rapidPHP\modules\exception\classier\InvalidArgumentException;
use rapidPHP\modules\router\classier\Action;
use rapidPHP\modules\router\classier\Handler;
use rapidPHP\modules\router\classier\Mapping;
use rapidPHP\modules\router\classier\Route;
use rapidPHP\modules\router\classier\Router;
use rapidPHP\modules\server\classier\http\cgi\Response;
use rapidPHP\modules\server\classier\interfaces\Request;
use rapidPHP\modules\server\classier\websocket\swoole\Request as SwooleWebSocketRequest;
use rapidPHP\modules\server\classier\websocket\swoole\Response as SwooleWebSocketResponse;

class WebRouter extends Router
{

    /**
     * 单一入口参数名
     */
    const SINGLE_ENTRANCE_NAME = '__ROUTE__';

    /**
     * @var Request
     */
    private $request;

    /**
     * @var Response
     */
    private $response;

    /**
     * @return WebApplication
     */
    public function getApplication()
    {
        /** @var WebApplication $app */
        $app = parent::getApplication();

        return $app;
    }

    /**
     * @return WebContext
     */
    public function getContext()
    {
        /** @var WebContext $context */
        $context = parent::getContext();

        return $context;
    }

    /**
     * @param Application $application
     * @param Context $context
     * @throws Exception
     */
    public function run(Application $application, Context $context)
    {
        if (!($application instanceof WebApplication)) {
            throw new InvalidArgumentException('application is not WebApplication');
        }

        if (!($context instanceof WebContext)) {
            throw new InvalidArgumentException('context is not WebContext');
        }

        $this->request = $context->getRequest();

        $this->response = $context->getResponse();

        $context->supportsParameter([
            WebApplication::class => $application,
            WebRouter::class => $this
        ]);

        parent::run($application, $context);
    }

    /**
     * 内网扫描controller映射
     * @param array $routes
     * @param array $actions
     * @throws Exception
     */
    protected function scanning(&$routes = [], &$actions = [])
    {
        $ip = $this->request->getIp();

        if (!(is_null($ip) || Build::getInstance()->isIntranet($ip))) return;

        $paths = $this->getApplication()->getConfig()->getApplication()->getScans()->getController();

        $routes = [];

        $actions = [];

        Mapping::getInstance()->scanning($paths, $routes, $actions);

        Mapping::getInstance()->save($routes, $actions);
    }

    /**
     * 设置header 文字编码
     */
    private function setCharacterCode()
    {
        if (!($this->request instanceof SwooleWebSocketRequest)) {
            $this->response->header('Access-Control-Allow-Origin: *');

            $this->response->header("Content-type: text/html; charset=utf-8");
        }
    }

    /**
     * 获取真实访问路径
     */
    private function getRealPath(): string
    {
        $path = trim($this->request->get(self::SINGLE_ENTRANCE_NAME), '/');

        if (empty($path)) $path = $this->request->getDocumentRoot();

        return $path ? $path : '/';
    }


    /**
     * 匹配路由
     * @throws Exception
     */
    protected function matching()
    {
        $this->setCharacterCode();

        try {
            $action = $this->getMatchingAction($this->getRealPath(), $route, $pathVariable, $index);

            if (!$action) throw new Exception('not match action', 404);

            $method = explode(',', $action->getMethod());

            if ($method && !in_array(strtoupper($this->request->getMethod()), $method)) {
                throw new ActionException('request method not current method', 403, $action);
            }

            $this->invoke($route, $action, $pathVariable);
        } catch (Exception $e) {
            $this->matchingError($e);
        }
    }

    /**
     * 获取参数
     * @param Action $action
     * @param $pathVariable
     * @param callable|null $params
     * @param Exception|null $exception
     * @return array
     */
    protected function getParameters(Action $action, $pathVariable, callable $params = null, ?Exception $exception = null): array
    {
        return parent::getParameters($action, $pathVariable, function ($name, $source) {
            return $this->request->getParam($name, $source);
        }, $exception);
    }

    /**
     * 获取handler options
     * @param Route $route
     * @param Action $action
     * @return array
     * @throws Exception
     */
    private function getHandlerOptions(Route $route, Action $action): array
    {
        $options = [
            'route' => $route,
            'action' => $action,
            'accept' => $this->request->header('Accept'),
        ];

        if ($this->response instanceof SwooleWebSocketResponse) {
            $returnKey = $this->getApplication()
                ->getConfig()
                ->getServer()
                ->getSwoole()
                ->getWebsocket()
                ->getReturnKey();

            $options['append'][$returnKey] = $this->request->getParam($returnKey);
        }

        return $options;
    }

    /**
     * @param Controller $controller
     * @param $result
     * @param Route $route
     * @param Action $action
     * @throws Exception
     */
    protected function onResult(Controller $controller, Route $route, Action $action, $result)
    {
        if (!empty($action->getHeader())) {
            $this->response->setHeader($action->getHeader());
        }

        $options = $this->getHandlerOptions($route, $action);

        $service = Handler::getInstance()->getService($result, $action->getTyped());

        $result = Handler::getInstance()->handler($controller, $service, $result, $options);

        if ($result === null) return;

        $result = Handler::getInstance()->encode($result, $action->getEncode());

        if ($result === null) return;

        $this->response->write($result);
    }

}