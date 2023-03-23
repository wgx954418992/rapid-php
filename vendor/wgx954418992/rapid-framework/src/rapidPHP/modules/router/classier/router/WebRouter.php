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
    protected $request;

    /**
     * @var Response
     */
    protected $response;

    /**
     * @return WebApplication
     */
    public function getApplication()
    {
        return parent::getApplication();
    }

    /**
     * @return WebContext
     */
    public function getContext()
    {
        return parent::getContext();
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

        if ($context->getDecodeOptions() & Context::OPTIONS_DECODE_REQUEST_GET) {
            $context->decode($this->request->get);
        }

        if ($context->getDecodeOptions() & Context::OPTIONS_DECODE_REQUEST_POST) {
            $context->decode($this->request->post);
        }

        if ($context->getDecodeOptions() & Context::OPTIONS_DECODE_REQUEST_COOKIE) {
            $context->decode($this->request->cookie);
        }

        $this->response = $context->getResponse();

        $context->supportsParameter([
            WebApplication::class => $application,
            WebRouter::class => $this
        ]);

        parent::run($application, $context);
    }

    /**
     * 内网扫描controller映射
     * @param array|null $routes
     * @param array|null $actions
     * @throws Exception
     */
    protected function scanning(?array &$routes = [], ?array &$actions = [])
    {
        $ip = $this->request->getIp();

        if (!(is_null($ip) || Build::getInstance()->isIntranet($ip))) return;

        $paths = $this->getApplication()->getConfigWrapper()->getApplication()->getScans()->getController();

        $routes = [];

        $actions = [];

        Mapping::getInstance()->scanning($paths, $routes, $actions);

        Mapping::getInstance()->save($routes, $actions);
    }

    /**
     * 获取真实访问路径
     */
    private function getRealPath(): string
    {
        $path = trim($this->request->get(self::SINGLE_ENTRANCE_NAME), '/');

        if (empty($path)) $path = $this->request->getDocumentRoot();

        return !empty($path) ? $path : '/';
    }


    /**
     * 匹配路由
     * @throws Exception
     */
    protected function matching()
    {
        try {
            $realPath = $this->getRealPath();

            if ($this->context->getDecodeOptions() & Context::OPTIONS_DECODE_REALPATH) {
                $this->context->decode($realPath);
            }

            $this->getContext()->onMatchingBefore($this);

            $action = $this->getMatchingAction($realPath, $route, $pathVariable, $index);

            if (!$action) throw new Exception('Not match action', 404);

            if ($action->getMethod() != '*') {

                $method = explode(',', $action->getMethod());

                if ($method && !in_array(strtoupper($this->request->getMethod()), $method)) {
                    throw new ActionException('The request method is not allowed', 403, $action);
                }
            }

            $this->getContext()->onInvokeActionBefore($this, $action, $route, $pathVariable, $realPath);

            $this->invoke($route, $action, $pathVariable);
        } catch (Exception $e) {
            $this->matchingError($e);
        }
    }

    /**
     * 获取参数
     * @param $name
     * @param $source
     * @return array|int|mixed|string|null
     * @throws Exception
     */
    protected function onGetParameterValue($name, $source)
    {
        return $this->request->getParam($name, $source);
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
                ->getConfigWrapper()
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
    public function onResult(Controller $controller, Route $route, Action $action, $result)
    {
        $this->getContext()->onInvokeActionAfter($this, $action, $route, $result);

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
