<?php

namespace Classes\Base;

require __DIR__ . "/../Interface/AuthenticationInterface.php";
require __DIR__ . "/../DB.php";

use Classes\Interface\AuthenticationInterface;
use Classes\DB;
use PDOException;

/**
 * AuthenticationBase class.
 * 
 * This class resolves all processes related to authentication
 * of users in the application.
 * 
 * Most of the logic is written inside this class.
 * 
 * Provides usefull methods from registering users up to log in.
 */
class AuthenticationBase extends DB implements AuthenticationInterface {

	private	array		$data;

	private	DB			$db;
	
	public function __construct($data) {
		$this->db = new parent;
		$this->data = $data;
	}

	/**
	 * Check if user exists.
	 * 
	 * Checks if the user exist using the email.
	 * 
	 * @return	bool	True if user exists and false otherwise.
	 */
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

	/**
	 * Register user in to application.
	 * 
	 */
	public function registerUser(): bool {

		// Prepare statements using placeholders.
		$stmt = $this->db->prepare("INSERT INTO users (name, email, gender, password, password_repeat) VALUES (:name, :email, :gender, :password, :password_repeat)");

		// Wrapp in try-catch block in case of a duplicate entry for email.
		try {
			$stmt->execute(
				array(
					":name"				=> $this->data['name'],
					":email"			=> $this->data['email'],
					":gender"			=> $this->data['gender'],
					":password"			=> $this->data['password'],
					":password_repeat"	=> $this->data['password_repeat'],
				)
			);
		} catch (PDOException $e) {
			var_dump($e->getMessage());
			return false;
		}

		return true;
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