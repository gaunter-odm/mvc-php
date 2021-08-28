<?php

namespace application\lib;

use PDO;


class DB
{
	protected $db;

	public function __construct()
	{
		extract(_config('db'));
		$this->db = new PDO("mysql:host=$host;dbname=$name;", $user, $password);
	}

	public function query($sql, $params = [])
	{
		$stmt = $this->db->prepare($sql);
		$stmt->execute($params);
	}

	public function add_user(string $name, int $age, string $email)
	{
		// echo password_hash($email, PASSWORD_DEFAULT);
		echo password_verify($email, "$2y$10$25KvK/5lOm0imTj9VjwkG.Uf2T7U23U83DaRuyDzqG57mxnV5JuU.");
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			echo '<div class="msg">Не корректный email</div>';
		} else {
			$stmt = $this->db->prepare('INSERT INTO users (`name`, `age`, `email`) VALUES (:name, :age, :email)');
			$stmt->execute(
				[
					'name' => $name,
					'age' => $age,
					'email' => $email,
				]
			);

			// echo $stmt->errorCode();
			print_error($stmt->errorCode());
		}
	}

	public function del_user($name)
	{
		$stmt = $this->db->prepare('DELETE FROM users WHERE name = :name');
		return $stmt->execute(['name' => $name]);
	}
}
