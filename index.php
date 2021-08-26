<?php
spl_autoload_register(function ($class) {
	$path = str_replace('\\', '/', $class . '.php');
	if (file_exists($path))
		require $path;
});

require_once 'application/lib/Dev.php';

use application\core\Router;

session_start();


$router = new Router;


$router->run();
