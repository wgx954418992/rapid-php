<?php

namespace rapidPHP\modules\router\classier;


use Exception;
use rapidPHP\modules\application\classier\Application;
use rapidPHP\modules\application\classier\apps\WebApplication;
use rapidPHP\modules\application\classier\Context;
use rapidPHP\modules\application\classier\context\WebContext;
use rapidPHP\modules\common\classier\Build;
use rapidPHP\modules\common\classier\Verify;
use rapidPHP\modules\core\classier\Controller;
use rapidPHP\modules\core\classier\web\WebController;
use rapidPHP\modules\exception\classier\ActionException;
use rapidPHP\modules\reflection\classier\Classify;
use rapidPHP\modules\reflection\classier\Utils as ReflectionUtils;
use rapidPHP\modules\router\classier\action\Parameter as ActionParameter;
use rapidPHP\modules\router\config\ActionConfig;

abstract class Router
{

    /**
     * @var Application
     */
    private $application;

    /**
     * @var Context
     */
    private $context;

    /**
     * @var array|null
     */
    protected $routes;

    /**
     * @var array|null
     */
    protected $actions;

    /**
     * @return self
     */
    abstract public static function getInstance();

    /**
     * @return Application|WebApplication
     */
    public function getApplication()
    {
        return $this->application;
    }

    /**
     * @return Context|WebContext
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * @return array|null
     */
    public function getRoutes(): ?array
    {
        return $this->routes;
    }

    /**
     * @return array|null
     */
    public function getActions(): ?array
    {
        return $this->actions;
    }

    /**
     * @param Application $application
     * @param Context $context
     * @throws Exception
     */
    public function run(Application $application, Context $context)
    {
        $this->application = $application;

        $this->context = $context;

        $context->supportsParameter([
            Application::class => $application,
            Router::class => $this
        ]);

        $this->scanning($this->routes, $this->actions);

        Mapping::getInstance()->read($this->routes, $this->actions);

        $this->matching();
    }

    /**
     * 扫描controller映射(一般只在内网进行扫描)
     * @param array $routes
     * @param array $actions
     * @throws Exception
     */
    abstract protected function scanning(&$routes = [], &$actions = []);

    /**
     * 匹配路由
     * @return mixed
     */
    abstract protected function matching();

    /**
     * 匹配error
     * 先按照错误code进行匹配,如果没有匹配到，则全部转到error action 上面
     * @param Exception $e
     * @throws ActionException
     * @throws Exception
     */
    protected function matchingError(Exception $e)
    {
        $action = $this->getMatchingAction('error/' . $e->getCode(), $route, $pathVariable);

        if (!$action) {
            $action = $this->getMatchingAction('error', $route, $pathVariable);

            if (!$action) return;
        }

        $this->invoke($route, $action, $pathVariable, ActionException::getInstance($e));
    }

    /**
     * @param $className
     * @param $methodName
     * @return Action|null
     * @throws Exception
     */
    protected function getAction($className, $methodName): ?Action
    {
        if (empty($className)) return null;

        if (empty($methodName)) return null;

        if (!isset($this->actions[$className])) return null;

        $data = $this->actions[$className];

        if (!isset($data[$methodName])) return null;

        $action = $data[$methodName];

        if (empty($action)) return null;

        /** @var Action $action */
        $action = ReflectionUtils::getInstance()->toObject(Action::class, $action);

        return $action;
    }

    /**
     * 获取匹配的action
     * @param $realPath
     * @param Route|null $route
     * @param array $pathVariable
     * @param int $index
     * @return Action|null
     * @throws Exception
     */
    public function getMatchingAction($realPath, ?Route &$route = null, &$pathVariable = [], &$index = 0): ?Action
    {
        if (is_null($index)) $index = 0;

        $routeCount = count($this->routes);

        for (; $index < $routeCount; $index++) {
            if (!isset($this->routes[$index])) return null;

            /** @var Route $route */
            $route = ReflectionUtils::getInstance()->toObject(Route::class, $this->routes[$index]);

            $pattern = $route->getPattern();

            $preg = Verify::getInstance()->preg($pattern) ? preg_match($pattern, $realPath, $pathVariable) : (int)($pattern == $realPath);

            if (is_int($preg) && $preg == 1) {

                $action = $this->getAction($route->getClassName(), $route->getMethodName());

                if ($action != null) return $action;
            }
        }

        return null;
    }

    /**
     * 创建controller
     * @param Classify $classify
     * @param Route $route
     * @param $pathVariable
     * @return object|Controller|WebController
     * @throws Exception
     */
    private function newController(Classify $classify, Route $route, $pathVariable)
    {
        $action = $this->getAction($route->getClassName(), Classify::CONSTRUCTOR_NAME);

        if (!$action) {
            $instance = $classify->newInstance();
        } else {
            $parameters = $this->getParameters($action, $pathVariable);

            $instance = $classify->newInstanceKV($parameters);
        }

        if (!($instance instanceof Controller)) {
            throw new Exception('instance is not controller');
        }

        return $instance;
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
        $data = [];

        $parameters = $action->getParameters();

        foreach ($parameters as $parameter) {

            $name = $parameter->getName();

            if ($parameter->getType() === Action::class) {
                $data[$name] = $action;
            } else if (is_subclass_of($parameter->getType(), Action::class)) {
                $data[$name] = $action;
            } else if ($parameter->getType() === Exception::class) {
                $data[$name] = $exception;
            } else if (is_subclass_of($parameter->getType(), Exception::class)) {
                $data[$name] = $exception;
            } else {
                $data[$name] = $this->getParameterValue($parameter, $pathVariable, $params);
            }
        }

        return $data;
    }

    /**
     * 获取参数值
     * @param ActionParameter $parameter
     * @param $pathVariable
     * @param callable|null $params
     * @return bool|false|mixed|object|string|null
     */
    protected function getParameterValue(ActionParameter $parameter, $pathVariable, callable $params = null)
    {
        $resolveArgument = $this->context->resolveArgument($parameter->getType());

        if ($resolveArgument !== false) return $resolveArgument;

        $source = $parameter->getSource();

        if (substr($source, 0, 1) == '$') {
            $value = Build::getInstance()->getData($pathVariable, substr($source, 1));
        } else if (is_callable($params)) {
            $value = call_user_func($params, $parameter->getName(), $source);
        } else {
            $value = null;
        }

        return ActionConfig::getEncodeValue($parameter->getEncodeType(), $value);
    }

    /**
     * 调用
     * @param Route $route
     * @param Action $action
     * @param $pathVariable
     * @param Exception|null $exception
     * @throws ActionException
     */
    public function invoke(Route $route, Action $action, $pathVariable, ?Exception $exception = null)
    {
        try {
            $classify = Classify::getInstance($route->getClassName());

            $controller = $this->newController($classify, $route, $pathVariable);

            $method = $classify->getMethod($action->getMethodName());

            $parameters = $this->getParameters($action, $pathVariable, null, $exception);

            $result = $method->apply($controller, $parameters);

            $this->onResult($controller, $route, $action, $result);
        } catch (Exception $e) {
            throw ActionException::getInstance($e, $action);
        }
    }

    /**
     * 处理结果
     * @param Controller $controller
     * @param $result
     * @param Route $route
     * @param Action $action
     */
    protected function onResult(Controller $controller, Route $route, Action $action, $result)
    {
        Handler::getInstance()->handler($controller, $result, $route, $action);
    }
}