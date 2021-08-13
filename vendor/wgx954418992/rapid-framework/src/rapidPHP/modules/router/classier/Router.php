<?php

namespace rapidPHP\modules\router\classier;


use Exception;
use rapidPHP\modules\application\classier\Application;
use rapidPHP\modules\application\classier\apps\ConsoleApplication;
use rapidPHP\modules\application\classier\apps\WebApplication;
use rapidPHP\modules\application\classier\Context;
use rapidPHP\modules\application\classier\context\ConsoleContext;
use rapidPHP\modules\application\classier\context\WebContext;
use rapidPHP\modules\common\classier\Build;
use rapidPHP\modules\common\classier\Instances;
use rapidPHP\modules\common\classier\Verify;
use rapidPHP\modules\common\classier\Variable;
use rapidPHP\modules\core\classier\Controller;
use rapidPHP\modules\exception\classier\ActionException;
use rapidPHP\modules\reflection\classier\Classify;
use rapidPHP\modules\reflection\classier\Method;
use rapidPHP\modules\reflection\classier\Utils as ReflectionUtils;
use rapidPHP\modules\router\classier\action\Parameter as ActionParameter;
use rapidPHP\modules\router\config\ActionConfig;
use ReflectionException;

abstract class Router
{

    /**
     * 采用单例模式
     */
    use Instances;

    /**
     * 实例不存在
     * @return static
     */
    public static function onNotInstance()
    {
        return new static(...func_get_args());
    }

    /**
     * @var Application
     */
    protected $application;

    /**
     * @var Context
     */
    protected $context;

    /**
     * @var array|null
     */
    protected $routes;

    /**
     * @var array|null
     */
    protected $actions;

    /**
     * @return Application|WebApplication|ConsoleApplication
     */
    public function getApplication()
    {
        return $this->application;
    }

    /**
     * @return Context|WebContext|ConsoleContext
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
     * 通过字符串获取规则
     * @param $string
     * @return string
     */
    public static function getPatternByString($string): string
    {
        if (!is_int(strpos($string, '.'))) {
            if (strlen($string) > 1 && substr($string, -1, 1) === '/') {
                $string = rtrim($string, '/*');
            }

            $string .= '(|\.html|\.php)';
        }

        return '/^' . str_replace('/', '\/', $string) . '$/i';
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
     * @param array|null $routes
     * @param array|null $actions
     * @throws Exception
     */
    abstract protected function scanning(?array &$routes = [], ?array &$actions = []);

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
    protected function getAction($className, $methodName)
    {
        if (empty($className)) return null;

        if (empty($methodName)) return null;

        if (!isset($this->actions[$className])) return null;

        $data = $this->actions[$className];

        if (!isset($data[$methodName])) return null;

        $action = $data[$methodName];

        if (empty($action)) return null;

        return ReflectionUtils::getInstance()->toObject(Action::class, $action);
    }

    /**
     * 获取匹配的action
     * @param $realPath
     * @param Route|null $route
     * @param array|null $pathVariable
     * @param int|null $index
     * @return Action|null
     * @throws Exception
     */
    public function getMatchingAction($realPath, ?Route &$route = null, ?array &$pathVariable = [], ?int &$index = 0)
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

                if ($action != null) {
                    $action->setIndex($index);

                    return $action;
                }
            }
        }

        return null;
    }


    /**
     * 实例化对象
     * @param Classify $classify
     * @param $dataPackage
     * @param $pathVariable
     * @param mixed ...$supports
     * @return object
     * @throws ReflectionException
     * @throws Exception
     */
    protected function newInstance(Classify $classify, $dataPackage, $pathVariable, ...$supports)
    {
        $constructor = $classify->getConstructor();

        if (!$constructor) {
            $instance = $classify->newInstance();
        } else {
            $values = $this->getParameterValues($constructor, $dataPackage, $pathVariable, ...$supports);

            $instance = $classify->newInstanceKV($values);
        }

        return $instance;
    }

    /**
     * 创建controller
     * @param Classify $classify
     * @param Route $route
     * @param $pathVariable
     * @return Controller
     * @throws Exception
     */
    private function newController(Classify $classify, Route $route, $pathVariable)
    {
        $action = $this->getAction($route->getClassName(), Classify::CONSTRUCTOR_NAME);

        if (!$action) {
            $instance = $classify->newInstance();
        } else {

            $parameters = $this->getParameters($action, $action->getParameters(), $pathVariable);

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
     * @param ActionParameter[] $parameters
     * @param $pathVariable
     * @param Exception|null $exception
     * @return array
     * @throws Exception
     */
    protected function getParameters(Action $action, array $parameters, $pathVariable, ?Exception $exception = null): array
    {
        $data = [];

        foreach ($parameters as $parameter) {

            $name = $parameter->getName();

            $data[$name] = $this->getParameterValue($parameter->getName(), $parameter->getSource(), $parameter->getType(), $parameter->getRemark(), null, $pathVariable, [
                Action::class => $action,
                Exception::class => $exception,
            ]);
        }

        return $data;
    }

    /**
     * 获取参数值
     * @param $name
     * @param $source
     * @param $type
     * @param $remark
     * @param $dataPackage
     * @param $pathVariable
     * @param mixed ...$supports
     * @return bool|false|mixed|object|string|null
     * @throws ReflectionException
     * @throws Exception
     */
    protected function getParameterValue($name, $source, $type, $remark, $dataPackage, $pathVariable, ...$supports)
    {
        $resolveArgument = $this->context->resolveArgument($type, ...$supports);

        if ($resolveArgument !== false) return $resolveArgument;

        $encodeType = ActionConfig::getEncodeType($remark);

        if (substr($source, 0, 1) == '$') {
            $value = Build::getInstance()->getData($pathVariable, substr($source, 1));

            return ActionConfig::getDecodeValue($encodeType, $value);
        } else if (isset($dataPackage[$name])) {
            $value = $dataPackage[$name];

            return ActionConfig::getDecodeValue($encodeType, $value);
        }

        $value = $this->onGetParameterValue($name, $source);

        if (empty($type) || Variable::isSetType($type)) {
            return ActionConfig::getDecodeValue($encodeType, $value);
        }

        $encodeType = Build::getInstance()->contrast($encodeType, ActionConfig::ENCODE_TYPE_JSON);

        $value = ActionConfig::getDecodeValue($encodeType, $this->onGetParameterValue($name, $source));

        $classify = Classify::getInstance($type);

        $object = $this->newInstance($classify, $value, $pathVariable, ...$supports);

        $methods = $classify->getSetterMethods();

        foreach ($methods as $method) {
            $method->apply($object, $this->getParameterValues($method, $value, $pathVariable, ...$supports));
        }

        return $object;
    }

    /**
     * 获取参数value list
     * @param Method $method
     * @param $dataPackage
     * @param $pathVariable
     * @param mixed ...$supports
     * @return array
     * @throws ReflectionException
     * @throws Exception
     */
    protected function getParameterValues(Method $method, $dataPackage, $pathVariable, ...$supports): array
    {
        $values = [];

        $parameters = $method->getParameters();

        foreach ($parameters as $parameter) {
            $name = $parameter->getName();

            $annotation = $parameter->getAnnotation();

            $source = $annotation ? $annotation->getSource() : null;

            $remark = $annotation ? $annotation->getRemark() : null;

            $values[$name] = $this->getParameterValue($name, $source, $parameter->getType(), $remark, $dataPackage, $pathVariable, ...$supports);
        }

        return $values;
    }


    /**
     * 获取参数value
     * @param $name
     * @param $source
     * @return mixed
     */
    abstract protected function onGetParameterValue($name, $source);

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

            $parameters = $this->getParameters($action, $action->getParameters(), $pathVariable, $exception);

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
    abstract public function onResult(Controller $controller, Route $route, Action $action, $result);
}
