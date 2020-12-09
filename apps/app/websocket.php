<?php

use rapidPHP\Init;
use rapidPHP\modules\application\classier\apps\SwooleWebsocketApplication;

define('PATH_APP', str_replace('\\', '/', __DIR__) . '/');

require dirname(dirname(__DIR__)) . '/vendor/autoload.php' . '';

$init = new Init();

$init->parseConfig();

$app = new SwooleWebsocketApplication($init);

$app->run();