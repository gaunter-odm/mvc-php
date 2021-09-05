<?php

namespace application\core;

use application\core\View;

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
		$this->routes["#^$route$#"] = $params;
	}

	public function match()
	{
		$url  = trim($_SERVER['REQUEST_URI'], '/');
		$values = [];
		$separator = '___________';

		foreach ($this->routes as $route => $params) {
			if (preg_match($route, $url, $mathes)) {
				$this->params = $params;
				return true;
			}
		}

		foreach ($this->routes as $route => $params) {
			if (preg_match_all("/\{\w+\}/", $route, $match_params)) {
				$url = str_replace('.', $separator, $url);
				preg_match_all('/\/\w+/', $url, $match_url);
				$len = count($match_params[0]);

				for ($i = 0; $i < $len; $i++) {
					$values[trim($match_params[0][$i], '{}')] = trim(str_replace($separator, '.', $match_url[0][$i]), '/');
				}
			}
		}
		debug($this->params);
		return false;
	}

	public function run()
	{
		if ($this->match()) {
			$path = 'application\controllers\\' . ucfirst($this->params['controller']) . 'Controller';
			if (class_exists($path)) {

				$method = strtolower($_SERVER["REQUEST_METHOD"]);
				if ($method === 'post')
					$action = $this->params['action'] . ucfirst($method) . 'Action';
				else
					$action = $this->params['action'] . 'Action';

				if (method_exists($path, $action)) {
					$controller = new $path($this->params);
					$controller->$action();
				} else {
					View::errorCode(444);
				}
			} else {
				View::errorCode(404);
			}
		} else {
			View::errorCode(404);
		}
	}
}
