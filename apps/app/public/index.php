<?php

use rapidPHP\modules\application\classier\apps\CGIApplication;
use rapidPHP\modules\config\classier\PConfig;

define('PATH_APP', str_replace('\\', '/', dirname(__DIR__)) . '/');

const PATH_PUBLIC = PATH_APP . 'public/';

require dirname(dirname(dirname(__DIR__))) . '/vendor/autoload.php' . '';
require dirname(dirname(dirname(__DIR__))) . '/vendor/wgx954418992/rapid-framework/src/rapidPHP/init.php' . '';

PConfig::getInstance()
    ->setPaths([
        PATH_ROOT . 'apps/core/application.yaml',
        PATH_APP . 'application.yaml'
    ]);

PConfig::getInstance()->load();

var_dump(PConfig::getInstance()->getConfig());

$app = new CGIApplication(PConfig::getInstance());

$app->run();
