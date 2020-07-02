<?php

use application\controller\ExceptionController;
use rapidPHP\library\core\Router;
use rapidPHP\library\core\server\request\CGIRequest;
use rapidPHP\library\core\server\response\CGIResponse;

require 'rapidPHP/init.php';

$request = CGIRequest::getInstance();
$response = CGIResponse::getInstance();

Router::run(new ExceptionController($request, $response), $request, $response);

$response->end();