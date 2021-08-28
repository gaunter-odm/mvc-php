<?php

namespace application\controllers;

use application\core\Controller;

class MainController extends Controller
{


	public function indexAction()
	{
		$this->model->getNews();

		$this->view->render('Home', [
			'name' => 'Vitalii',
			'age' => 27
		]);
	}
}
