<?php

use rapidPHP\Init;
use rapidPHP\modules\application\classier\apps\CGIApplication;

define('PATH_APP', str_replace('\\', '/', __DIR__) . '/');

require dirname(dirname(__DIR__)) . '/vendor/autoload.php' . '';

Init::load();

$app = new CGIApplication();

$app->run();