<?php

namespace application\models;

use application\core\Model;

class Info extends Model
{
	public function user_name()
	{
		if (key_exists('login', $_COOKIE)) {
			$user = $this->db->select_name($_COOKIE['login']);
			return $user['name'];
		} else return false;
	}
}
