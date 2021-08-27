<?php

namespace application\controllers;

use application\core\Controller;

class MainController extends Controller
{

	public function before()
	{
		$this->view->layout = 'custom';
	}

	public function indexAction()
	{
		$this->view->render('Home');
	}
}
