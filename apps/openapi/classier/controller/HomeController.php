<?php

namespace apps\openapi\classier\controller;


use apps\app\classier\context\UserContext as AppUserContext;
use apps\file\classier\context\UserContext as FileUserContext;
use apps\openapi\classier\config\ExportConfig;
use apps\openapi\classier\openapi\Action;
use apps\openapi\classier\openapi\OpenAPI;
use apps\openapi\classier\openapi\Parameter;
use Exception;
use rapidPHP\modules\application\classier\Application;
use rapidPHP\modules\application\classier\context\WebContext;
use rapidPHP\modules\common\classier\File;
use rapidPHP\modules\reflection\classier\Method;
use rapidPHP\modules\router\classier\Mapping;
use rapidPHP\modules\router\classier\Route;
use ZipArchive;

class HomeController extends BaseController
{

    /**
     * modules
     */
    protected $modules = [];

    /**
     * HomeController constructor.
     * @param WebContext $context
     */
    public function __construct(WebContext $context)
    {
        parent::__construct($context);

        $this->modules = [
            'app' => [
                'host' => Application::getInstance()->getConfig()->getValue('host.app'),
                'api' => 'api/app.json',
                'description' => 'app - api地址',
            ],
            'file' => [
                'host' => Application::getInstance()->getConfig()->getValue('host.file'),
                'api' => 'api/file.json',
                'description' => 'file - 文件地址',
            ],
        ];
    }

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
            'apis' => $this->modules
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
        if (!isset($this->modules[$module])) throw new Exception('module error');

        $options = $this->modules[$module];

        $path = PATH_ROOT . 'apps/' . $module . '/classier/controller/';

        Mapping::getInstance()->scanning($path, $routes, $actions);

        $openAPI = OpenAPI::getInstance();

        $openAPI->setAcceptTyped('*');

        $openAPI->setInterceptRoute('error.*', function (Route &$route, Method &$method, Action &$action) {
            return true;
        });

        $openAPI->setInterceptRoute('account/.*', function (Route &$route, Method &$method, Action &$action) {
            $parameters = $action->getParameters();

            $parameters = array_merge([$this->getTokenParameter()], $parameters);

            $action->setParameters($parameters);

            return false;
        });

        $openAPI->setInterceptParameter(AppUserContext::class, [$this, 'tokenIntercept']);

        $openAPI->setInterceptParameter(FileUserContext::class, [$this, 'tokenIntercept']);

        $openAPI->transformation($routes, $paths, $components);

        uksort($paths, function ($a, $b) {
            return strcmp($b, $a);
        });

        return [
            'openapi' => "3.0.0",
            'info' => [
                'title' => $options['description'] . ' By RapidPHP - Framework Generate OpenAPI Doc',
                'version' => '1.0.0',
            ],
            'paths' => $paths,
            'components' => ['schemas' => $components],
            'servers' => [
                [
                    'url' => $options['host'],
                    'description' => $options['description'],
                ]
            ]
        ];
    }

    /**
     * 导出 android code
     * @route /export/{module}/android
     * @method get
     * @typed raw
     * @param $module
     * @param array $options get json
     * @throws Exception
     */
    public function exportByAndroid($module, array $options)
    {
        $bin = PATH_APP . 'bin/';

        $clientPath = $bin . $module . '_client';

        $outZipFile = $clientPath . '.zip';

        $configFilepath = $bin . 'config.json';

        $apiFilepath = $bin . $module . '_api.json';

        file_put_contents($apiFilepath, json_encode($this->api($module)));

        file_put_contents($configFilepath, json_encode(ExportConfig::getAndroidConfig($options)));

        $command = "java -jar {$bin}/swagger-codegen-cli.jar generate -i {$apiFilepath} -l java -c {$configFilepath} -o {$clientPath}";

        system($command, $resultCode);

        unlink($apiFilepath);

        unlink($configFilepath);

        if ($resultCode !== 0) throw new Exception('导出失败！');

        $zip = new ZipArchive();

        if (!$zip->open($outZipFile, ZipArchive::CREATE)) throw new Exception('open zip error!');

        $files = File::getInstance()->readDirFiles($clientPath, false, true);

        foreach ($files as $file) {
            $zip->addFile($file, str_replace($clientPath, '', $file));
        }

        $zip->close();

        File::getInstance()->rmdir($clientPath);

        $this->getResponse()->header('Content-Type: application/octet-stream');

        $this->getResponse()->sendFile($outZipFile);

        unlink($outZipFile);
    }
}
