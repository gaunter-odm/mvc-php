<?php

namespace application\lib;

final class Secure
{
	public $_token = '';

	function __construct()
	{
		$hash = hash('sha256', uniqid());
		$this->_token = $hash;

		setcookie('_csrf-token', $hash, [
			'httponly' => true,
			'samesite' => 'lax',
			'expires' => time() + 1800,
		]);
	}

	static public function csrf_token()
	{
		$obj = new self;
		$token = $obj->_token;
		$obj = null;
		return $token;
	}

	static public function csrf_verify()
	{
		if (
			array_key_exists("_csrf", $_POST) &&
			array_key_exists("_csrf-token", $_COOKIE) &&
			$_POST["_csrf"] === $_COOKIE['_csrf-token']
		)
			return true;
		return false;
	}
}
