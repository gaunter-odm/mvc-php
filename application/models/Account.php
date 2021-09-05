<?php

namespace application\models;

use application\core\Model;

class Account extends Model
{
	public function register($name, $nickname, $email, $password)
	{

		$arr = [
			'name' => $name,
			'email' => filter_var($email, FILTER_VALIDATE_EMAIL),
			'passwd' => password_hash($password, PASSWORD_BCRYPT),
			'username' => ucfirst($nickname),
			'uuid' => uniqid('mvc_', true),
		];

		$this->db->insert('users', $arr);
	}

	public function login(string $login)
	{
		$login = trim($login);
		if (!strlen($login)) return false;

		$result = $this->db->select_pass($login);

		if (is_array($result) and array_key_exists("passwd", $result))
			return $result["passwd"];
		else return false;
	}
}
