<?php

use rapidPHP\modules\application\classier\apps\SwooleWebsocketApplication;

define('PATH_APP', str_replace('\\', '/', __DIR__) . '/');

require dirname(dirname(__DIR__)) . '/vendor/autoload.php' . '';

Init::load();

$app = new SwooleWebsocketApplication();

$app->run();