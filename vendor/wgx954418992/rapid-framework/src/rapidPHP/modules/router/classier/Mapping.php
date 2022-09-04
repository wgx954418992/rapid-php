<?php

namespace rapidPHP\modules\router\classier;

use Exception;
use rapidPHP\modules\common\classier\Build;
use rapidPHP\modules\common\classier\File;
use rapidPHP\modules\common\classier\Instances;
use rapidPHP\modules\reflection\classier\Classify;
use rapidPHP\modules\reflection\classier\Method;
use rapidPHP\modules\reflection\classier\Utils as ReflectionUtils;
use rapidPHP\modules\router\classier\action\Parameter as ActionParameter;
use rapidPHP\modules\router\classier\action\Property as ActionProperty;
use rapidPHP\modules\router\classier\action\Returned as ActionReturned;
use rapidPHP\modules\reflection\classier\annotation\Returned as ReturnedAnnotation;
use rapidPHP\modules\router\classier\reflection\DocComment;
use ReflectionMethod;

class Mapping
{

    /**
     * 保存的路径 根据定义不同的path_app来生成不同的保存路径
     */
    const WRITE_PATH = PATH_APP . 'runtime/router/';

    /**
     * routes 文件路径
     * 为何要单独列出routes 是因为匹配方式如果可以多个的话
     * a 方法 /home/{type}/get
     * b 方法 /home/1/get
     * 我现在正常访问 /home/1/get 却先匹配到了 a 方法，而不是 b 方法
     * 因为没有排序优先级，所以导致访问拦截错误
     * 所以定义routes是按照 pathVariable 的数量 从小到大排列，以此解决优先级问题
     */
    const ROUTES_FILE_PATH = self::WRITE_PATH . 'routes.json';

    /**
     * actions文件路径
     */
    const ACTIONS_FILE_PATH = self::WRITE_PATH . 'actions.json';


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
        return new static();
    }

    /**
     * 开始扫描编译
     * @param $paths
     * @param array|null $routes
     * @param array|null $actions
     * @throws Exception
     */
    public function scanning($paths, ?array &$routes = [], ?array &$actions = [])
    {
        if (empty($paths)) return;

        if (!is_array($paths)) $paths = (array)$paths;

        if (!is_array($routes)) $routes = (array)$routes;

        if (!is_array($actions)) $actions = (array)$actions;

        foreach ($paths as $path) {
            $read = File::getInstance()->readDirFiles($path, File::OPTIONS_SUBDIRECTORY);

            foreach ($read as $file) {
                $className = ReflectionUtils::getInstance()->getClassFullNameByFile($file);

                $classify = Classify::getInstance($className);

                $this->compileMapping($classify, $routes, $actions);
            }
        }

        $this->sortRoutes($routes);
    }

    /**
     * 排序routes
     * 为何要单独列出route 是因为匹配方式如果可以多个的话
     * a 方法 /home/{type}/get
     * b 方法 /home/1/get
     * 我现在正常访问 /home/1/get 却先匹配到了 a 方法，而不是 b 方法
     * 因为没有排序优先级，所以导致访问拦截错误
     * 所以定义routes是按照 pathVariable 的数量 从小到大排列，以此解决优先级问题
     * @param $routes
     */
    protected function sortRoutes(&$routes)
    {
        if (!is_array($routes)) return;

        usort($routes, function ($a, $b) {
            $aVariableCount = preg_match('/{\w+}/i', $a['route']);

            $bVariableCount = preg_match('/{\w+}/i', $b['route']);

            return $aVariableCount - $bVariableCount;
        });
    }

    /**
     * 编译映射
     * @param Classify $classify
     * @param array $routes
     * @param array $actions
     * @return void
     * @throws Exception
     */
    protected function compileMapping(Classify $classify, array &$routes = [], array &$actions = [])
    {
        /** @var DocComment $classComment */
        $classComment = $classify->getDocComment(DocComment::class);

        $classRoute = $this->getRouteAnnotationValue($classComment);

        $methods = $classify->getMethods(ReflectionMethod::IS_PUBLIC);

        foreach ($methods as $method) {
            $methodClassify = $method->getDeclaringClass();

            $methodClassName = $methodClassify->getName();

            if ($methodClassName !== $classify->getName() && $classify->hasMethodInCurrent($method->getName())) {
                continue;
            }

            $action = new Action();

            /** @var DocComment $methodComment */
            $methodComment = $method->getDocComment(DocComment::class);

            $methodRoute = $this->getRouteAnnotationValue($methodComment);

            if (empty($methodRoute) && !$method->isConstructor()) continue;

            $realRoute = $classRoute . $methodRoute;

            if (strlen($realRoute) > 1) $realRoute = ltrim($realRoute, '/*');

            $action->setRoute($realRoute);

            $action->setMethodName($method->getName());

            $action->setMethod($methodComment->getMethodAnnotation());

            $action->setTyped($methodComment->getTypedAnnotation());

            $action->setTemplate($methodComment->getTemplateAnnotation());

            $action->setHeader($methodComment->getHeadersArray());

            $action->setEncode($methodComment->getEncodeAnnotation());

            $action->setReturned($this->getActionReturned($methodComment->getReturnedAnnotation(), $methodClassify));

            $parameters = $this->getActionParameters($method);

            $route = $this->getRoute($classify->getName(), $method->getName(), $realRoute, $parameters);

            $action->setParameters($parameters);

            $actions[$classify->getName()][$method->getName()] = $action->toArray();

            if ($method->isConstructor() || !$route) continue;

            $routes[] = $route->toArray();
        }
    }

    /**
     * 获取route注解值
     * @param DocComment $comment
     * @return string|null
     * @throws Exception
     */
    protected function getRouteAnnotationValue(DocComment $comment): ?string
    {
        $annotation = $comment->getRouteAnnotation();

        if (!$annotation) return null;

        return $annotation->getValue();
    }

    /**
     * 获取action 参数
     * @param Method $method
     * @return array
     * @throws Exception
     */
    protected function getActionParameters(Method $method): array
    {
        $result = [];

        $parameters = $method->getParameters();

        foreach ($parameters as $parameter) {
            $name = $parameter->getName();

            $type = $parameter->getType();

            $actionParameter = new ActionParameter();

            $actionParameter->setName($name);

            $actionParameter->setType($type);

            $parameterAnnotation = $parameter->getAnnotation();

            if ($parameterAnnotation != null) {
                $actionParameter->setSource($parameterAnnotation->getSource());

                $actionParameter->setRemark($parameterAnnotation->getRemark());
            }

            $result[$name] = $actionParameter;
        }

        return $result;
    }

    /**
     * 获取action returned
     * @param ReturnedAnnotation|null $returnAnnotation
     * @param Classify|null $classify
     * @return ActionReturned|null
     * @throws Exception
     */
    protected function getActionReturned(?ReturnedAnnotation $returnAnnotation, ?Classify $classify)
    {
        if (!$returnAnnotation) return null;

        $type = $returnAnnotation->getReturnedType($classify);

        $properties = $returnAnnotation->getReturnedProperties($type);

        $propertiesArray = [];

        if (is_array($properties) && $properties) {
            foreach ($properties as $property) {
                $propertiesArray[] = new ActionProperty($property->getName(), $property->getType());
            }
        }

        return new ActionReturned($type, $propertiesArray);
    }

    /**
     * 获取route 并且set 参数的source
     * @param $className
     * @param $methodName
     * @param $route
     * @param ActionParameter[]|null $parameters
     * @return Route
     */
    protected function getRoute($className, $methodName, $route, ?array &$parameters)
    {
        $index = 1;

        $pattern = Router::getPatternByString($route);

        $pathVariables = (array)Build::getInstance()->getRegularAll('/{(\w+)}/i', $pattern, 1);

        foreach ($pathVariables as $name) {
            if (!isset($parameters[$name])) continue;

            $parameter = &$parameters[$name];

            if ($parameter instanceof ActionParameter) {
                $parameter->setSource('$' . $index);
            }

            $pattern = str_replace('{' . $name . '}', '(\w+)', $pattern);

            $index++;
        }

        return new Route($route, $pattern, $className, $methodName);
    }


    /**
     * 读取
     * @param $routes
     * @param $actions
     */
    public function read(&$routes = null, &$actions = null)
    {
        if (is_file(self::ROUTES_FILE_PATH)) {
            $routes = Build::getInstance()->jsonDecode(file_get_contents(self::ROUTES_FILE_PATH));
        }

        if (is_file(self::ACTIONS_FILE_PATH)) {
            $actions = Build::getInstance()->jsonDecode(file_get_contents(self::ACTIONS_FILE_PATH));
        }
    }

    /**
     * 保存
     * @param array $routes
     * @param array $actions
     * @throws Exception
     */
    public function save(array $routes, array $actions)
    {
        if (!is_null($routes)) {
            $lastTime = filemtime(self::ROUTES_FILE_PATH);

            if (!(is_int($lastTime) && $lastTime + 1 > time())) {
                $this->write(self::ROUTES_FILE_PATH, json_encode($routes));
            }
        }

        if (!is_null($actions)) {
            $lastTime = filemtime(self::ACTIONS_FILE_PATH);

            if (!(is_int($lastTime) && $lastTime + 1 > time())) {
                $this->write(self::ACTIONS_FILE_PATH, json_encode($actions));
            }
        }
    }

    /**
     * 写到文件
     * @param $filePath :路径
     * @param $content :内容
     * @throws Exception 写出失败，抛出异常
     */
    protected function write($filePath, $content)
    {
        $dir = dirname($filePath);

        if (!is_dir($dir) && !mkdir($dir, 0777, true)) throw new Exception($dir . '目录创建失败');

        if (!file_put_contents($filePath, $content)) {
            $msg = '写出配置文件失败，请检查' . $filePath . '是否有写入权限';

            throw new Exception($msg);
        }
    }
}
