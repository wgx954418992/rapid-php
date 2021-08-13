<?php
use rapidPHP\modules\application\classier\apps\SwooleWebsocketApplication;
use rapidPHP\modules\configure\classier\Configurator;

define('PATH_APP', str_replace('\\', '/', dirname(__DIR__)) . '/');

define('PATH_PUBLIC', PATH_APP . 'public/');

require dirname(dirname(dirname(__DIR__))) . '/vendor/autoload.php' . '';
require dirname(dirname(dirname(__DIR__))) . '/vendor/wgx954418992/rapid-framework/src/rapidPHP/init.php' . '';

Configurator::getInstance()
    ->setPaths([
        PATH_ROOT . 'apps/core/application.yaml',
        PATH_APP . 'application.yaml'
    ])
    ->load();

$app = new SwooleWebsocketApplication(Configurator::getInstance());

$app->run();
