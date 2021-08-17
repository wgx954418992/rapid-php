<?php


namespace apps\openapi\classier\openapi;


use Exception;
use rapidPHP\modules\application\classier\Context;
use rapidPHP\modules\common\classier\Instances;
use rapidPHP\modules\common\classier\Variable;
use rapidPHP\modules\common\classier\Verify;
use rapidPHP\modules\reflection\classier\Classify;
use rapidPHP\modules\reflection\classier\Method;
use rapidPHP\modules\reflection\classier\Utils as RUtils;
use rapidPHP\modules\router\classier\Route;
use rapidPHP\modules\router\classier\Router;
use rapidPHP\modules\router\config\ActionConfig;
use rapidPHP\modules\server\config\HttpConfig;
use function rapidPHP\AR;
use function rapidPHP\B;
use function rapidPHP\Str;

class OpenAPI
{

    /**
     * 单例模式
     */
    use Instances;

    /**
     * on not instance
     * @return static
     */
    public static function onNotInstance()
    {
        return new static();
    }

    /**
     * @var string[]|string
     */
    private $acceptTyped = ['auto', 'api', ''];

    /**
     * @var string[]
     */
    const REQUEST_PARAM_TYPE = [
        HttpConfig::PARAM_GET => 'query',
        HttpConfig::PARAM_POST => 'body',
        HttpConfig::PARAM_PUT => 'body',
        HttpConfig::PARAM_COOKIE => 'cookie',
        HttpConfig::PARAM_SESSION => 'cookie',
        HttpConfig::PARAM_FILE => 'file',
    ];

    /**
     * @var string[]
     */
    const SET_VAR_DEFAULT_TYPE = [
        Variable::INTEGER => 'integer',
        Variable::INT => 'integer',
        Variable::FLOAT => 'integer',
        Variable::DOUBLE => 'integer',
        Variable::STRING => 'string',
        Variable::ARRAY => 'array',
        Variable::OBJECT => 'object',
        Variable::BOOLEAN => 'boolean',
        Variable::BOOL => 'boolean',
    ];


    /**
     * route 拦截
     * @var string[]
     */
    private $interceptRoute = [];

    /**
     * 拦截参数
     * @var string[]
     */
    private $interceptParameter = [
        Exception::class => true,
        Context::class => true,
    ];

    /**
     * @return string[]|string
     */
    public function getAcceptTyped()
    {
        return $this->acceptTyped;
    }

    /**
     * @param string[]|string $acceptTyped
     */
    public function setAcceptTyped($acceptTyped): void
    {
        $this->acceptTyped = $acceptTyped;
    }

    /**
     * @return string[]
     */
    public function getInterceptRoute(): array
    {
        return $this->interceptRoute;
    }

    /**
     * @param string|string[] $route
     * @param callable|bool $callable
     */
    public function setInterceptRoute($route, $callable = true): void
    {
        if (!is_array($route)) $route = [$route => $callable];

        $this->interceptRoute = array_merge($this->interceptRoute, $route);
    }

    /**
     * 是否拦截路由
     * @param Route $route
     * @param Method $method
     * @param Action $action
     * @return bool
     */
    private function isInterceptRoute(Route &$route, Method &$method, Action &$action): bool
    {
        $subject = $route->getRoute();

        foreach ($this->interceptRoute as $value => $callable) {
            $pattern = Router::getPatternByString($value);

            $preg = Verify::getInstance()->preg($pattern) ? preg_match($pattern, $subject) : (int)($pattern == $subject);

            if (is_int($preg) && $preg == 1) {
                return !is_callable($callable) ? $callable : call_user_func_array($callable, [&$route, &$method, &$action]);
            }
        }

        return false;
    }

    /**
     * @return string[]
     */
    public function getInterceptParameter(): array
    {
        return $this->interceptParameter;
    }

    /**
     * @param string|string[] $parameter
     * @param callable|bool $callable
     */
    public function setInterceptParameter($parameter, $callable = true): void
    {
        if (!is_array($parameter)) $parameter = [$parameter => $callable];

        $this->interceptParameter = array_merge($this->interceptParameter, $parameter);
    }

    /**
     * 是否拦截参数
     * @param Parameter $parameter
     * @return bool
     */
    private function isInterceptParameter(Parameter &$parameter): bool
    {
        $parameterType = ltrim($parameter->getType(), '\\');

        foreach ($this->interceptParameter as $support => $callable) {
            $support = ltrim($support, '\\');

            if ($support === $parameterType) {
                return !is_callable($callable) ? $callable : call_user_func_array($callable, [&$parameter]);
            } else if (is_subclass_of($support, $parameterType)) {
                return !is_callable($callable) ? $callable : call_user_func_array($callable, [&$parameter]);
            }
        }

        return false;
    }


    /**
     * 获取备注
     * @param $doc
     * @return string
     */
    private function getDocRemark($doc): string
    {
        if (empty($doc)) return '';

        return trim(B()->getRegular('/\/\*\*\n.*\*(.*)/i', $doc));
    }

    /**
     * 转换
     * @param array $routes
     * @param array|null $paths
     * @param array|null $components
     * @throws Exception
     */
    public function transformation(array $routes, ?array &$paths = [], ?array &$components = [])
    {
        $classGroup = AR()->arrayColumn($routes, 'className');

        foreach ($classGroup as $className => $group) {

            try {
                $classify = Classify::getInstance($className);

                foreach ($group as $route) {

                    /** @var Route $route */
                    $route = RUtils::getInstance()->toObject(Route::class, $route);

                    if (empty($route->getRoute())) continue;

                    $method = $classify->getMethod($route->getMethodName());

                    $action = new Action($route, $method);

                    if ($this->isInterceptRoute($route, $method, $action)) continue;

                    if ($this->acceptTyped != '*' && in_array($action->getTyped(), $this->acceptTyped) === false) {
                        continue;
                    }

                    $parameters = $this->getParameters($action, $components);

                    $paths[$action->getRoute()][$action->getRequestMethod()] = array_merge([

                        'summary' => $this->getDocRemark($method->getDocComment()->getDoc()),

                        'responses' => [200 => ['description' => 'success']]

                    ], $parameters);
                }
            } catch (Exception $e) {
                continue;
            }
        }
    }

    /**
     * 获取参数
     * @param Action $action
     * @param $components
     * @return array
     * @throws Exception
     */
    private function getParameters(Action $action, &$components): array
    {
        $parameters = $action->getParameters();

        if (empty($parameters)) return [];

        $bodyList = [
            'schema' => [
                'properties' => [],
                'required' => [],
            ]
        ];

        $fileList = [
            'schema' => [
                'type' => 'object',
                'properties' => []
            ]
        ];

        $paramsList = [];

        foreach ($parameters as $parameter) {
            if ($this->isInterceptParameter($parameter)) continue;

            $name = $parameter->getName();

            $type = $this->getParameterType($parameter, $components);

            $source = $this->getParameterSource($action, $parameter);

            $required = !($parameter->isAllowNull() || $parameter->isDefaultValue());

            if ($source == 'body') {
                $bodyList['schema']['properties'][$name] = $type;

                if (!$required) continue;

                $bodyList['schema']['required'][] = $name;
            } else if ($source == 'file') {
                $fileList['schema']['properties'][$name] = [
                    'type' => 'string',
                    'format' => 'binary'
                ];

                if (!$required) continue;

                $fileList['schema']['required'][] = $name;
            } else {
                $paramsList[] = [
                    'name' => $name,
                    'required' => $required,
                    'in' => $source,
                    'schema' => $type,
                ];
            }
        }

        $result = [];

        if (!empty($paramsList)) {
            $result['parameters'] = $paramsList;
        }

        if (!empty($bodyList['schema']['properties'])) {
            $result['requestBody'] = [
                'content' => ['application/x-www-form-urlencoded' => $bodyList]
            ];
        }
        if (!empty($fileList['schema']['properties'])) {
            $result['requestBody'] = [
                'content' => ['multipart/form-data' => $fileList]
            ];
        }

        return $result;
    }


    /**
     * 获取参数来源
     * @param Action $action
     * @param Parameter $parameter
     * @return array|int|mixed|object|string|null
     * @throws Exception
     */
    private function getParameterSource(Action $action, Parameter $parameter)
    {
        if (preg_match('/{' . $parameter->getName() . '}/i', $action->getRoute()) > 0) return 'path';

        $source = $parameter->getSource();

        if (empty($source)) $source = $action->getRequestMethod();

        return B()->getData(self::REQUEST_PARAM_TYPE, strtoupper($source));
    }

    /**
     * 获取参数类型
     * @param Parameter $parameter
     * @param $components
     * @return array
     * @throws Exception
     */
    private function getParameterType(Parameter $parameter, &$components): array
    {
        $parameterType = $parameter->getType();

        if (empty($parameterType)) $parameterType = 'string';

        $encodeType = ActionConfig::getEncodeType($parameter->getRemark());

        switch (strtolower($encodeType)) {
            case ActionConfig::ENCODE_TYPE_XML:
            case ActionConfig::ENCODE_TYPE_JSON:
                $convertType = 'array';
                break;
            default:
                $convertType = B()->getData(self::SET_VAR_DEFAULT_TYPE, $parameterType);
                break;
        }

        if (!empty($convertType)) {

            $result = ['type' => $convertType];

            switch ($convertType) {
                case 'array':
                    $result['items'] = ['type' => 'string'];
                    break;
            }

            return $result;
        }

        $refName = Str()->toFirstUppercase($parameterType, '\\');

        $this->getComponents($parameterType, $refName, $components);

        return ['$ref' => '#/components/schemas/' . $refName];
    }


    /**
     * 获取组件
     * @param $className
     * @param $refName
     * @param $components
     * @throws Exception
     */
    private function getComponents($className, $refName, &$components)
    {
        try {
            $classify = Classify::getInstance($className);
        } catch (Exception $e) {
            $classify = null;
        }

        if (is_null($classify)) return;

        $properties = [];

        $component = [
            'type' => 'object',
            'properties' => &$properties,
        ];

        $components[$refName] = &$component;

        $methods = $classify->getSetterMethods();

        foreach ($methods as $method) {

            $parameters = Utils::getInstance()->getParameters($method);

            foreach ($parameters as $name => $parameter) {

                $type = $this->getParameterType($parameter, $components);

                $properties[$name] = $type;
            }
        }
    }

}
