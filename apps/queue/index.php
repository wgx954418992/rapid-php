<?php

use rapidPHP\Init;
use rapidPHP\modules\application\classier\apps\ConsoleApplication;

define('PATH_APP', str_replace('\\', '/', __DIR__) . '/');

require dirname(dirname(__DIR__)) . '/vendor/autoload.php' . '';

$init = new Init([
    PATH_ROOT . 'apps/core/application.yaml'
]);

$init->parseConfig();

$app = new ConsoleApplication($init);

$app->run();