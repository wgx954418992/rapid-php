<?php

use application\server\RunSWebSocketServer;

require 'rapidPHP/init.php';

if (APP_RUNNING_SAPI_NAME != 'cli') exit();

define('SWOOLE_WEBSOCKET_SERVER', true);

RunSWebSocketServer::getInstance()->create()->start();
