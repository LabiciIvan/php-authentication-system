<?php

namespace Classes\Base;

include __DIR__ . "/../DB.php";
include __DIR__ . "/../Interface/LoginInterface.php";

use Classes\DB;
use Classes\Interface\LoginInterface;

class LoginBase extends DB implements LoginInterface {

	private	DB		$db;

	private	?array	$data = null;
	
	public function __construct(array $data) {
		$this->data = $data;
		$this->db = new parent;
	}

	public function login(): mixed {
		// @TO DO
	}

	public function getUser(): mixed {

		$stmt = $this->db->prepare('SELECT email, password FROM users WHERE email=:email');

		$stmt->bindParam(':email', $this->data['email']);

		$stmt->execute();

		$user = $stmt->fetch(DB::FETCH_ASSOC);

		return $user;
	}

	public function logOut(): mixed {
		// @TO DO
	}
}

?>