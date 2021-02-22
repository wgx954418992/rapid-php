<?php

namespace apps\openapi\classier\controller;


use apps\admin\classier\context\AdminContext;
use apps\app\classier\context\UserContext as AppUserContext;
use apps\openapi\classier\Action;
use apps\openapi\classier\OpenAPI;
use apps\openapi\classier\Parameter;
use Exception;
use rapidPHP\modules\reflection\classier\Method;
use rapidPHP\modules\router\classier\Mapping;
use rapidPHP\modules\router\classier\Route;

class HomeController extends BaseController
{

    /**
     * MODULES
     */
    const MODULES = [
        'app' => [
            'host' => 'http://localhost/rapid-php/apps/app/',
            'api' => 'api/app.json',
            'description' => 'app - 接口地址',
        ],
        'admin' => [
            'host' => 'http://localhost/rapid-php/apps/admin/',
            'api' => 'api/admin.json',
            'description' => 'admin - 后台接口地址',
        ],
    ];

    /**
     * 首页
     * @route (/|index)
     * @method get
     * @typed view
     * @template index
     * @param $api
     * @return array
     * @throws Exception
     */
    public function index($api)
    {
        return [
            'api' => $api,
            'apis' => self::MODULES
        ];
    }

    /**
     * 获取token 参数
     * @return Parameter
     */
    private function getTokenParameter()
    {
        $parameter = new Parameter();

        $parameter->setName('token');

        $parameter->setType('string');

        $parameter->setIsDefaultValue(false);

        $parameter->setIsAllowNull(false);

        return $parameter;
    }

    /**
     * token 参数拦截器
     * @param Parameter $parameter
     * @return bool
     */
    public function tokenIntercept(Parameter &$parameter): bool
    {
        $parameter = $this->getTokenParameter();

        return false;
    }

    /**
     * api接口
     * @route /api/{module}.json
     * @method get
     * @typed raw
     * @param $module
     * @return array
     * @throws Exception
     */
    public function api($module): array
    {
        if (!isset(self::MODULES[$module])) throw new Exception('module error');

        $moduleOptions = self::MODULES[$module];

        $path = PATH_ROOT . 'apps/' . $module . '/classier/controller/';

        Mapping::getInstance()->scanning($path, $routes, $actions);

        $openAPI = OpenAPI::getInstance();

        $openAPI->setInterceptRoute('account/.*', function (Route &$route, Method &$method, Action &$action) {
            $parameters = $action->getParameters();

            $parameters = array_merge([$this->getTokenParameter()], $parameters);

            $action->setParameters($parameters);

            return false;
        });

        $openAPI->setInterceptParameter(AppUserContext::class, [$this, 'tokenIntercept']);

        $openAPI->setInterceptParameter(AdminContext::class, [$this, 'tokenIntercept']);

        $openAPI->transformation($routes, $paths, $components);

        uksort($paths, function ($a, $b) {
            return strcmp($b, $a);
        });

        return [
            'openapi' => "3.0.0",
            'info' => [
                'title' => $moduleOptions['description'] . ' By RapidPHP - Framework Generate OpenAPI Doc',
                'version' => '1.0.0',
            ],
            'paths' => $paths,
            'components' => ['schemas' => $components],
            'servers' => [
                [
                    'url' => $moduleOptions['host'],
                    'description' => $moduleOptions['description'],
                ]
            ]
        ];
    }
}