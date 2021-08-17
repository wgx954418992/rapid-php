<?php

use rapidPHP\modules\application\classier\apps\ConsoleApplication;
use rapidPHP\modules\configure\classier\Configurator;

define('EVN_NAME', empty(get_cfg_var('env.name')) ? get_cfg_var('env.name') : 'dev');

define('PATH_APP', str_replace('\\', '/', __DIR__) . '/');

define('PATH_PUBLIC', PATH_APP);

require dirname(dirname(__DIR__)) . '/vendor/autoload.php' . '';

require dirname(dirname(__DIR__)) . '/vendor/wgx954418992/rapid-framework/src/rapidPHP/init.php' . '';

$app = new ConsoleApplication(Configurator::getInstance());

$app->getConfig()
    ->setPaths([
        PATH_ROOT . 'apps/core/application.yaml',
        PATH_ROOT . 'apps/core/config/' . EVN_NAME,
        PATH_APP . 'application.yaml'
    ])
    ->load();

$app->run();
