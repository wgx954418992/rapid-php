<?php

use rapidPHP\Init;
use rapidPHP\modules\application\classier\apps\SwooleHttpApplication;

define('PATH_APP', str_replace('\\', '/', __DIR__) . '/');

require dirname(dirname(__DIR__)) . '/vendor/autoload.php' . '';

$init = new Init();

$init->parseConfig();

$app = new SwooleHttpApplication($init);

$app->run();