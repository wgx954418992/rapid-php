<?php

use application\server\RunSWebSocketServer;
use application\task\UnifiedDispatchTask;

require 'rapidPHP/init.php';

if (APP_RUNNING_SAPI_NAME != 'cli') exit();

/** 定义当前是websocket运行 */
define('SWOOLE_WEBSOCKET_SERVER', true);

/** 定义websocket回调块 */
define('WEBSOCKET_RETURN_KEY', '__c');

try {
    RunSWebSocketServer::getInstance()
        ->setTaskInterface(UnifiedDispatchTask::class)
        ->setPort(9502)
        ->create()
        ->start();
} catch (ReflectionException $e) {
    exit($e->getMessage());
}