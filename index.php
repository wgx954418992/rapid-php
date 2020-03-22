<?php
header('Access-Control-Allow-Origin: *');

use application\controller\ExceptionController;
use rapidPHP\library\core\Router;

require 'rapidPHP/init.php';

Router::run(new ExceptionController());

exit();