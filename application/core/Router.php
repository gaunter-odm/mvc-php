<?php

namespace application\core;

class Router
{
	protected $routes = [];
	protected $params = [];

	public function __construct()
	{
		$routes = _config('routes');

		foreach ($routes as $key => $value) {
			$this->add($key, $value);
		}
	}

	public function add($route, $params)
	{
		$this->routes['#^' . $route . '$#'] = $params;
	}

	public function match()
	{
		$url  = trim($_SERVER['REQUEST_URI'], '/');

		foreach ($this->routes as $route => $params) {
			if (preg_match($route, $url, $mathes)) {
				$this->params = $params;
				return true;
			}
		}
		return false;
	}

	public function run()
	{
		if ($this->match()) {
			$path = 'application\controllers\\' . ucfirst($this->params['controller']) . 'Controller';
			if (class_exists($path)) {
				$action = $this->params['action'] . 'Action';
				if (method_exists($path, $action)) {

					$controller = new $path($this->params);
					$controller->$action();
				} else {
					echo '<b>Action not defined: </b>' . $action;
				}
			} else {
				echo '<b>Controller not defined:</b> ' . $path;
			}
		} else {
			echo "<h1>404</h1><a href='/'>Home</a>";
		}
	}
}
