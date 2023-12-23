<?php

namespace Classes\Base;

require __DIR__ . "/../Interface/AuthenticationInterface.php";
require __DIR__ . "/../DB.php";

use Classes\Interface\AuthenticationInterface;
use Classes\DB;

class AuthenticationBase extends DB implements AuthenticationInterface {

	private	array		$data;

	private	DB			$db;
	
	public function __construct($data) {
		$this->db = new parent;
		$this->data = $data;
	}

	public function checkUserExists(): bool {
		// Prepare statement for email value.
		$stmt = $this->db->prepare("SELECT email FROM users WHERE email=:email");
		
		// Execute query after filling in the prepared statement.
		$stmt->execute(array('email' => $this->data['email']));

		// Fetch result in associative mode.
		$result = $stmt->fetch(DB::FETCH_ASSOC);

		// If found a match to the email return true, false otherwise.
		return ($result ? true : false);
	}

	public function registerUser(): int {
		// @TO DO
	}

	/**
	 * Get user.
	 * 
	 * Get the user name columns using the id column.
	 * 
	 * @return	mixed
	 */
	public function getUser(int $id): mixed {
		// Prepare statement for id.
		$stmt = $this->db->prepare('SELECT name FROM users WHERE id=:id');

		// Execute query after filling in the prepared statement.
		$stmt->execute(array('id' => $id));

		// Fetch result in an associative array.
		$result = $stmt->fetch(DB::FETCH_ASSOC);
		
		// Return result or false in case not found.
		return ($result ? $result : false);
	}

	public function login(): mixed {
		// @TO DO
	}

	public function logOut(): mixed {
		// @TO DO
	}

}

?>