<?php

namespace Classes\Base;

require __DIR__ . '/../Interface/RegisterInterface.php';
require __DIR__ . '/../DB.php';

use Classes\DB;
use Classes\Interface\RegisterInterface;

/**
 * Register users.
 *
 * This is the base class which extends the {@link DB} class and
 * implements the {@link RegisterInterface} interface.
 *
 * It provides the logic to register users and uses the {@link DB}
 * class to establish a database connection and to execute queries.
 *
 * When creating a new instance of {@link RegisterBase} class it will
 * create a new instance of {@link DB} class and assign it to $db param.
 *
 * This class is extended by {@link Register} class which is going to
 * be used for any register actions, making it a lot cleaner and easier
 * to read.
 *
 */
class RegisterBase extends DB implements RegisterInterface {
	
	/**
	 * @param	DB		$db		The database object.
	 */
	private DB $db;

	/**
	 * @param	array	$data	The array with user data to be registered.
	 */
	private array $data;
	

	public function __construct($data) {
		$this->data = $data;
		$this->db = new parent;
	}

	public function checkUserExists():bool {

		$stmt = $this->db->prepare("SELECT email FROM users WHERE email=:email");

		$stmt->bindParam(":email", $this->data['email']);

		$stmt->execute();

		$user = $stmt->fetch(DB::FETCH_ASSOC);

		return (!$user ? false : true);
	}

	public function registerUser():int {

		$stmt = $this->db->prepare("INSERT INTO users (name, email, gender, password, password_repeat) VALUES (:name, :email, :gender, :password, :password_repeat)");

		$stmt->bindParam(":name", $this->data['name']);
		$stmt->bindParam(":email", $this->data['email']);
		$stmt->bindParam(":gender", $this->data['gender']);
		$stmt->bindParam(":password", $this->data['password']);
		$stmt->bindParam(":password_repeat", $this->data['password_repeat']);

		$stmt->execute();

		$user = $this->db->lastInsertId();

		return $user;
	}
}

?>