<?php

use application\server\RunSHttpServer;
use application\task\UnifiedDispatchTask;

require 'rapidPHP/init.php';

if (APP_RUNNING_SAPI_NAME != 'cli') exit();

/** 定义当前是swoole http运行 */
define('SWOOLE_HTTP_SERVER', true);

try {
    RunSHttpServer::getInstance()
        ->setTaskInterface(UnifiedDispatchTask::class)
        ->setPort(9501)
        ->create()
        ->start();
} catch (ReflectionException $e) {
    exit($e->getMessage());
}