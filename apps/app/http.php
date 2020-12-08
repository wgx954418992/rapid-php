<?php

use rapidPHP\modules\application\classier\apps\SwooleHttpApplication;

define('PATH_APP', str_replace('\\', '/', __DIR__) . '/');

require dirname(dirname(__DIR__)) . '/vendor/autoload.php' . '';

Init::load();

$app = new SwooleHttpApplication();

$app->run();