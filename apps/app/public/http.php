<?php

use rapidPHP\Init;
use rapidPHP\modules\application\classier\apps\SwooleHttpApplication;
use rapidPHP\modules\config\classier\PConfig;

define('PATH_APP', str_replace('\\', '/', __DIR__) . '/');

require dirname(dirname(__DIR__)) . '/vendor/autoload.php' . '';

PConfig::getInstance()
    ->setPaths([
        PATH_ROOT . 'apps/core/application.yaml',
        PATH_APP . 'application.yaml'
    ]);

$init = new Init(PConfig::getInstance());

$init->parseConfig();

$app = new SwooleHttpApplication($init);

$app->run();
