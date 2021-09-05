<?php

namespace application\lib;

use PDO;
use PDOException;

class DB
{
	private $db;

	public function __construct()
	{
		$db_conf = _config('db');


		try {
			$this->db = new PDO(
				"mysql:host={$db_conf['host']};dbname={$db_conf['name']};",
				$db_conf['user'],
				$db_conf['password'],
				[
					PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
					PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
				]
			);
		} catch (PDOException $error) {
			die('Ошибка подключения к базе данных:  ' . $error->getCode());
		}
	}

	public function __destruct()
	{
		$this->db = null;
	}

	public function insert(string $table, array $array)
	{
		$params = $values = '';

		foreach ($array as $key => $value) {
			$params .= $key . ', ';
			$values .= ':' . $key . ', ';
		}

		$params = trim($params, ', ');
		$values = trim($values, ', ');

		$sql = "INSERT INTO $table ($params) VALUES ($values)";

		try {

			$this->startTransaction();
			$stmt = $this->db->prepare($sql);
			$stmt->execute($array);
		} catch (PDOException $error) {
			preg_match("/'\w+'/", $error->getMessage(), $match);
			echo ($error->getCode() == "23000" ? "Dublicate" : $error->getCode()) . " | " . $match[0]  . '<br>' . $error->getMessage();
			$this->rollBack();
		}
		return $this->commit();
	}

	public function select_pass(string $identifier)
	{
		$sql = "SELECT passwd FROM users WHERE username = :identifier OR email = :identifier";

		try {
			$stmt = $this->db->prepare($sql);
			$stmt->execute(['identifier' => $identifier]);
			$this->db  = null;
			return $stmt->fetch();
		} catch (PDOException $error) {
			$this->db  = null;
			die($error->getMessage());
		}
	}

	public function select_name(string $identifier)
	{
		$sql = "SELECT name FROM users WHERE username = :identifier OR email = :identifier";

		try {
			$stmt = $this->db->prepare($sql);
			$stmt->execute(['identifier' => $identifier]);
			$this->db  = null;
			return $stmt->fetch();
		} catch (PDOException $error) {
			$this->db  = null;
			die($error->getMessage());
		}
	}

	public function auth_date($identifier)
	{
		$sql = "SELECT uuid, name, role, avatar FROM users WHERE username = :identifier OR email = :identifier";
		try {
			$stmt = $this->db->prepare($sql);
			$stmt->execute(['identifier' => $identifier]);
			$this->db  = null;
			return $stmt->fetch();
		} catch (PDOException $error) {
			$this->db  = null;
			die($error->getMessage());
		}
	}

	private function startTransaction()
	{
		if (!$this->db->inTransaction())
			$this->db->beginTransaction();
	}

	private function commit()
	{
		if ($this->db->inTransaction()) {
			return $this->db->commit();
		}
	}

	private function rollBack()
	{
		if ($this->db->inTransaction()) {
			$this->db->rollBack();
		}
	}
}
