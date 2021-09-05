<?php

namespace application\core;

use application\lib\DB;

final class User
{
	public $path = 'application/tmp/';

	function __construct()
	{
		if (array_key_exists('remember', $_COOKIE)) {
			$this->path .= $_COOKIE['remember'];

			if (file_exists($this->path)) {
				$arr = unserialize(file_get_contents($this->path));
				foreach ($arr as $key => $val)
					$this->$key = $val;
			} else {
				setcookie('remember');
			}
		}
	}

	public function remember($login)
	{
		if ($login) {
			$db = new DB;
			$params = $db->auth_date($login);
			$this->path .= $params['uuid'];
			file_put_contents($this->path, serialize($params));

			setcookie('remember', $params['uuid'], [
				'path'  => '/',
				'httponly' => true,
				'samesite' => 'lax',
				'expires' => time() + 86400
			]);
		}
	}

	public function logout()
	{
		setcookie('remember', null, 0);

		if (is_file($this->path))
			unlink($this->path);

		foreach ($this as $key => $value) {
			$this->$key = null;
		}
	}

	public function name()
	{
		if (isset($this->name)) return $this->name;
		else '';
	}
}
