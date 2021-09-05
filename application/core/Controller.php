<?php

namespace application\core;

use application\core\User;

abstract class Controller
{
	public $route;
	public $view;
	public $model;
	public $user;

	public function __construct($route)
	{
		$this->user = new User;
		$this->route = $route;
		$this->view = new View($route, $this->user);
		$this->model = $this->loadModel($route['controller']);
	}

	public function loadModel($name)
	{
		$path = "application\models\\" . ucfirst($name);
		if (class_exists($path))
			return new $path();
	}
}
