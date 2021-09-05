<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\Secure;

class AccountController extends Controller
{

	public function loginAction()
	{
		$this->view->render("Login", [
			'csrf' => Secure::csrf_token()
		]);
	}

	public function registerAction()
	{
		$this->view->render("Register", [
			'csrf' => Secure::csrf_token()
		]);
	}

	public function loginPostAction()
	{
		$this->csrf_verify();

		$options = [
			'login' => FILTER_SANITIZE_EMAIL,
			'pass' => [
				'filter' => FILTER_VALIDATE_REGEXP,
				'options' => ['regexp' => "/\w{5,}/"]
			]
		];

		$post = filter_input_array(INPUT_POST, $options);

		$hash = $this->model->login($post["login"]);

		if (!$hash or !password_verify($post['pass'], $hash)) {
			$this->view->render("Login - Error", [
				'msg' => 'Не верный логин или пароль',
				'csrf' => Secure::csrf_token(),
				'login' => $post['login'],
				'pass' => $post['pass'],
			]);
			exit;
		}

		$this->user->remember($post['login']);
		$this->view->redirect('/info/succes');
	}

	public function logoutAction()
	{
		$this->user->logout();
		$this->view->redirect('/');
	}


	public function registerPostAction()
	{
		$this->csrf_verify();

		extract($_POST);

		$this->model->register($name, $username, $email, $password);
		$this->view->render("Register");
	}

	private function csrf_verify()
	{
		if (!Secure::csrf_verify()) {
			$this->view->render("Timeout error", [
				'msg' => 'Время сессии истекло.',
				'csrf' => Secure::csrf_token()
			]);
			exit;
		}
	}
}
