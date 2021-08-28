<?php

require_once 'application/lib/functions.php';
require_once 'application/lib/Dev.php';

use application\core\Router;

session_start();

$router = new Router;
$router->run();
