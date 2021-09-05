<?php

namespace application\controllers;

use application\core\Controller;

class InfoController extends Controller
{
	public function succesAction()
	{
		$name = $this->model->user_name();
		if ($name)
			$this->view->render('Succes Login', ['user' => $name]);
		else
			$this->view->render('Succes');
	}
}
