<?php

namespace rapidPHP\modules\router\classier\router;


use Exception;
use rapidPHP\modules\application\classier\Application;
use rapidPHP\modules\application\classier\apps\ConsoleApplication;
use rapidPHP\modules\application\classier\Context;
use rapidPHP\modules\application\classier\context\ConsoleContext;
use rapidPHP\modules\common\classier\Build;
use rapidPHP\modules\console\classier\Input;
use rapidPHP\modules\console\classier\Output;
use rapidPHP\modules\core\classier\Controller;
use rapidPHP\modules\exception\classier\InvalidArgumentException;
use rapidPHP\modules\router\classier\Action;
use rapidPHP\modules\router\classier\Handler;
use rapidPHP\modules\router\classier\Mapping;
use rapidPHP\modules\router\classier\Route;
use rapidPHP\modules\router\classier\Router;

class ConsoleRouter extends Router
{

    /**
     * @var Input
     */
    protected $input;

    /**
     * @var Output
     */
    protected $output;

    /**
     * @return ConsoleApplication
     */
    public function getApplication()
    {
        return parent::getApplication();
    }

    /**
     * @return ConsoleContext
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
        if (!($application instanceof ConsoleApplication)) {
            throw new InvalidArgumentException('application is not ConsoleApplication');
        }

        if (!($context instanceof ConsoleContext)) {
            throw new InvalidArgumentException('context is not ConsoleContext');
        }

        $this->input = $context->getInput();

        $this->output = $context->getOutput();

        $context->supportsParameter([
            ConsoleApplication::class => $application,
            ConsoleRouter::class => $this
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
        $paths = $this->getApplication()->getConfigWrapper()->getApplication()->getScans()->getController();

        $routes = [];

        $actions = [];

        Mapping::getInstance()->scanning($paths, $routes, $actions);

        Mapping::getInstance()->save($routes, $actions);
    }

    /**
     * 获取真实访问路径
     */
    protected function getRealPath(): string
    {
        $data = $this->input->getArgs()->getArgs();

        $path = ltrim(Build::getInstance()->getData($data, 0), '/*');

        return $path ? $path : '/';
    }

    /**
     * 匹配路由
     * @throws Exception
     */
    protected function matching()
    {
        try {
            $realPath = $this->getRealPath();

            $this->getContext()->onMatchingBefore($this);

            $action = $this->getMatchingAction($realPath, $route, $pathVariable, $index);

            if (!$action) throw new Exception('Not match action', 404);

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
     * @return array|string|null
     * @throws Exception
     */
    protected function onGetParameterValue($name, $source)
    {
        if ($source == 'args') {
            return $this->input->getArgsValue($name);
        } else {
            return $this->input->getOptionValue($name);
        }
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

        $service = Handler::getInstance()->getService($result, $action->getTyped());

        $result = Handler::getInstance()->handler($controller, $service, $result);

        if ($result === null) return;

        $result = Handler::getInstance()->encode($result, $action->getEncode());

        if ($result === null) return;

        $this->output->write($result);
    }

}
