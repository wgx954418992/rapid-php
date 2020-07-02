<?php

use application\server\RunSHttpServer;

require 'rapidPHP/init.php';

if (APP_RUNNING_SAPI_NAME != 'cli') exit();

define('SWOOLE_HTTP_SERVER', true);

RunSHttpServer::getInstance()->create()->start();

exit();