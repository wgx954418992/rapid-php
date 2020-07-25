<?php

use application\context\WebContext;
use rapidPHP\library\core\Router;
use rapidPHP\library\core\server\request\CGIRequest;
use rapidPHP\library\core\server\response\CGIResponse;

require 'rapidPHP/init.php';

$request = CGIRequest::getInstance();
$response = CGIResponse::getInstance();

Router::run(new WebContext($request, $response));

$response->end();