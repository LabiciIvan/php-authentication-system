<?php

namespace Classes\Base;

require __DIR__ . "/../Interface/AuthenticationInterface.php";
require __DIR__ . "/../DB.php";

use Classes\Interface\AuthenticationInterface;
use Classes\DB;

class AuthenticationBase extends DB implements AuthenticationInterface {

	public function __construct() {
		// @TO DO
	}

	public function checkUserExists(): bool {
		// @TO DO
	}

	public function registerUser(): int {
		// @TO DO
	}

	public function getUser(int $id): mixed {
		// @TO DO
	}

	public function login(): mixed {
		// @TO DO
	}

	public function logOut(): mixed {
		// @TO DO
	}

}

?>