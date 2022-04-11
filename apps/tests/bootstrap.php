<?php

use apps\file\classier\service\file\LocalFileManagerService;
use apps\file\classier\service\IFileManagerService;
use rapidPHP\modules\application\classier\apps\CGIApplication;
use rapidPHP\modules\configure\classier\Configurator;
use function rapidPHP\DI;

define('ENV_NAME', !empty(get_cfg_var('env.name')) ? get_cfg_var('env.name') : 'dev');

define('PATH_APP', str_replace('\\', '/', __DIR__) . '/');

define('PATH_PUBLIC', PATH_APP);

require dirname(dirname(__DIR__)) . '/vendor/autoload.php' . '';
require dirname(dirname(__DIR__)) . '/vendor/wgx954418992/rapid-framework/src/rapidPHP/init.php' . '';

$app = new CGIApplication(Configurator::getInstance());

$app->getConfig()
    ->setPaths([
        PATH_ROOT . 'apps/core/application.yaml',
        PATH_ROOT . 'apps/core/config/' . ENV_NAME,
        PATH_ROOT . 'apps/app/application.yaml'
    ])
    ->load();

DI([
    IFileManagerService::class => function () {
        return LocalFileManagerService::getInstance();
    },
]);
